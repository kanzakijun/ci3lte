  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <?php foreach ($master as $m) : ?>
            <h1><?= $title ?> - <?= $m['bank_atas_nama']; ?></h1>
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
              <form id="quickForm" action="<?= base_url('bank/edit/'.$m['bank_id']) ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputBanknama1">Nama Bank</label>
                    <input type="text" name="bank_nama" class="form-control" id="bank_nama" placeholder="Nama Bank" value="<?= set_value('bank_nama', $m['bank_nama']); ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Nomor Rekening</label>
                    <input type="text" name="norek" class="form-control" id="norek" placeholder="Nomor Rekening" value="<?= set_value('norek', $m['bank_rekening']); ?>">
                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Atas Nama</label>
                    <input type="text" name="an" class="form-control" id="an" placeholder="Atas Nama" value="<?= set_value('an', $m['bank_atas_nama']); ?>">
                    <?= form_error('an', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
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
      bank_nama: {
        required: true,
        bank_nama: true,
      },
      norek: {
        required: true,
      },
      an: {
        required: true,
      },
    },
    messages: {
      bank_nama: {
        required: "Please enter a Bank name",
        bank_nama: "Please enter a valid Bank name"
      },
      norek: {
        required: "Please provide a nomor rekening"
      },
      an: {
        required: "Please provide a atas nama",
      },
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
