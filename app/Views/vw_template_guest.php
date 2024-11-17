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
		<a href="<?php echo site_url('dashboard_guest') ?>" class="logo"><img src="<?php echo base_url() ?>assets/images/Logo_web.png" width="170" /></a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>
	<!-- /.header -->
	<div class="content">
		<div class="navigation">
			<h5 class="title">Guest</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li <?php echo ($breadcrumbs == 'dashboard' || $breadcrumbs == 'infumum' || $breadcrumbs == 'kinumum' || $breadcrumbs == 'kincpmk' || $breadcrumbs == 'kincpl'? ' class = "current active"' : '') ?>>
					<a class="waves-effect parent-item js__control" href="<?php echo site_url()?>"><i class="menu-icon ti-dashboard"></i>Dashboard<span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">

						<li <?php echo ($breadcrumbs == 'infumum' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('dashboard_guest/infumum') ?>">Informasi Umum</a>
						</li>
						<li <?php echo ($breadcrumbs == 'kinumum' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('dashboard_guest/kinumum') ?>">Kinerja CPL</a>
						</li>
						<li <?php echo ($breadcrumbs == 'kincpmk' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('dashboard_guest/kincpmk') ?>">Kinerja CPMK</a>
						</li>
						<li <?php echo ($breadcrumbs == 'kincpl' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('dashboard_guest/kincpl') ?>">Status Pencapaian CPL</a>
						</li>
					</ul>
				</li>
				<li <?php echo ($breadcrumbs == 'matakuliah' || $breadcrumbs == 'profil_matakuliah' || $breadcrumbs == 'kurikulum' || $breadcrumbs == 'cpmklang' || $breadcrumbs == 'cpmktlang' || $breadcrumbs == 'cpltlang' || $breadcrumbs == 'formula' || $breadcrumbs == 'formula_deskriptor' || $breadcrumbs == 'katkin' || $breadcrumbs == 'cpmk_cpl' || $breadcrumbs == 'efektifitas_cpl' || $breadcrumbs == 'relevansi_ppm' ? ' class = "current active"' : '') ?>>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-layers-alt"></i>Input Asesmen<span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li <?php echo ($breadcrumbs == 'kurikulum' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/kurikulum') ?>">Kurikulum</a> 
						</li>
						<li <?php echo ($breadcrumbs == 'cpmk_cpl' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/cpmk_cpl') ?>">CPL dan Deskriptor</a>
						</li>
						<li <?php echo ($breadcrumbs == 'matakuliah' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/matakuliah') ?>">Mata Kuliah menurut Semester</a>
						</li>
						<li <?php echo ($breadcrumbs == 'profil_matakuliah' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/profil_matakuliah') ?>">Profil Mata Kuliah & CPMK</a>
						</li>
						<li <?php echo ($breadcrumbs == 'formula' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/formula') ?>">Formula CPL</a>
						</li>
						<li <?php echo ($breadcrumbs == 'katkin' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/katkin') ?>">Kategori Kinerja</a>
						</li>
						<li <?php echo ($breadcrumbs == 'cpmklang' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/cpmklang') ?>">Nilai CPMK Langsung</a>
						</li>
						<li <?php echo ($breadcrumbs == 'cpmktlang' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/cpmktlang') ?>">Nilai CPMK Tak Langsung</a>
						</li>
						<li <?php echo ($breadcrumbs == 'cpltlang' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/cpltlang') ?>">Nilai CPL Tak Langsung</a>
						</li>
						<li <?php echo ($breadcrumbs == 'efektivitas_cpl' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/efektivitas_cpl') ?>">Evaluasi Efektivitas CPL</a>
						</li>
						<li <?php echo ($breadcrumbs == 'relevansi_ppm' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/relevansi_ppm') ?>">Evaluasi Relevansi PPM</a> 
						</li>
						<li <?php echo ($breadcrumbs == 'epbm' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('input_asesmen_guest/epbm') ?>">Rekap EPBM</a> 
						</li>
					</ul>
				</li>

				<li <?php echo ($breadcrumbs == 'evaluasi_l'  || $breadcrumbs == 'evaluasi_tl' ? ' class = "current active"' : '') ?>>
					<a class="waves-effect parent-item js__control" href="<?php echo site_url()?>"><i class="menu-icon ti-dashboard"></i>Analisis & Evaluasi<span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li <?php echo ($breadcrumbs == 'evaluasi_l' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('analisis_evaluasi_guest/evaluasi_l') ?>">Pengukuran Langsung</a>
						</li>
						<li <?php echo ($breadcrumbs == 'evaluasi_l' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('analisis_evaluasi_guest/evaluasi_tl') ?>">Pengukuran Tak Langsung</a>
						</li>
					</ul>
				</li>
				<li <?php echo ($breadcrumbs == 'report' || $breadcrumbs == 'report_kinerja_cpmk_mahasiswa' || $breadcrumbs == 'report_mahasiswa' || $breadcrumbs == 'report_mata_kuliah' || $breadcrumbs == 'report_relevansi_ppm' || $breadcrumbs == 'report_efektivitas_cpl' || $breadcrumbs == 'report_epbm' ? ' class = "current active"' : '') ?>>
					<a class="waves-effect parent-item js__control" href="<?php echo site_url('report') ?>"><i class="menu-icon ti-layers"></i>Laporan<span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li <?php echo ($breadcrumbs == 'report' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report_guest') ?>">Kinerja CPL Mahasiswa</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_kinerja_cpmk_mahasiswa' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report_guest/kinerja_cpmk_mahasiswa') ?>">Kinerja CPMK Mahasiswa</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_mahasiswa' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report_guest/mahasiswa') ?>">Report Mahasiswa</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_mata_kuliah' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report_guest/mata_kuliah') ?>">Report Matakuliah</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_relevansi_ppm' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report_guest/relevansi_ppm') ?>">Relevansi PPM</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_efektivitas_cpl' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report_guest/efektivitas_cpl') ?>">Efektifitas CPL</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_epbm' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report_guest/report_epbm') ?>">Report EPBM</a>
						</li>
					</ul>
				</li>
				<li <?php echo ($breadcrumbs == 'akun' ? ' class = "current active"' : '') ?>>
					<a class="waves-effect" href="<?php echo site_url('akun_guest') ?>"><i class="menu-icon ti-user"></i>Akun</a>
				</li>


				<li <?php echo ($breadcrumbs == 'logout' ? ' class = "current active"' : '') ?>>
					<a class="waves-effect" href="<?php echo site_url('Auth/logout') ?>"  onclick="return confirm('apakah anda ingin Keluar ?')"><i class="menu-icon"></i>Logout</a>
				</li>
			</ul>
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
