<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title"><?php echo $caption ?></h3> 
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url().'brands/update?id='.$lists['id_brands']; ?>" method="post">
        <div class="box-body">
          <?php if(isset($error)) { ?>
          <div class="alert alert-danger alert-dismissible" style="margin-top: 3px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> <?php echo($error); ?></div>
          </div>
          <?php } ?>
           <div class="form-group <?= form_error('id_brands') ? 'has-error' : '' ?>"hidden>
            <label for="id_brands" class="col-sm-3 control-label">id brands</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="id_brands" placeholder="Id Brands" value="<?php echo isset($lists)?$lists['id_brands']:set_value('id_brands'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('id_brands'); ?></span>
          </div>
          <div class="form-group <?= form_error('brands_code') ? 'has-error' : '' ?>">
            <label for="brands_code" class="col-sm-3 control-label">Kode Brands</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="brands_code" placeholder="Kode Brands" value="<?php echo isset($lists)?$lists['brands_code']:set_value('brands_code'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('brands_code'); ?></span>
          </div>
          <div class="form-group <?= form_error('brands_name') ? 'has-error' : '' ?>">
            <label for="brands_name" class="col-sm-3 control-label">Nama Brands</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="brands_name" placeholder="Nama Brands" value="<?php echo isset($lists)?$lists['brands_name']:set_value('brands_name'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('brands_name'); ?></span>
          </div>
          <div class="form-group <?= form_error('description') ? 'has-error' : '' ?>">
            <label for="description" class="col-sm-3 control-label">Deskripsi</label>
            <div class="col-sm-6">
              <input type="description" class="form-control" name="description" placeholder="Deskripsi" value="<?php echo isset($lists)?$lists['description']:set_value('description'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('description'); ?></span>
          </div>
           <div class="form-group">
            <label for="status" class="col-sm-3 control-label">Status</label>
            <div class="col-sm-6">
              <select id="select2" class="form-control select2 select2-hidden-accessible" name="status" style="width: 100%;" tabindex="-1" aria-hidden="true">
              </select>
            </div>
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
