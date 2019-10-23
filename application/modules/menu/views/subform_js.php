<script type="text/javascript">
	$(document).ready(function() {
    // Header ID or Menu
    $('#header_id').select2({
    	placeholder: 'Pilih Menu',
      ajax: {
        dataType: 'json',
        url: '<?php echo base_url('menu/searchMenu'); ?>',
        delay: 800,
        data: function(params) {
	          return {
	            q : params.term
	          }
	        },
        processResults: function (data, page) {
        return {
          results: data
        };
	      },
	    }
    });
    // Set Selected data
    $('#header_id').val(<?php echo isset($lists)?$lists['header_id']:''; ?>); // Select the option with a value of data
		$('#header_id').trigger('change'); // Notify any JS components that the value changed

		// Status
		$('#is_active').select2({
    	data: [
	    	{ id: 1, text: 'Aktif'},
		    { id: 0, text: 'Tidak Aktif'}
	    ]
    });
    // Set Selected data
    $('#is_active').val(<?php echo isset($lists)?$lists['is_active']:''; ?>); // Select the option with a value of data
		$('#is_active').trigger('change'); // Notify any JS components that the value changed

	});
</script>