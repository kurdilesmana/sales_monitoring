<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title"><?php echo $caption ?></h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url() . 'divisibrands/update?id=' . $lists['id_divisi']; ?>" method="post">
        <div class="box-body">
          <?php if (isset($error)) { ?>
            <div class="alert alert-danger alert-dismissible" style="margin-top: 3px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> <?php echo ($error); ?></div>
            </div>
          <?php } ?>
          <div class="form-group <?= form_error('id_divisi') ? 'has-error' : '' ?>" hidden>
            <label for="id_divisi" class="col-sm-3 control-label">id divisi</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="id_divisi" placeholder="Id Divisi" value="<?php echo isset($lists) ? $lists['id_divisi'] : set_value('id_divisi'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('id_divisi'); ?></span>
          </div>
          <div class="form-group <?= form_error('divisi_name') ? 'has-error' : '' ?>">
            <label for="divisi_name" class="col-sm-3 control-label">Nama Divisi</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="divisi_name" placeholder="Nama divisi" value="<?php echo isset($lists) ? $lists['divisi_name'] : set_value('divisi_name'); ?>">
            </div>
            <span class="help-block"><?php echo form_error('divisi_name'); ?></span>
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