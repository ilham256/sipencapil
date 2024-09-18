<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content=""> 

	<title><?php echo $title_print; ?></title>

	<!-- Themify Icon -->
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

	<!-- Data table -->



</head>

<body>


<div class="tab-content" id="myTabContent" >
		<button onclick="window.print()" class="btn btn-default waves-effect waves-light" name="download" value="download" style="align-self: center;"><i class='fa fa-download'> </i> Save/Cetak</button>
	<!-- /.main-content -->
</div>

<div >
		<?= view($content); ?>
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


	<script src="<?php echo base_url() ?>scripts/main.min.js"></script>

	<script>

		
 
			
		function saveDeskriptor() {
			$("#formDeskriptor").submit();
		}

	  $(function () {
	    $("#example1").DataTable();
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	    });
	  });
	</script>

</body>
</html>