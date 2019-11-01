<script type="text/javascript">
	$(document).ready(function() {
		// Set Selected data
		<?php
		if (isset($lists['brand_id'])) {
			$brandID = $lists['brand_id'];
			$query = "SELECT * FROM brands WHERE id = $brandID";
			$brand = $this->db->query($query)->result_array(); ?>

			<?php
				foreach ($brand as $r) { ?>
				$('#selectBrands').select2({
					data: [{
						id: '<?= $r['id'] ?>',
						text: '<?= $r['name'] ?>'
					}]
				});
			<?php
				}
			}

			if (isset($lists['area_id'])) {
				$areaID = $lists['area_id'];
				$query = "SELECT * FROM area WHERE id = $areaID";
				$area = $this->db->query($query)->result_array(); ?>

			<?php foreach ($area as $r) { ?>
				$('#selectArea').select2({
					data: [{
						id: '<?= $r['id'] ?>',
						text: '<?= $r['name'] ?>'
					}]
				});
		<?php
			}
		}
		?>

		$('#selectBrands').select2({
			placeholder: 'Pilih Brands',
			ajax: {
				dataType: 'json',
				url: '<?php echo base_url('brands/searchBrands'); ?>',
				delay: 250,
				data: function(params) {
					return {
						q: params.term,
					}
				},
				processResults: function(data, page) {
					return {
						results: data
					};
				},
			}
		});
		$('#selectArea').select2({
			placeholder: 'Pilih Area',
			ajax: {
				dataType: 'json',
				url: '<?php echo base_url('area/searchArea'); ?>',
				delay: 250,
				data: function(params) {
					return {
						q: params.term,
					}
				},
				processResults: function(data, page) {
					return {
						results: data
					};
				},
			}
		});
		$('#tgl_input').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true
		});
	});
</script>