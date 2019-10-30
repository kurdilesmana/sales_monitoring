<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title"><?php echo $caption ?></h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url() . 'area/update?id=' . $lists['id_area']; ?>" method="post">
        <div class="box-body">
          <?php if (isset($error)) { ?>
            <div class="alert alert-danger alert-dismissible" style="margin-top: 3px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> <?php echo ($error); ?></div>
            </div>
          <?php } ?>
          <div class="form-group <?= form_error('id_area') ? 'has-error' : '' ?>" hidden>
            <label for="id_area" class="col-sm-3 control-label">id brands</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="id_area" placeholder="Id Brands" value="<?php echo isset($lists) ? $lists['id_area'] : set_value('id_area'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('id_area'); ?></span>
          </div>
          <div class="form-group <?= form_error('area_name') ? 'has-error' : '' ?>">
            <label for="area_name" class="col-sm-3 control-label">Nama Area</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="area_name" placeholder="Nama area" value="<?php echo isset($lists) ? $lists['area_name'] : set_value('area_name'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('area_name'); ?></span>
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