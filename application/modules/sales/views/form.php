<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title"><?php echo $caption ?></h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url() . 'sales/add'; ?>" method="post">
        <div class="box-body">
          <?php if (isset($error)) { ?>
            <div class="alert alert-danger alert-dismissible" style="margin-top: 3px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> <?php echo ($error); ?></div>
            </div>
          <?php } ?>
          <div class="form-group <?= form_error('tgl_input') ? 'has-error' : '' ?>">
            <label for="tgl_input" class="col-sm-3 control-label">Tanggal</label>
            <div class="col-sm-6">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="tgl_input" name="tgl_input">
              </div>
            </div>
            <span class="help-block"><?php echo form_error('tgl_input'); ?></span>
          </div>
          <div class="form-group <?= form_error('brand_id') ? 'has-error' : '' ?>">
            <label for="brand_id" class="col-sm-3 control-label">Brand</label>
            <div class="col-sm-6">
              <select id="selectBrands" class="form-control select2 select2-hidden-accessible" name="brand_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
              </select>
            </div>
            <span class="help-block"><?php echo form_error('brand_id'); ?></span>
          </div>
          <div class="form-group <?= form_error('area_id') ? 'has-error' : '' ?>">
            <label for="area_id" class="col-sm-3 control-label">Area</label>
            <div class="col-sm-6">
              <select id="selectArea" class="form-control select2 select2-hidden-accessible" name="area_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
              </select>
            </div>
            <span class="help-block"><?php echo form_error('area_id'); ?></span>
          </div>
          <div class="form-group <?= form_error('omset') ? 'has-error' : '' ?>">
            <label for="omset" class="col-sm-3 control-label">Omset</label>
            <div class="col-sm-6">
              <input type="number" class="form-control" name="omset" placeholder="Omset" value="<?php echo isset($lists) ? $lists->omset : set_value('omset'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('omset'); ?></span>
          </div>
          <div class="form-group <?= form_error('quantity') ? 'has-error' : '' ?>">
            <label for="quantity" class="col-sm-3 control-label">Quantity</label>
            <div class="col-sm-6">
              <input type="number" class="form-control" name="quantity" placeholder="quantity" value="<?php echo isset($lists) ? $lists->quantity : set_value('quantity'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('quantity'); ?></span>
          </div>
          <div class="form-group">
            <label for="Simpan" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
              <button type="submit" class="btn btn-info pull-right">Simpan</button>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </form>
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>