      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <i class="fa fa-user"></i>
              <h3 class="box-title"><?php echo $caption ?></h3>
              <div class="box-tools">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible" style="margin-top: 3px">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <div class="header"><b><i class="fa fa-check"></i> SUCCESS</b> <?php echo $this->session->flashdata('success'); ?></div>
                </div>
              <?php } ?>
              <form method="post" action=" <?php echo base_url() . 'report/printPDF'; ?>">
                <div class=" form-group col-md-12">
                  <div class="col-md-4">
                    <label for="tgl_input">Tanggal Awal</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control" id="tgl_awal" name="tgl_awal" placeholder="Tanggal Awal">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="tgl_input">Tanggal Akhir</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control" id="tgl_akhir" name="tgl_akhir" placeholder="Tanggal Akhir">
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-12">
                  <div class="col-md-4">
                    <label for="brand_id" class="control-label">Brands</label>
                    <select id="selectBrands" class="form-control select2 select2-hidden-accessible" name="brand_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-12">
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-info">Cetak</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>