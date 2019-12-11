<script type="text/javascript">
  $(document).ready(function() {
    // set data select2
    <?php
    if (isset($lists['header_id'])) {
      $headerID = $lists['header_id'];
      $header = $this->db->get_where('user_header_menu', array('id' => $headerID))->result_array(); ?>

      <?php foreach ($header as $h) { ?>
        $('#header_id').select2({
          data: [{
            id: '<?= $h['id'] ?>',
            text: '<?= $h['header_menu'] ?>'
          }]
        });
    <?php
      }
    }
    ?>
    <?php
    if (isset($lists['parent_id'])) {
      $parentID = $lists['parent_id'];
      $parent = $this->db->get_where('user_menu', array('id' => $parentID))->result_array(); ?>

      <?php foreach ($parent as $p) { ?>
        $('#parent_id').select2({
          data: [{
            id: '<?= $p['id'] ?>',
            text: '<?= $p['title'] ?>'
          }]
        });
    <?php
      }
    }
    ?>

    // Header ID or Menu
    $('#header_id').select2({
      placeholder: 'Pilih Header Menu',
      ajax: {
        dataType: 'json',
        url: '<?php echo base_url('menu/searchMenu'); ?>',
        delay: 250,
        data: function(params) {
          return {
            q: params.term
          }
        },
        processResults: function(data, page) {
          return {
            results: data
          };
        },
      }
    });
    $('#parent_id').select2({
      placeholder: 'Pilih Parent Menu',
      ajax: {
        dataType: 'json',
        url: '<?php echo base_url('menu/searchSubMenu'); ?>',
        delay: 250,
        data: function(params) {
          return {
            q: params.term
          }
        },
        processResults: function(data, page) {
          return {
            results: data
          };
        },
      }
    });

    // Status
    $('#is_active').select2({
      data: [{
          id: 1,
          text: 'Aktif'
        },
        {
          id: 0,
          text: 'Tidak Aktif'
        }
      ]
    });


  });
</script>