      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <i class="fa fa-user"></i>
              <h3 class="box-title"><?php echo $caption ?></h3>  
              <div class="box-tools">                
                <a href="<?php echo base_url(); ?>menu/add" type="button" class="btn btn-block btn-default pull-right">Tambah Menu</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if($this->session->flashdata('success')) { ?>
              <div class="alert alert-success alert-dismissible" style="margin-top: 3px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <div class="header"><b><i class="fa fa-check"></i> SUCCESS</b> <?php echo $this->session->flashdata('success'); ?></div>
              </div>
              <?php } ?>
              <table id="myTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Menu</th>
                  <th>Opsi</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="modal fade" id="modalAdd">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Yakin menghapus data ini?!</h4>
              </div>
              <!-- <div class="modal-body"></p>
              </div> -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="bHapus" type="button" class="btn btn-danger">Hapus!</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modalHapus">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Yakin menghapus data ini?!</h4>
              </div>
              <!-- <div class="modal-body"></p>
              </div> -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="bHapus" type="button" class="btn btn-danger">Hapus!</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- /.col -->
      </div>
