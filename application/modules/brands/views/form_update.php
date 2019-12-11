<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title"><?php echo $caption ?></h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url() . 'brands/update'; ?>" method="post">
        <div class="box-body">
          <?php if (isset($error)) { ?>
            <div class="alert alert-danger alert-dismissible" style="margin-top: 3px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> <?php echo ($error); ?></div>
            </div>
          <?php } ?>
          <div class="form-group <?= form_error('id_brands') ? 'has-error' : '' ?>" hidden>
            <label for="id_brands" class="col-sm-3 control-label">id brands</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="id_brands" placeholder="Id Brands" value="<?php echo isset($lists) ? $lists['id_brands'] : set_value('id_brands'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('id_brands'); ?></span>
          </div>
          <div class="form-group <?= form_error('brands_name') ? 'has-error' : '' ?>">
            <label for="brands_name" class="col-sm-3 control-label">Nama Brands</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="brands_name" placeholder="Nama Brands" value="<?php echo isset($lists) ? $lists['brands_name'] : set_value('brands_name'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('brands_name'); ?></span>
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