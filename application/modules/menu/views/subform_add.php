<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title"><?php echo $caption ?></h3> 
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url().'menu/addSubmenu'; ?>" method="post">
        <div class="box-body">
          <?php if(isset($error)) { ?>
          <div class="alert alert-danger alert-dismissible" style="margin-top: 3px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> <?php echo($error); ?></div>
          </div>
          <?php } ?>
          <div class="form-group <?= form_error('header_id') ? 'has-error' : '' ?>">
            <label for="header_id" class="col-sm-3 control-label">Menu</label>
            <div class="col-sm-6">
              <select id="header_id" class="form-control select2 select2-hidden-accessible" name="header_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
              </select>
            </div>
            <span class="help-block"><?php echo form_error('header_id'); ?></span>
          </div>
          <div class="form-group <?= form_error('title') ? 'has-error' : '' ?>">
            <label for="title" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo set_value('Title'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('title'); ?></span>
          </div>
          <div class="form-group <?= form_error('url') ? 'has-error' : '' ?>">
            <label for="url" class="col-sm-3 control-label">URL</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="url" placeholder="URL" value="<?php echo set_value('url'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('url'); ?></span>
          </div>
          <div class="form-group <?= form_error('icon') ? 'has-error' : '' ?>">
            <label for="icon" class="col-sm-3 control-label">Icon</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="icon" placeholder="Icon" value="<?php echo set_value('icon'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('icon'); ?></span>
          </div>
          <div class="form-group <?= form_error('is_active') ? 'has-error' : '' ?>">
            <label for="is_active" class="col-sm-3 control-label">Status</label>
            <div class="col-sm-6">
              <select id="is_active" class="form-control select2 select2-hidden-accessible" name="is_active" style="width: 100%;" tabindex="-1" aria-hidden="true">
              </select>
            </div>
            <span class="help-block"><?php echo form_error('is_active'); ?></span>
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
