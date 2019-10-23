<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title"><?php echo $caption ?></h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url() . 'users/add'; ?>" method="post">
        <div class="box-body">
          <?php if (isset($error)) { ?>
            <div class="alert alert-danger alert-dismissible" style="margin-top: 3px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> <?php echo ($error); ?></div>
            </div>
          <?php } ?>
          <div class="form-group <?= form_error('name') ? 'has-error' : '' ?>">
            <label for="nama" class="col-sm-3 control-label">Nama</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="name" placeholder="Nama" value="<?php echo set_value('name'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('name'); ?></span>
          </div>
          <div class="form-group <?= form_error('username') ? 'has-error' : '' ?>">
            <label for="username" class="col-sm-3 control-label">Username</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('username'); ?></span>
          </div>
          <div class="form-group <?= form_error('password') ? 'has-error' : '' ?>">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-6">
              <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('password'); ?></span>
          </div>
          <div class="form-group <?= form_error('passconf') ? 'has-error' : '' ?>">
            <label for="passconf" class="col-sm-3 control-label">Konfirmasi Password</label>
            <div class="col-sm-6">
              <input type="password" class="form-control" name="passconf" placeholder="Konfirmasi Password" value="<?php echo set_value('passconf'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('passconf'); ?></span>
          </div>
          <div class="form-group <?= form_error('passconf') ? 'has-error' : '' ?>">
            <label for="role" class="col-sm-3 control-label">Role</label>
            <div class="col-sm-6">
              <select id="select2" class="form-control select2 select2-hidden-accessible" name="role" style="width: 100%;" tabindex="-1" aria-hidden="true">
              </select>
            </div>
            <span class="help-block"><?php echo form_error('role'); ?></span>
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