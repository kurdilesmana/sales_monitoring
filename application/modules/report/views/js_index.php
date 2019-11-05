<script>
  var tabel = null;
  $(document).ready(function() {
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
    $('#tgl_awal').datepicker({
      format: 'dd/mm/yyyy',
      autoclose: true
    });
    $('#tgl_akhir').datepicker({
      format: 'dd/mm/yyyy',
      autoclose: true
    });
  });
</script>