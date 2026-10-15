<div class="col-lg-12">
	<div class="card">
		<div class="card-body">

			<div class="container-fluid">
				<div class="row">
					<!-- ./col -->
					<div class="col-lg-12">
						<div class="card card-success" >
							<div class="card-header" style="background-color: #002f43; color: white;">
								<h3 class="card-title">Data CPMK Mahasiswa yang belum Memenuhi batas minimum</h3>

								<div class="card-tools">
								<div class="input-group input-group-sm" style="width: 150px;">

								</div>
								</div>
							</div>
							<!-- /.card-header -->
							<form method="post" action="<?php echo site_url('datadosen/data_kekurangan_nilai') ?>" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
										<div class="col-sm-3">				
										<select id="angkatan" class="form-control select2 select2-danger" name="tahun">
											<option value="" style="background: lightblue;" selected disabled>- Masukan Tahun Angkatan -</option>
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
			 
			<div class="col-md-12 col-sm-12"> 
						<table id="example1" class="table table-striped table-bordered display" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>NIM</th>
									<th>Nama</th> 
									<th>Angkatan</th> 
									<th>Kode MK</th>
									<th>Matakuliah</th>
									<th>CPMK</th>
									<th>Nilai CPMK</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>No</th>
									<th>NIM</th>
									<th>Nama</th> 
									<th>Angkatan</th> 
									<th>Kode MK</th>
									<th>Matakuliah</th>
									<th>CPMK</th>
									<th>Nilai CPMK</th>
								</tr> 
							</tfoot>
 
							<tbody>
			                    <?php $i = 1; foreach($nilai_cpmk_kurang as $r) { ?>
			                    <tr>
			                        <td><?php echo $i	; ?></td>
			                        <td><?php echo $r->nim ; ?></td>
			                        <td><?php echo $r->nama ; ?></td>
			                        <td><?php echo $r->tahun_masuk ; ?></td>
			                        <td><?php echo $r->kode_mk ; ?></td>
			                        <td><?php echo $r->nama_mata_kuliah ; ?></td>
			                        <td><?php echo str_replace('_',' ',$r->id_cpmk_langsung) ; ?></td>
			                        <td><?php echo $r->nilai_langsung ; ?></td>
                                </tr>
			                    <?php $i++; } ?> 
							</tbody>
						</table>
				</div>

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