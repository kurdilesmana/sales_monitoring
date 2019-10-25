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
                        AND m.parent_id IS NULL
                        AND am.role_id = $roleID
                        AND m.is_active = 1
                        ORDER BY no_order ASC";
            $menu = $this->db->query($queryMenu)->result_array();
            ?>

          <?php foreach ($menu as $m) {
              if ($m['is_parent'] == 1) {
                $parentID = $m['menu_id'];
                $qSubMenu = "SELECT * 
                        FROM user_menu m 
                        INNER JOIN user_access_menu am ON m.id = am.menu_id
                        WHERE m.header_id = $headerID
                        AND m.parent_id = $parentID
                        AND am.role_id = $roleID
                        AND m.is_active = 1
                        ORDER BY no_order ASC";
                $subMenu = $this->db->query($qSubMenu)->result_array();
                ?>
              <li class="treeview <?php echo $this->uri->segment(1) == $m['url'] ? 'active menu-open' : '' ?>">
                <a href="#">
                  <i class="<?php echo $m['icon']; ?>"></i> <span><?= $m['title']; ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <?php foreach ($subMenu as $sm) { ?>
                    <li class="<?php echo $title == $sm['title'] ? 'active' : '' ?>">
                      <a href="<?php echo base_url($sm['url']); ?>">
                        <i class=" <?php echo $sm['icon']; ?>"></i><span><?php echo $sm['title']; ?></span>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
            <?php } else { ?>
              <li class="<?php echo $title == $m['title'] ? 'active' : '' ?>">
                <a href="<?php echo base_url($m['url']); ?>">
                  <i class="<?php echo $m['icon']; ?>"></i><span><?php echo $m['title']; ?></span>
                </a>
              </li>
          <?php }
            } ?>
          <!-- End Foreach Menu -->

        <?php } ?>
      </ul>