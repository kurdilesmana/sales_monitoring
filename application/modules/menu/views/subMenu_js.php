<script>
  var tabel = null;
  $(document).ready(function() {
    tabel = $('#myTable').DataTable({
     	'paging'      : true,
	    'lengthChange': false,
	    'lengthMenu'	: [[5],[5]],
	    'searching'   : false,
	    'info'        : true,
	    'autoWidth'   : false,
      "processing": true,
      "serverSide": true,
      "ordering": true, // Set true agar bisa di sorting
      "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
      "ajax":
      {
          "url": "<?php echo base_url('menu/viewSubmenu') ?>", // URL file untuk proses select datanya
          "type": "POST"
      },
      "deferRender": true,
      "columns": [
        { "data": "title" }, // Tampilkan nama header menu
        { "data": "url" }, // Tampilkan nama header menu
        { "data": "icon" }, // Tampilkan nama header menu
        { "render": function ( data, type, row ) {  // Tampilkan role
          var status = ""
          if (row.is_active == 1) { // Jika role 1
            status = 'Aktif' // Set Admin
          } else { // Jika bukan 1
            status = 'Tidak Aktif' // Set status
          }
            return status; // Tampilkan jenis kelaminnya
          }
        },
        { sWidth: "15%", 
        	"render": function ( data, type, row ) { // Tampilkan kolom aksi
	          var html  = "<button class='btn btn-sm btn-default edit_btn'><i class='fa fa-edit'></i> Edit</button>"
	          html += " | <button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#modalHapus'><i class='fa fa-trash'></i> Hapus</button>"
	          return html
         	}
        },
      ],
    });
    $('#myTable').on('click', 'tbody .edit_btn', function () {
      var data_row = tabel.row($(this).closest('tr')).data();
      $.redirect('<?php echo base_url().$this->router->class.'/update'; ?>', {'id': data_row['id']}, 'GET');
    });
    
  });
</script>