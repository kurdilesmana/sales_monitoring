<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title"><?php echo $caption ?></h3> 
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url().'menu/add'; ?>" method="post">
        <div class="box-body">
          <?php if(isset($error)) { ?>
          <div class="alert alert-danger alert-dismissible" style="margin-top: 3px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> <?php echo($error); ?></div>
          </div>
          <?php } ?>
          <div class="form-group <?= form_error('header_menu') ? 'has-error' : '' ?>">
            <label for="header_menu" class="col-sm-3 control-label">Menu</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="header_menu" placeholder="Menu" value="<?php echo set_value('header_menu'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('header_menu'); ?></span>
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
