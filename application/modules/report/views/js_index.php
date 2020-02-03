<script>
  $(document).ready(function() {
    $('#myTable').dataTable({
      "searching": false,
      "bPaginate": false,
      "bInfo": false,
      "aoColumnDefs": [ {
        "aTargets": [ 4 ],
        "mRender": function (data, type, full) {
          var formmatedvalue=data.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
          return "Rp. "+formmatedvalue;
        }
      }]
    });

    $("#btn-search").click(function() {
      $('#form-report').attr('action', '<?= base_url('report') ?>').submit();
    });

    $('#btn-cetak').click(function() {
      $('#form-report').submit();
    });

    // set select2 option
    <?php
    $brandID = set_value('brand_id');
    if ($brandID) {
      $query = "SELECT * FROM brands WHERE id = $brandID";
      $brand = $this->db->query($query)->result_array();
      
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

    $divisiID = set_value('divisi_id');
    if ($divisiID) {
      $query = "SELECT * FROM divisibrands WHERE id = $divisiID";
      $divisi = $this->db->query($query)->result_array();
    
      foreach ($divisi as $r) { ?>
        $('#selectDivisi').select2({
          data: [{
            id: '<?= $r['id'] ?>',
            text: '<?= $r['name'] ?>'
          }]
        });
      <?php
      }
    }

    $areaID = set_value('area_id');
    if ($areaID) {
      $query = "SELECT * FROM area WHERE id = $areaID";
      $area = $this->db->query($query)->result_array();
    
      foreach ($area as $r) { ?>
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

    // select2
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
    $('#selectDivisi').select2({
      placeholder: 'Pilih Divisi',
      ajax: {
        dataType: 'json',
        url: '<?php echo base_url('divisibrands/searchDivisi'); ?>',
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