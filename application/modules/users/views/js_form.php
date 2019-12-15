<script type="text/javascript">
	$(document).ready(function() {
		// Set Selected data
		<?php
		if (isset($lists['role_id'])) {
			$roleID = $lists['role_id'];
			$query = "SELECT * FROM user_role WHERE id = $roleID";
			$role = $this->db->query($query)->result_array(); ?>

			<?php foreach ($role as $r) { ?>
				$('#selectRole').select2({
					data: [{
						id: '<?= $r['id'] ?>',
						text: '<?= $r['name'] ?>'
					}]
				});
		<?php
			}
		}
		?>

		<?php
		if (isset($lists['brand_id'])) {
			$brandID = $lists['brand_id'];
			$query = "SELECT * FROM brands WHERE id = $brandID";
			$brand = $this->db->query($query)->result_array(); ?>

			<?php foreach ($brand as $r) { ?>
				$('#selectBrands').select2({
					data: [{
						id: '<?= $r['id'] ?>',
						text: '<?= $r['name'] ?>'
					}]
				});
		<?php
			}
		}
		?>

		$('#selectRole').select2({
			placeholder: 'Pilih Role',
			ajax: {
				dataType: 'json',
				url: '<?php echo base_url('users/searchRole'); ?>',
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
	});
</script>