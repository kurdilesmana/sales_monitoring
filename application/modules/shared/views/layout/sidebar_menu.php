      <ul class="sidebar-menu" data-widget="tree">
        <!-- Query Header Menu -->
        <?php 
          $queryHeaderMenu = "SELECT * FROM user_header_menu";
          $headerMenu = $this->db->query($queryHeaderMenu)->result_array();
        ?>

        <!-- Looping Header Menu -->
        <?php foreach ($headerMenu as $Hm) { ?>
        <li class="header"><?= strtoupper($Hm['header_menu']) ?></li>

        <!-- Query Menu -->
        <?php
          $headerID = $Hm['id'];
          $roleID = $this->session->userdata('user_role');
          $queryMenu = "SELECT * 
                        FROM user_menu m 
                        INNER JOIN user_access_menu am ON m.id = am.menu_id
                        WHERE m.header_id = $headerID
                        AND m.is_active = 1
                        AND am.role_id = $roleID";
          $menu = $this->db->query($queryMenu)->result_array();
        ?>

        <?php foreach ($menu as $m) { ?>
        <li class="<?php echo $title == $m['title'] ? 'active': '' ?>">
        <a href="<?php echo base_url($m['url']); ?>">
          <i class="<?php echo $m['icon']; ?>"></i><span><?php echo $m['title']; ?></span>
        </a>
        </li>  
        <?php } ?>
        <!-- End Foreach Menu -->

        <?php } ?> 
        <!-- End Foreach Header Menu -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li> -->
      </ul>