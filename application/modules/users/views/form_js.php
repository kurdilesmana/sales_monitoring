<script type="text/javascript">
	$(document).ready(function() {
		// Set Selected data
		<?php
			if ($lists['role']) {
				$roleID = $lists['role'];
				$query = "SELECT * FROM user_role WHERE id = $roleID";
				$role = $this->db->query($query)->result_array(); ?>
				
				<?php foreach ($role as $r) { ?>
				$('#select2').select2({
					data: [{
						id: '<?= $r['id'] ?>',
						text: '<?= $r['name'] ?>'
					}]
				});
				<?php 
			} 
		}?>
		$('#select2').select2({
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
	});
</script>