
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>
  <link rel="icon" href="<?= base_url('assets/icons/internet.ico'); ?>" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/dist/css/adminlte.min.css'); ?>">
  
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-danger">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>SiPenCapil - </b>App</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?php if (session()->getFlashdata('message_login_error')) : ?>
			<div style="color: red;">
					<?php echo 'Login Gagal, pastikan username dan password benar!'; ?>

			</div>
      <?php endif; ?>
      <?php //echo password_hash("admin", PASSWORD_DEFAULT) ?>
      <br>

      <form role="form" method="post" action="<?php echo site_url('Auth/login') ?>" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" class="<?= session('errors.username') ? 'is-invalid' : '' ?>" value="<?= old('username') ?>" maxlength="30" minlength="2" required />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" class="<?= session('errors.password') ? 'is-invalid' : '' ?>" value="<?= old('password') ?>" maxlength="20" minlength="2" required />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-info btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <!-- /.social-auth-links -->

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('Adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('Adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('Adminlte/dist/js/adminlte.min.js') ?>"></script>
</body>
</html>
