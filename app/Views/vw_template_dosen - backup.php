<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content=""> 
	<title>Home - Sistem Asesmen OBE PS TIN</title> 
	<link rel="icon" href="<?= base_url('assets/icons/favicon.ico'); ?>" type="image/x-icon">

	<!-- Themify Icon -->
	<link rel="stylesheet" href="<?= base_url('fonts/themify-icons/themify-icons.css') ?>">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="<?= base_url('plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css') ?>">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="<?= base_url('plugin/waves/waves.min.css') ?>">

	<!-- Jquery UI -->
	<link rel="stylesheet" href="<?= base_url('plugin/jquery-ui/jquery-ui.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('plugin/jquery-ui/jquery-ui.structure.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('plugin/jquery-ui/jquery-ui.theme.min.css') ?>">

	<!-- Data Tables -->
	<link rel="stylesheet" href="<?= base_url('plugin/datatables/media/css/jquery.dataTables.min.css') ?>">

	<!-- Dropify -->
	<link rel="stylesheet" href="<?= base_url('plugin/dropify/css/dropify.min.css') ?>">

	<!-- Main Styles -->
    <link rel="stylesheet" href="<?= base_url('plugin/bootstrap-5.0.1/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">

	<link rel="stylesheet" href="<?= base_url('styles/style.min.css') ?>">

		  <!-- Adminlte -->
	<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url('Adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<link rel="stylesheet" href="<?= base_url('Adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?= base_url('Adminlte/dist/css/adminlte.min.css') ?>">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="script/html5shiv.min.js"></script>
		<script src="script/respond.min.js"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?= base_url('scripts/jquery2.min.js') ?>"></script>
	<script src="<?= base_url('scripts/modernizr.min.js') ?>"></script>
	<script src="<?= base_url('plugin/bootstrap-5.0.1/js/popper.min.js') ?>"></script>
	<script src="<?= base_url('plugin/bootstrap-5.0.1/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
	<script src="<?= base_url('plugin/nprogress/nprogress.js') ?>"></script>
	<script src="<?= base_url('plugin/waves/waves.min.js') ?>"></script>

	<!-- Jquery UI -->
	<script src="<?= base_url('plugin/jquery-ui/jquery-ui.min.js') ?>"></script>
	<script src="<?= base_url('plugin/jquery-ui/jquery.ui.touch-punch.min.js') ?>"></script>

	<!-- Sparkline Chart -->
	<script src="<?= base_url('plugin/chart/sparkline/jquery.sparkline.min.js') ?>"></script>
	<script src="<?= base_url('scripts/chart.sparkline.init.min.js') ?>"></script>

	<!-- Data Tables -->
	<script src="<?= base_url('plugin/datatables/media/datatables/jquery.dataTables.js') ?>"></script>
	<script src="<?= base_url('plugin/datatables/media/js/dataTables.bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('plugin/editable-table/mindmup-editabletable.js') ?>"></script>
	<script src="<?= base_url('scripts/datatables.demo.min.js') ?>"></script>

	<!-- Dropify -->
	<script src="<?= base_url('plugin/dropify/js/dropify.min.js') ?>"></script>
	<script src="<?= base_url('scripts/fileUpload.demo.min.js') ?>"></script>



</head>

<body>
	
<div class="main-menu">
	<header class="header">
		<a href="<?php echo site_url('dashboard_dosen') ?>" class="logo"><img src="<?php echo base_url() ?>assets/images/Logo_web.png" width="170" /></a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>
	<!-- /.header -->
	<div class="content">
		<div class="navigation">
			<h5 class="title">Dosen</h5>

			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
					with font-awesome or any other icon font library -->
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p> <i class="nav-icon menu-icon ti-dashboard"></i> &ensp;
						Dashboard
						<i class="right menu-arrow fa fa-angle-left"></i>
					</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('dashboarddosen/infumum') ?>" class="nav-link"> &ensp;
							<i class="far ti-arrow-circle-right"></i> &ensp;
							<p>Informasi Umum</p>
							</a>
						</li>
					</ul>
				</li>		

				<li class="nav-item has-treeview">
					<a href="<?= base_url('cpltersimpan') ?>" class="nav-link">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p> <i class="nav-icon menu-icon ti-files"></i> &ensp;
						Hasil Pengukuran
					</p>
					</a>
				</li>

				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p> <i class="nav-icon menu-icon ti-dashboard"></i> &ensp;
						Analisis & Evaluasi
						<i class="right menu-arrow fa fa-angle-left"></i>
					</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('evaluasiLDosen') ?>" class="nav-link"> &ensp;
							<i class="far ti-arrow-circle-right"></i> &ensp;
							<p>P Langsung</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('evaluasiTlDosen') ?>" class="nav-link"> &ensp;
							<i class="far ti-arrow-circle-right"></i> &ensp;
							<p>P Tak Langsung</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item has-treeview">
					<a href="report" class="nav-link">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p> <i class="nav-icon menu-icon ti-layers"></i> &ensp;
						Laporan
						<i class="right menu-arrow fa fa-angle-left"></i>
					</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('report') ?>" class="nav-link"> &ensp;
							<i class="far ti-arrow-circle-right"></i> &ensp;
							<p>Kinerja CPL Mahasiswa</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('report/kinerja_cpmk_mahasiswa') ?>" class="nav-link"> &ensp;
							<i class="far ti-arrow-circle-right"></i> &ensp;
							<p>Kinerja CPMK Mahasiswa</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('reportdosen/mahasiswa') ?>" class="nav-link"> &ensp;
							<i class="far ti-arrow-circle-right"></i> &ensp;
							<p>Report Mahasiswa</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('reportdosen/matakuliah') ?>" class="nav-link"> &ensp;
							<i class="far ti-arrow-circle-right"></i> &ensp;
							<p>Report Matakuliah</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('reportdosen/relevansippm') ?>" class="nav-link"> &ensp;
							<i class="far ti-arrow-circle-right"></i> &ensp;
							<p>Relevansi PPM</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('reportdosen/efektivitascpl') ?>" class="nav-link"> &ensp;
							<i class="far ti-arrow-circle-right"></i> &ensp;
							<p>Efektifitas CPL</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('reportdosen/reportepbm') ?>" class="nav-link"> &ensp;
							<i class="far ti-arrow-circle-right"></i> &ensp;
							<p>Report EPBM</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item has-treeview">
					<a href="<?= base_url('akundosen') ?>" class="nav-link">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p> <i class="nav-icon menu-icon ti-user"></i> &ensp;
						Akun
					</p>
					</a>
				</li>

				<li class="nav-item has-treeview">
					<a href="<?= base_url('Auth/logout') ?>" class="nav-link" onclick="return confirm('apakah anda ingin Keluar ?')">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p> <i class="nav-icon menu-icon ti-close"></i> &ensp;
						Logout
					</p>
					</a>
				</li>


				</ul>
			</nav>
			<!-- /.title -->
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>


<!-- /.main-menu -->

<div class="fixed-navbar" <?php if ($breadcrumbs == 'kurikulum'){echo 'style="width: 3500px;"';} ?>>
	<div class="pull-left">
		<!-- <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button> -->
		<h1 class="page-title">DIPLOMACY: Sistem Asesmen OBE PS TIN</h1>
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->

<!-- /#message-popup -->
<div >
	<div class="main-content" <?php if ($breadcrumbs == 'kurikulum'){echo 'style="width: 3500px;"';} ?>>
		<?= view($content); ?>

		<footer class="footer">
			<div class="row">
				<div class="col-lg-5 mb-3">
					<ul class="list-unstyled">
						<li class="mb-2">2021 © DEPARTEMEN TEKNIK SIPIL DAN LINGKUNGAN</li>
					</ul>
				</div>
				<div class="col-6 col-lg-1 mb-3">
					<ul class="list-unstyled">
						<li class="mb-2"><a href="#">Privacy</a></li>
					</ul>
				</div>
				<div class="col-6 col-lg-1 mb-3">
					<ul class="list-unstyled">
						<li class="mb-2"><a href="#">Terms</a></li>
					</ul>
				</div>
				<div class="col-6 col-lg-1 mb-3">
					<ul class="list-unstyled">
						<li class="mb-2"><a href="#">Help</a></li>
					</ul>
				</div>
			</div>
		</footer>
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->

<!-- Modal -->

<div class="modal fade" id="tambahCPMK" role="dialog" aria-labelledby="tambahCPMKLabel">
    <div class="modal-dialog" role="document">    
      <!-- Modal content-->
      	<div class="modal-content">
			<div class="modal-header">		
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="tambahCPMKLabel">Tambah CPMK</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('inventory/checkin'); ?>">					
					<div class="form-group">
						<input type="hidden" id="cpmk_id" name="cpmk_id" />
						<label class="control-label col-sm-3">Kode</label>

						<div class="controls col-sm-9">
							<input type="text" name="kode" class="form-control" placeholder="Kode CPMK" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Capaian</label>
						<div class="controls col-sm-9">
							<textarea class="form-control" id="capaian_cpmk" placeholder="Capaian"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-info btn-sm waves-effect waves-light">Simpan</button>
			</div>
      	</div>      
    </div>
</div>

<div class="modal fade" id="tambahMK" role="dialog" aria-labelledby="tambahMKLabel">
    <div class="modal-dialog" role="document">    
      <!-- Modal content-->
      	<div class="modal-content">
			<div class="modal-header">		
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="tambahMKLabel">Tambah Mata Kuliah</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('inventory/checkin'); ?>">					
					<div class="form-group">
						<input type="hidden" id="mk_id" name="mk_id" />
						<label class="control-label col-sm-3">Kode</label>

						<div class="controls col-sm-9">
							<input type="text" name="kode" class="form-control" placeholder="Kode CPL" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Nama Mata Kuliah</label>

						<div class="controls col-sm-9">
							<input type="text" name="nama_mk" class="form-control" placeholder="Nama Mata Kuliah" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">SKS</label>

						<div class="controls col-sm-9">
							<input type="text" name="sks" class="form-control" placeholder="Jumlah SKS" required>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-info btn-sm waves-effect waves-light">Simpan</button>
			</div>
      	</div>      
    </div>
</div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="<?= base_url('scripts/template.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/plugins/select2/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('Adminlte/dist/js/adminlte.js') ?>"></script>


<script src="<?= base_url('Adminlte/dist/js/adminlte.js') ?>"></script>

<!-- jQuery -->
<script src="<?= base_url('Adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('Adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('Adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('Adminlte/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('Adminlte/dist/js/demo.js') ?>"></script>


<!-- DataTables -->
<script src="<?= base_url('Adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('Adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>



	<script>

		
			
		function saveDeskriptor() {
			$("#formDeskriptor").submit();
		}

	$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#example2')) {
      $('#example2').DataTable().clear().destroy();
    }

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
	</script>

<script>



  $(function () {
    //Initialize Select2 Elements
	$('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    }) 

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>

</body>
</html>
