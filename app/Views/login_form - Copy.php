<!DOCTYPE html>
<html lang="en">

<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Asesmen OBE PS TIN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/dist/css/adminlte.min.css'); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?= base_url('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'); ?>">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?= base_url('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/dist/css/adminlte.min.css'); ?>">
  <!-- Google Font: Source Sans Pro -->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a ><b> <strong>DIPLOMACY </strong> </b></a>
    <p style="font-size: 30px;"> Sistem Assesmen OBE PS TIN</p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?php if (session()->getFlashdata('message_login_error')) : ?>
			<div style="color: red;">
					<?php echo 'Login Gagal, pastikan username dan password benar!'; ?>

			</div>
      <?php endif; ?>

		<?php //echo password_hash("admin", PASSWORD_DEFAULT) ?>
      <br>
      <form role="form" method="post" action="<?php echo site_url('Auth/login') ?>" enctype="multipart/form-data">
        <div class="input-group mb-4">
          <input type="text" name="username" class="form-control" placeholder="Username" class="<?= session('errors.username') ? 'is-invalid' : '' ?>" value="<?= old('username') ?>" maxlength="30" minlength="2" required />
				<div class="invalid-feedback">
					<?= session('errors.username') ?>
				</div>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" class="<?= session('errors.password') ? 'is-invalid' : '' ?>" value="<?= old('password') ?>" maxlength="12" minlength="2" required />
				<div class="invalid-feedback">
					<?= session('errors.password') ?>
				</div> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">

            <button type="submit" class="btn btn-primary btn-block" value="Login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    <!-- /.login-card-body -->
  </div>
</div>
    <footer class="footer">
      <div class="row">
        <div class="col-lg-5 mb-3">
          <ul class="list-unstyled">
            <li class="mb-2">v.1.1</li>
          </ul>
        </div>
      </div>
    </footer>
</body>

</html>
