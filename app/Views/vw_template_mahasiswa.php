<!DOCTYPE html>
<html lang="en">
<head> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teknik Sipil APP</title>
  <link rel="icon" href="<?= base_url('assets/icons/internet.ico'); ?>" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/select2/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/toastr/toastr.min.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/jqvmap/jqvmap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/dist/css/adminlte.min.css') ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/daterangepicker/daterangepicker.css') ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/summernote/summernote-bs4.min.css') ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('Adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url('Adminlte/dist/img/IPB.jfif') ?>" alt="AdminLTELogo" height="100" width="100">
  </div>

  <!-- Navbar -->
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url() ?>"  class="brand-link">
      <img src="<?= base_url('Adminlte/dist/img/IPB.jfif') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Teknik Sipil IPB</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('Adminlte/dist/img/SIL.jpg') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url('akun') ?>" class="d-block">Mahasiswa</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item has-treeview">
            <a href="<?= base_url('DashboardMahasiswa') ?>" class="nav-link <?php if (in_array($breadcrumbs, ['DashboardMahasiswa'])) {echo "active";}?>">
            <i class="nav-icon fas fa-university"></i>
            <p>  
              Dashboard
            </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="<?= base_url('reportmahasiswa') ?>" class="nav-link <?php if (in_array($breadcrumbs, ['report'])) {echo "active";}?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Report
            </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="<?= base_url('DashboardMahasiswa/Akun') ?>" class="nav-link <?php if (in_array($breadcrumbs, ['akun'])) {echo "active";}?>">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>
              Akun Setting
            </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="<?= base_url('Auth/logout') ?>" class="nav-link" onclick="return confirm('apakah anda ingin Keluar ?')">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
            <!-- Custom tabs (Charts with tabs)-->
            <?= view($content); ?>
            <!-- /.card -->

          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('Adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('Adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('Adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- Select2 -->
<script src="<?= base_url('Adminlte/plugins/select2/js/select2.full.min.js') ?>"></script>
<!-- Toastr -->
<script src="<?= base_url('Adminlte/plugins/toastr/toastr.min.js') ?>"></script>
<!-- ChartJS -->
<script src="<?= base_url('Adminlte/plugins/chart.js/Chart.min.js') ?>"></script>
<!-- Sparkline -->
<script src="<?= base_url('Adminlte/plugins/sparklines/sparkline.js') ?>"></script>
<!-- JQVMap -->
<script src="<?= base_url('Adminlte/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('Adminlte/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url('Adminlte/plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('Adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<!-- Summernote -->
<script src="<?= base_url('Adminlte/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('Adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('Adminlte/dist/js/adminlte.js') ?>"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('Adminlte/dist/js/pages/dashboard.js') ?>"></script>

<!-- DataTables  & Plugins -->
<script src="<?= base_url('Adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>

<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })

  // DropzoneJS Demo Code End
</script>

 <script>
        $(document).ready(function() {
            <?php if(session()->getFlashdata('success')): ?>
                toastr.success("<?= session()->getFlashdata('success'); ?>");
            <?php endif; ?>

            <?php if(session()->getFlashdata('error')): ?>
                toastr.error("<?= session()->getFlashdata('error'); ?>");
            <?php endif; ?>

            <?php if(session()->getFlashdata('warning')): ?>
                toastr.warning("<?= session()->getFlashdata('warning'); ?>");
            <?php endif; ?>

            <?php if(session()->getFlashdata('info')): ?>
                toastr.info("<?= session()->getFlashdata('info'); ?>");
            <?php endif; ?>
        });
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example3').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
     $('#example4').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
