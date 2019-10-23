<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title"><?php echo $caption ?></h3> 
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url('customers/add'); ?>" method="post">
        <div class="box-body">
          <?php if(isset($error)) { ?>
          <div class="alert alert-danger alert-dismissible" style="margin-top: 3px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> <?php echo($error); ?></div>
          </div>
          <?php } ?>
          <div class="form-group <?= form_error('customer_name') ? 'has-error' : '' ?>">
            <label for="nama customer" class="col-sm-3 control-label">Nama Customer</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="customer_name" placeholder="Nama Customer" value="<?php echo set_value('customer_name'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('customer_name'); ?></span>
          </div>
          <div class="form-group <?= form_error('alamat') ? 'has-error' : '' ?>">
            <label for="alamat" class="col-sm-3 control-label">Alamat</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo set_value('alamat'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('alamat'); ?></span>
          </div>
           <div class="form-group <?= form_error('phone') ? 'has-error' : '' ?>">
            <label for="phone" class="col-sm-3 control-label">No Telepon</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="phone" placeholder="No Telepon" value="<?php echo set_value('phone'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('phone'); ?></span>
          </div>
           <div class="form-group <?= form_error('description') ? 'has-error' : '' ?>">
            <label for="description" class="col-sm-3 control-label">Deskripsi</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="description" placeholder="Deskripsi" value="<?php echo set_value('description'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('description'); ?></span>
          </div>
          <div class="form-group">
            <label for="role" class="col-sm-3 control-label">Status</label>
            <div class="col-sm-6">
              <select id="select2" class="form-control select2 select2-hidden-accessible" name="role" style="width: 100%;" tabindex="-1" aria-hidden="true">
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label"></label>
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
