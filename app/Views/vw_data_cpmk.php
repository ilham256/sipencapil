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
								<h3 class="card-title">Data nilai CPMK Per-Mahasiswa</h3>

								<div class="card-tools">
								<div class="input-group input-group-sm" style="width: 150px;">

								</div>
								</div>
							</div>
							<!-- /.card-header -->
							<form method="post" action="<?php echo site_url('data/data_cpmk') ?>" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">				
										<select id="mahasiswa" class="form-control select2 select2-danger" name="nim">
											<option value="" style="background: lightblue;" selected disabled>- Mahasiswa -</option>
											<?php $i = 1; foreach($list_mahasiswa as $d) { ?>
											<option value="<?php echo $d->nim; ?>"><?php echo $d->nim.' - '.$d->nama.' - '.$d->tahun_masuk; ?></option>
											<?php $i++; } ?>
										</select>
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

			<div class="container-fluid">
				<div class="row">

					<div class="col-lg-5">
						<div class="card card-success" >
							<div class="card-header" style="background-color: #002f43; color: white;">
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<table>
									<tbody>
										<tr>
											<td>Nim</td>
											<td><?php if (empty($data_mahasiswa)) {
												echo "-";
											} else{echo " : ".$data_mahasiswa[0]->nim	;} ?></td>
										</tr>
										<tr>
											<td>Nama Mahasiswa</td>
											<td><?php if (empty($data_mahasiswa)) {
												echo "-";
											} else{echo " : ".$data_mahasiswa[0]->nama	;} ?></td>
										</tr>
										<tr>
											<td>Angkatan</td>
											<td><?php if (empty($data_mahasiswa)) {
												echo "-";
											} else{echo " : ".$data_mahasiswa[0]->tahun_masuk	;} ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
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
									<th>Deskriptor</th>
									<th>Kode</th>
									<th>Matakuliah</th>
									<th>CPMK</th>
									<th>Persentasi Desk</th>
									<th>Nilai</th>
								</tr>
							</thead>
 
							<tbody>
			                    <?php $i = 0; foreach($data_rumus_deskriptor as $r) { ?>
			                    <tr>
			                        <td><?php echo $r->id_deskriptor	; ?></td>
			                        <td><?php echo $r->kode_mk ; ?></td>
			                        <td><?php echo $r->nama_mata_kuliah ; ?></td>
			                        <td><?php echo $r->id_cpmk_langsung ; ?></td>
			                        <td><?php echo ($r->persentasi*100)."%" ; ?></td>
			                        <td><?php if (empty($nilai[$i])) {
			                        	echo "Nilai Kosong" ;
			                        } else {echo round($nilai[$i][0]->nilai_langsung);} ?></td>
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
<?php //echo '<pre>';  var_dump($data_mahasiswa); echo '</pre>'; ?>



