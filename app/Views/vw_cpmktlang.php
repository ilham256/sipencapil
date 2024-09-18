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
					
					<div class="col-lg-4">
						<div class="card card-dark">
							<div class="card-header">
								<h3 class="card-title"> <i class="nav-icon fas fa-file-alt"></i>&nbsp; List Nilai CPMK - Tidak Langsung</h3>

								<div class="card-tools">
								<div class="input-group input-group-sm" style="width: 150px;">

								</div>
								</div> 
							</div>
							<!-- /.card-header -->
							<form role="form" id="contactform" action="<?php echo site_url('Cpmktlang')?>" method="post">
							<div class="card-body">
								<div class="form-group">
											<select id="mata_kuliah" class="form-control select2 select2-danger" name="mata_kuliah" required>
												<option value="" style="background: lightblue;" selected disabled>- Mata Kuliah -</option>
												<?php $i = 1; foreach($mata_kuliah as $d) { ?>
												<option value="<?php echo $d->kode_mk; ?>"><?php echo $d->nama_kode.' ('.$d->nama_mata_kuliah.')'; ?></option>
												<?php $i++; } ?>
											</select>
											<p></p>
											<select id="angkatan" class="form-control select2 select2-danger" name="tahun_masuk" required>
												<option value="" style="background: lightblue;" selected disabled>- Tahun Angkatan -</option>
												<?php $i = 1; foreach($tahun_masuk as $d) { ?>
												<option value="<?php echo $d->tahun_masuk; ?>"><?php echo $d->tahun_masuk; ?></option>
												<?php $i++; } ?>
											</select>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-dark" name="pilih" value="pilih">Tampilkan</button> 
							</div>
							</form>
							<!-- /.card-footer -->
						<!-- /.card -->
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-5">
						<div class="card card-success">
							<div class="card-header">
								<h3 class="card-title"> <i class="nav-icon fas fa-file-excel"></i>&nbsp; Upload Excel</h3>

								<div class="card-tools">
								<div class="input-group input-group-sm" style="width: 150px;">

								</div>
								</div> 
							</div> 
							<!-- /.card-header -->

							<div class="card-body">
								<div class="form-group">
										<form role="form" id="contactform" action="<?php echo site_url('cpmktlang/import')?>" method="post" enctype="multipart/form-data">
										<input type="file" id="input-file-to-destroy" name="file" class="dropify" />
										<p class="help margin-top-10">Format file Excel (.xls atau .xlsx), Maksimum ukuran file 5 MB</p>
										<div class="float-start">
											<input class="btn btn waves-effect waves-light" type="submit" value="Upload File Excel">
										</div>
										</form>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
							
							
							</div>
							
						<!-- /.card-footer -->
						</div>
					<!-- /.card -->
					</div>
					<!-- ./col -->

					
				</div>
			</div>			
			<?php if ($status_list_nilai == 'tampilkan') { ?>
				<div class="card card-dark">
					<div class="card-header">
						<h3 class="card-title"> <i class="nav-icon fas fa-file-alt"></i>&nbsp; List Nilai CPMK - Tidak Langsung (Angkatan <?php echo $simpanan_tahun	;?>) Matakuliah : <?php echo $simpanan_mk	;?></h3>
					</div> 
					<div class="card-body">
						<table id="example1" class="table table-striped table-bordered display" style="width:100%">
							<thead>
								<tr>
									<th>NIM</th>
									<th>Nama</th>
									<?php foreach ($data_matakuliah_has_cpmk as $row) { ?>
									<th><?php echo $row->nama	; ?></th>
									<?php } ?>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>NIM</th>
									<th>Nama</th>
									<?php foreach ($data_matakuliah_has_cpmk as $row) { ?>
									<th><?php echo $row->nama	; ?></th>
									<?php } ?>
								</tr> 
							</tfoot>

							<tbody>
			                    <?php $i = 1; foreach($data_mahasiswa as $r) { ?>
			                    <tr>
			                        <td><?php echo $r["nim"]	; ?></td>
			                        <td><?php echo $r["nama"] ; ?></td>

			                        <?php foreach ($data_matakuliah_has_cpmk as $row) { ?>
									<td>
										<?php foreach($datas as $w) { ?>
												<?php if ($w->nim == $r["nim"]) {
													if ($row->id_matakuliah_has_cpmk == $w->id_matakuliah_has_cpmk) {
														echo $w->nilai_tak_langsung;
													} } } ?>
			                    	</td>
									<?php } ?>


			                        
			                    </tr>
			                    <?php $i++; } ?>

							</tbody>
						</table>
					</div> 
				</div>
			<?php } ?>
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>