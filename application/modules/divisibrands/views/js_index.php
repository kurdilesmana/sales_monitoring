<script>
  var tabel = null;
  $(document).ready(function() {
    tabel = $('#myTable').DataTable({
      'paging': true,
      'lengthChange': true,
      // 'lengthMenu': [
      //   [5],
      //   [5]
      // ],
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
        "url": "<?php echo base_url('divisibrands/view') ?>", // URL file untuk proses select datanya
        "type": "POST"
      },
      "deferRender": true,
      "columns": [{
          "data": "name"
        },
        {
          sWidth: "17%",
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
      var id_divisi = data_row['id'];
      $(".modal-header #id_divisi").val(id_divisi);
      $('#modalHapus').modal('show');
    });
  });
</script>