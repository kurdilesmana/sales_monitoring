<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/dist/img/');
                                                                      echo $this->session->userdata('user_image'); ?>" alt="User profile picture">

        <h3 class="profile-username text-center"><?= $this->session->userdata('user_fullname');  ?></h3>

        <p class="text-muted text-center"><?= $this->session->userdata('user_email');  ?></p>

        <!-- <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Followers</b> <a class="pull-right">1,322</a>
          </li>
          <li class="list-group-item">
            <b>Following</b> <a class="pull-right">543</a>
          </li>
          <li class="list-group-item">
            <b>Friends</b> <a class="pull-right">13,287</a>
          </li>
        </ul>

        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom" id="tabs">
      <ul class="nav nav-tabs">
        <li><a href="#fullProfile" data-toggle="tab">Full Profile</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="fullProfile">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="inputName" placeholder="Name" value="<?php echo isset($lists) ? $lists['name'] : set_value('name'); ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-6">
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo isset($lists) ? $lists['email'] : set_value('email'); ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Brands</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo isset($lists) ? $lists['brand'] : set_value('brand'); ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Divisi</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo isset($lists) ? $lists['divisi'] : set_value('divisi'); ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Date Created</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="inputName" placeholder="Name" value="<?php echo isset($lists) ? $lists['date_created'] : set_value('date_created'); ?>" readonly>
              </div>
            </div>
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>