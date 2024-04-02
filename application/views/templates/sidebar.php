  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <img src="<?= base_url('assets/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="<?= base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <h5 class="d-block"><?= $user['name'] ?></h5>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                  <!-- Query Menu -->
                  <?php
                    $role_id = $this->session->userdata('role_id');
                    $queryMenu = "SELECT `user_menu`.`id`, `menu` FROM `user_menu` JOIN `user_access_menu` ON `user_menu`.`id` = `user_access_menu`.`menu_id` WHERE `user_access_menu`.`role_id` = $role_id ORDER BY `user_access_menu`.`menu_id` ASC";
                    $menu = $this->db->query($queryMenu)->result_array();
                    ?>

                  <!-- Looping Menu -->
                  <?php foreach ($menu as $m) : ?>

                      <li class="nav-header"><?= $m['menu'] ?></li>

                      <!-- Sub Menu -->
                      <?php
                        $menuId = $m['id'];
                        $querySubMenu = "SELECT * FROM `user_sub_menu` JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id` WHERE `user_sub_menu`.`menu_id` = $menuId AND `user_sub_menu`.`is_active` = 1";
                        $subMenu = $this->db->query($querySubMenu)->result_array();
                        ?>

                      <?php foreach ($subMenu as $sm) : ?>
                          <li class="nav-item">
                              <a href="<?= base_url($sm['url']) ?>" class="nav-link">
                                  <i class="<?= $sm['icon'] ?>"></i>
                                  <p><?= $sm['title'] ?></p>
                              </a>
                          </li>
                      <?php endforeach; ?>

                  <?php endforeach; ?><li class="nav-item">
                      <a href="<?= base_url('auth/logout') ?>" class="nav-link">
                          <i class="fas fa-sign-out-alt nav-icon"></i>
                          <p>Logout</p>
                      </a>
                  </li>

          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>