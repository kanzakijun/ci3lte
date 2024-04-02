  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <h1 class="m-0">Dashboard</h1>


              <!-- isi konten -->

              <div class="card mb-3" style="max-width: 540px;">
                  <div class="row no-gutters">
                      <div class="col-md-4">
                          <img src="<?= base_url('assets/dist/img/') . $user['image'] ?>" class="card-img">
                      </div>
                      <div class="col-md-8">
                          <div class="card-body">
                              <h5 class="card-title"><?= $user['name'] ?></h5>
                              <p class="card-text"><?= $user['email'] ?></p>
                              <p class="card-text"><small class="text-muted">
                                      Member since: <?= date('d F Y', $user['date_created']); ?></small></p>
                          </div>
                      </div>
                  </div>
              </div>


          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  </div>