  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <?php foreach ($master as $m) : ?>
            <h1><?= $title ?> - <?= $m['user_username']; ?></h1>
          <?php endforeach; ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->

              <?php foreach ($master as $m) : ?>
                
              <form id="quickForm" action="<?= base_url('user/edit/' . $m['user_id']); ?>" method="post">
              <?= $this->session->flashdata('message'); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputFullname1">Nama Lengkap</label>
                    <input type="text" name="fullname" class="form-control" id="fullname" value="<?= set_value('fullname', $m['user_nama_lengkap']); ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Username</label>
                    <input type="text" name="username" class="form-control" id="username" value="<?= set_value('username', $m['user_username']); ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password1" class="form-control" id="password1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">Retype Password</label>
                    <input type="password" name="password2" class="form-control" id="password2" placeholder="Retype Password">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>

                <?php endforeach; ?>
                
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="<?= base_url('assets/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>

<!-- Page specific script -->
<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      fullname: {
        required: true,
        fullname: true,
      },
      password1: {
        required: true,
        minlength: 5
      },
      password2: {
        required: true,
        minlength: 5
      },
      username: {
        required: true
      },
    },
    messages: {
      fullname: {
        required: "Please enter a fullname",
        fullname: "Please enter a valid fullname"
      },
      password1: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      password2: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      username: {
        required: "Please provide a username"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
</body>
</html>
