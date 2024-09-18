<div class="col-lg-12">
	<div class="card">
		<div class="card-body">

			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-info">
							<div class="inner">
								<p>Kurikulum Saat ini</p>

								<h2><?php echo $kurikulum_terpilih	;?></h2>
							</div>
							<div class="icon">
								<i class="ion ion-university"></i>
							</div>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-9">
						<div class="card card-success" >
							<div class="card-header" style="background-color: #002f43; color: white;">
								<h3 class="card-title">Persentase CPMK yang Telah Masuk Berdasarkan Kurikulum (<?php echo $kurikulum_terpilih;?>)</h3>

								<div class="card-tools">
								<div class="input-group input-group-sm" style="width: 150px;">

								</div>
								</div>
							</div>
							<!-- /.card-header -->
							<form method="post" action="<?php echo site_url('data') ?>" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
										<div class="col-sm-3">				
										<select id="angkatan" class="form-control select2 select2-danger" name="tahun">
											<option value="" style="background: lightblue;" selected disabled>- Tahun Angkatan -</option>
											<?php $i = 1; foreach($tahun_masuk as $d) { ?>
											<option value="<?php echo $d->tahun_masuk; ?>"><?php echo $d->tahun_masuk; ?></option>
											<?php $i++; } ?>
										</select>
										</div>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
							<button type="submit" class="btn" style="background-color: 	#002f43; color: white;" name="pilih" value="pilih">Tampilkan</button>
							</div>
							</form>
						<!-- /.card-footer -->
						</div>
					<!-- /.card -->
					</div>
					<!-- ./col -->

				</div>
			</div>
			 <?php if ($status == 'tampilkan') { ?>
			<div class="col-md-12 col-sm-12"> 
				<table id="example1" class="table table-striped table-bordered display" style="width:100%">
					<thead>
						<tr>
							<th>Kode</th>
							<th>Matakuliah</th>
							<th>CPMK</th>
							<th>Persentase Nilai Masuk</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Kode</th>
							<th>Matakuliah</th>
							<th>CPMK</th>
							<th>Persentase Nilai Masuk</th>
						</tr> 
					</tfoot>

					<tbody>
						<?php $i = 1; foreach($data_matakuliah_has_cpmk as $r) { ?>
						<tr>
							<td><?php echo $r["id_matakuliah_has_cpmk"]	; ?></td>
							<td><?php echo $r["id_cpmk_langsung"] ; ?></td>
							<td><?php echo $r["nama_mata_kuliah"] ; ?></td>
							<td><?php echo $persentase[$i] ; ?></td>
						</tr>
						<?php $i++; } ?> 
					</tbody>
				</table>
			</div>
			<?php } ?>
		</div>
		<!-- /.box-content -->
	</div> 
	<!-- /.col-lg-9 col-xs-12 -->
</div>
 
<!-- chart.js Chart -->
<?php //echo '<pre>';  var_dump($nilai_cpl); echo '</pre>'; ?>



<script src="<?php echo base_url() ?>assets/plugin/chart/chartjs/Chart.bundle.min.js"></script>
<script>
	//var arr = <?php //echo json_encode($nilai_cpl); ?>;
	//var arr_max = <?php //echo json_encode($nilai_std_max); ?>;
	//var arr_min = <?php //echo json_encode($nilai_std_min); ?>;
	//var target = [];

	//console.log(arr); 
</script>