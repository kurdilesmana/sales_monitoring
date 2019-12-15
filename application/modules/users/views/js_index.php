<script>
  var tabel = null;
  $(document).ready(function() {
    tabel = $('#myTable').DataTable({
      'paging': true,
      'lengthChange': false,
      'lengthMenu': [
        [5],
        [5]
      ],
      'searching': false,
      'info': true,
      'autoWidth': false,
      "processing": true,
      "serverSide": true,
      "ordering": true, // Set true agar bisa di sorting
      "order": [
        [0, 'asc']
      ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
      "ajax": {
        "url": "<?php echo base_url('users/view') ?>", // URL file untuk proses select datanya
        "type": "POST"
      },
      "deferRender": true,
      "columns": [{
          "data": "name"
        },
        {
          "data": "email"
        },
        {
          "data": "brand"
        },
        {
          "render": function(data, type, row) { // Tampilkan role
            var role = ""
            if (row.role_id == 1) { // Jika role 1
              role = 'Administrator' // Set Admin
            } else { // Jika bukan 1
              role = 'User' // Set role
            }
            return role; // Tampilkan jenis kelaminnya
          }
        },
        {
          sWidth: "15%",
          "render": function(data, type, row) { // Tampilkan kolom aksi
            var html = "<button class='btn btn-sm btn-default edit_btn'><i class='fa fa-edit'></i> Edit</button>"
            html += " | <button class='btn btn-sm btn-danger delete_btn'><i class='fa fa-trash'></i> Hapus</button>"
            return html
          }
        },
      ],
    });
    $('#myTable').on('click', 'tbody .edit_btn', function() {
      var data_row = tabel.row($(this).closest('tr')).data();
      $.redirect('<?php echo base_url() . $this->router->class . '/update'; ?>', {
        'id': data_row['id']
      }, 'GET');
    });
    $('#myTable').on('click', 'tbody .delete_btn', function() {
      var data_row = tabel.row($(this).closest('tr')).data();
      var id_user = data_row['id'];
      $(".modal-header #id_user").val(id_user);
      $('#modalHapus').modal('show');
    });
    $("#tabs").tabs();
  });
</script>