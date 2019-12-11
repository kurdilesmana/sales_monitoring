<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title"><?php echo $caption ?></h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url() . 'menu/updateaccessmenu?id='; ?>" method="post">
        <div class="box-body">
          <?php if (isset($error)) { ?>
            <div class="alert alert-danger alert-dismissible" style="margin-top: 3px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> <?php echo ($error); ?></div>
            </div>
          <?php } ?>
          <div class="form-group <?= form_error('id') ? 'has-error' : '' ?>" hidden>
            <label for="id" class="col-sm-3 control-label">id brands</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="id" placeholder="Id Menu" value="<?php echo isset($lists) ? $lists['id'] : set_value('id'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('id'); ?></span>
          </div>
          <div class="form-group <?= form_error('menu_id') ? 'has-error' : '' ?>">
            <label for="menu_id" class="col-sm-3 control-label">Menu</label>
            <div class="col-sm-6">
              <select id="menu_id" class="form-control select2 select2-hidden-accessible" name="menu_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
              </select>
            </div>
            <span class="help-block"><?php echo form_error('menu_id'); ?></span>
          </div>
          <div class="form-group <?= form_error('role_id') ? 'has-error' : '' ?>">
            <label for="role_id" class="col-sm-3 control-label">Role</label>
            <div class="col-sm-6">
              <select id="role_id" class="form-control select2 select2-hidden-accessible" name="role_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
              </select>
            </div>
            <span class="help-block"><?php echo form_error('role_id'); ?></span>
          </div>
          <div class="form-group">
            <label for="submit" class="col-sm-3 control-label"></label>
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