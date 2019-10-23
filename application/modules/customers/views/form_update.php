<div class="row">
  <div class="col-md">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title"><?php echo $caption ?></h3> 
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url().'customers/update?id='.$lists['id']; ?>" method="post">
        <div class="box-body">
          <?php if(isset($error)) { ?>
          <div class="alert alert-danger alert-dismissible" style="margin-top: 3px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> <?php echo($error); ?></div>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group" hidden> 
                <label for="nama" class="col-sm-3 control-label">ID</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="id" placeholder="Nama" value="<?php echo isset($lists)?$lists['id']:''; ?>">
                </div>
                <span class="help-block"><?php echo form_error('customer_name'); ?></span>
              </div>
              <div class="form-group <?= form_error('customer_name') ? 'has-error' : '' ?>">
                <label for="customer name" class="col-sm-3 control-label">Nama Customer</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="customer_name" placeholder="Nama Customer" value="<?php echo isset($lists)?$lists['customer_name']:set_value('customer_name'); ?>">
                </div>
                <span class="help-block"><?php echo form_error('customer_name'); ?></span>
              </div>
              <div class="form-group <?= form_error('alamat') ? 'has-error' : '' ?>">
                <label for="alamat" class="col-sm-3 control-label">Alamat</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo isset($lists)?$lists['alamat']:set_value('alamat'); ?>">
                </div>
                <span class="help-block"><?php echo form_error('alamat'); ?></span>
              </div>
              <div class="form-group <?= form_error('phone') ? 'has-error' : '' ?>">
                <label for="phone" class="col-sm-3 control-label">No telepon</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="phone" placeholder="No Telepon" value="<?php echo isset($lists)?$lists['phone']:set_value('phone'); ?>">
                </div>
                <span class="help-block"><?php echo form_error('phone'); ?></span>
              </div>
               <div class="form-group <?= form_error('description') ? 'has-error' : '' ?>">
                <label for="description" class="col-sm-3 control-label">Deskripsi</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="description" placeholder="Deskripsi" value="<?php echo isset($lists)?$lists['description']:set_value('description'); ?>">
                </div>
                <span class="help-block"><?php echo form_error('description'); ?></span>
              </div>
              <div class="form-group">
                <label for="role" class="col-sm-3 control-label">Status</label>
                <div class="col-sm-6">
                  <select id="select2" class="form-control select2 select2-hidden-accessible" name="status" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group"> 
                <label for="nama" class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                  <small>leave blank if you don't want to change it</small>
                </div>
              </div>
              <div class="form-group <?= form_error('password') ? 'has-error' : '' ?>">
                <label for="nama" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <span class="help-block"><?php echo form_error('password'); ?></span>
              </div>
              <div class="form-group <?= form_error('passconf') ? 'has-error' : '' ?>">
                <label for="passconf" class="col-sm-3 control-label">Konfirmasi Password</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" name="passconf" placeholder="Konfirmasi Password">
                </div>
                <span class="help-block"><?php echo form_error('passconf'); ?></span>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-3 control-label"></label>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-info pull-right">Ubah</button>
                </div>
              </div>
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
