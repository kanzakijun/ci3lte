  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <h1 class="m-0">Dashboard</h1>


              <!-- isi konten -->
              <div class="row mt-5">

                  <div class="card text-white bg-dark mb-3 col-lg-6">
                      <div class="card-body">
                          <h1 class="card-title">Welcome, <?= $user['name'] ?></h1>
                      </div>
                  </div>
              </div>

              <div class="container-fluid">
                  <div class="row-">
                      <div class="col-lg-6">
                          <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                          <?= form_error('editMenu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                          <?= $this->session->flashdata('message') ?>
                          <a href="" class=" btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>
                          <table class="table table-hover">
                              <thead>
                                  <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Role</th>
                                      <th scope="col">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php $i = 1; ?>
                                  <?php foreach ($role as $r) : ?>
                                      <tr>
                                          <th scope="row"><?= $i ?></th>
                                          <td><?= $r['role'] ?></td>
                                          <td>
                                              <a href="<?= base_url('admin/roleaccess/') . $r['id'] ?> " class="btn btn-warning">Access</a>
                                              <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editRoleModal<?= $r['id'] ?>">Edit</a>
                                              <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteRoleModal<?= $r['id'] ?>">Delete</a>

                                          </td>
                                      </tr>
                                      <?php $i++; ?>
                                  <?php endforeach; ?>
                              </tbody>
                          </table>
                      </div>
                  </div>

              </div>
              <!-- /.container-fluid -->

          </div>
          <!-- End of Main Content -->

      </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  </div>