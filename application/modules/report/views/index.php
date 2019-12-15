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
              <form method="post" id="form-report" action=" <?php echo base_url() . 'report/printPDF'; ?>">
                <div class="form-group col-md-12">
                  <div class="col-md-4">
                    <label for="tgl_input">Tanggal Awal</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control" id="tgl_awal" name="tgl_awal" placeholder="Tanggal Awal" value="<?= set_value('tgl_awal') ?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="tgl_input">Tanggal Akhir</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control" id="tgl_akhir" name="tgl_akhir" placeholder="Tanggal Akhir" value="<?= set_value('tgl_awal') ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-12">
                  <div class="col-md-4">
                    <label for="brand_id" class="control-label">Brands</label>
                    <select id="selectBrands" class="form-control select2 select2-hidden-accessible" name="brand_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="divisi_id" class="control-label">Divisi</label>
                    <select id="selectDivisi" class="form-control select2 select2-hidden-accessible" name="divisi_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="area_id" class="control-label">Area</label>
                    <select id="selectArea" class="form-control select2 select2-hidden-accessible" name="area_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-12">
                  <div class="col-md-4">
                    <button type="button" id="btn-search" class="btn btn-info">Search</button>
                    <button type="button" id="btn-cetak" class="btn btn-info">Cetak</button>
                  </div>
                </div>
              </form>
              <table id="myTable" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Brands</th>
                    <th>Divisi</th>
                    <th>Area</th>
                    <th>Omset</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($lists)) {
                    foreach ($lists as $l) { ?>
                      <tr>
                        <td><?= $l['tgl'] ?></td>
                        <td><?= $l['brand'] ?></td>
                        <td><?= $l['divisi'] ?></td>
                        <td><?= $l['area'] ?></td>
                        <td><?= $l['omset'] ?></td>
                        <td><?= $l['quantity'] ?></td>
                      </tr>
                  <?php }
                  } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>