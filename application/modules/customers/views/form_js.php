<script type="text/javascript">
	$(document).ready(function() {
    $('#select2').select2({
    	data: [
	    	{ id: 1, text: 'Admin'},
		    { id: 2, text: 'Super Admin'}
	    ]
    });
    // Set Selected data
    $('#select2').val(<?php echo isset($lists)?$lists['status']:''; ?>); // Select the option with a value of data
		$('#select2').trigger('change'); // Notify any JS components that the value changed
	});
</script>