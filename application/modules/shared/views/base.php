<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('layout/head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <?php $this->load->view('layout/main_header'); ?>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php $this->load->view('layout/sidebar_menu'); ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php $this->load->view('layout/content_header'); ?>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php echo isset($content)?$content:'no_content'; ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <?php $this->load->view('layout/footer'); ?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <?php $this->load->view('layout/control_sidebar'); ?>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php $this->load->view('layout/js'); ?>
<?php echo isset($script)?$script:'no_content'; ?>
</body>
</html>
