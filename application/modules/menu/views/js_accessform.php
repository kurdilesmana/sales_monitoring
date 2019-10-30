<script type="text/javascript">
	$(document).ready(function() {
		// Set Selected data
		<?php
			if (isset($lists['menu'])) {
				$menuID = $lists['menu'];
				$query = "SELECT * FROM user_menu WHERE id = $menuID";
				$menu = $this->db->query($query)->result_array(); ?>
				
				<?php foreach ($menu as $m) { ?>
				$('#menu_id').select2({
					data: [{
						id: '<?= $m['id'] ?>',
						text: '<?= $m['title'] ?>'
					}]
				});
				<?php 
			} 
		}
		?>
		$('#menu_id').select2({
			placeholder: 'Pilih Submenu',
			ajax: {
				dataType: 'json',
				url: '<?php echo base_url('menu/searchSubmenu'); ?>',
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
    // Set Selected data
		<?php
			if (isset($lists['role'])) {
				$roleID = $lists['role'];
				$query = "SELECT * FROM user_role WHERE id = $roleID";
				$role = $this->db->query($query)->result_array(); ?>
				
				<?php foreach ($role as $r) { ?>
				$('#role_id').select2({
					data: [{
						id: '<?= $r['id'] ?>',
						text: '<?= $r['name'] ?>'
					}]
				});
				<?php 
			} 
		}
		?>
		$('#role_id').select2({
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