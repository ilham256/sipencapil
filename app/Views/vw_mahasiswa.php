<div class="col-lg-12">
	<div class="card">
		<div class="card-body">

			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-primary">
							<div class="inner">
								<p>Mahasiswa</p>

								<p><h2><?php echo $jumlah_mahasiswa	;?></h2> Peserta Didik</p>
								</div>
								<div class="icon">
								<i class="ion ion-person-stalker"></i>
							</div>
						</div>
					</div>
				
					<!-- ./col -->
					<div class="col-lg-5">
						<div class="card card-info">
							<div class="card-header">
								<h3 class="card-title"> <i class="nav-icon fas fa-file-excel"></i>&nbsp; Upload Excel</h3>

								<div class="card-tools">
								<div class="input-group input-group-sm" style="width: 150px;">

								</div>
								</div> 
							</div>
							<!-- /.card-header -->
							<form action="<?= base_url('mahasiswa/uploadExcel') ?>" method="post" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
									<input type="file" name="excel_file" />
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
							<button type="submit" class="btn btn-info" name="pilih" value="pilih"><i class="nav-icon fas fa-file-excel"></i>&nbsp; Upload</button>
							
							</div>
							</form>
						<!-- /.card-footer -->
						</div>
					<!-- /.card -->
					</div>
					<!-- ./col -->

					<div class="col-lg-4 col-5">
						<!-- small box -->
						<div class="card card-success">
							<div class="card-header">
								<h3 class="card-title"> <i class="nav-icon fas fa-file-excel"></i>&nbsp; Download Template Excel</h3>

								<div class="card-tools">
								<div class="input-group input-group-sm" style="width: 150px;">

								</div>
								</div> 
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="form-group">
									<p>NP : Periksa Kode Kurikulum sesuai yang terdaftar dan Pastikan kolom dan baris, sebelum upload</p>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
							<a class="btn btn-success waves-effect waves-light" href="<?php echo site_url('mahasiswa/downloadTemplate/') ?>"><i class="nav-icon fas fa-file-excel"></i>&nbsp; Download Template</a>
							</div>
							<!-- /.card-footer -->
						<!-- /.card -->
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card card-outline card-primary">
					<div class="card-header">
					<h3 class="card-title">List Mahasiswa</h3>

						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">

							</div>
						</div>
					</div>
					<div class="card-body">
						<div>
						<table id="example1" class="table table-striped table-bordered display" style="width:100%">
							<thead>
								<tr> 
									<th>No.</th>
									<th>NIM</th> 
									<th>Nama</th>
									<th>Tahun Angkatan</th>
									<th>Kurikulum</th>
									<th>Status</th>
									
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>No.</th>
									<th>NIM</th> 
									<th>Nama</th>
									<th>Tahun Angkatan</th>
									<th>Kurikulum</th>
									<th>Status</th>
								</tr>
							</tfoot>

							<tbody> 
								<?php $i = 1; foreach($datas as $r) { ?>
								<tr>
									<td scope="row"><?php echo $i; ?></td>
									<td><span class="label label-success"><?php echo $r->nim; ?></span></td>
									<td><a href="#" data-toggle="modal" data-target="#editModal<?= $r->nim ?>"> <?= $r->nama; ?> </a></td>
									<td><?php echo $r->tahun_masuk; ?></td>
									<td><?php echo $r->kode_kurikulum; ?></td>
									<td><?php echo $r->StatusAkademik; ?></td>
								</tr>

									<div class="modal fade" id="editModal<?= $r->nim ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $r->nim ?>" aria-hidden="true">
			                            <div class="modal-dialog">
			                                <div class="modal-content">
			                                <div class="modal-header">
			                                    <h4 class="modal-title">Edit Mahasiswa <?= $r->nim; ?></h4>
			                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                                    <span aria-hidden="true">&times;</span>
			                                    </button>
			                                </div>
			                                <form method="post" action="<?php echo site_url('mahasiswa/submit_edit') ?>" enctype="multipart/form-data">
			                                <div class="modal-body">			
			                                    <div class="form-group">
			                                        <label for="exampleInputEmail1">Kode Kurikulum</label>
			                                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $r->kode_kurikulum	;?>" name="kode_kurikulum" maxlength="10" required >
			                                        <input type="hidden" name="nim" value="<?php echo $r->nim	;?>">

			                                    </div>
			                                    <div class="form-group">
			                                        <label for="exampleInputEmail1">Nama</label>
			                                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $r->nama	;?>" name="nama" maxlength="64" required>
			                                    </div>
			                                    <div class="form-group">
			                                        <label for="exampleInputEmail1">Tahun Masuk</label>
			                                        <input type="number" class="form-control" id="exampleInputEmail1" value="<?php echo $r->tahun_masuk	;?>" name="tahun_masuk" required>
			                                    </div>
			                                    <div class="form-group">
			                                        <label for="exampleInputEmail1">Status Akademik</label>
			                                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $r->StatusAkademik	;?>" name="StatusAkademik" maxlength="32" required>
			                                    </div>
			                                </div>
			                                <div class="modal-footer justify-content-between">
			                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			                                    <button type="submit" class="btn btn-primary" name="simpan" value="simpan" onclick="return confirm('Save Data ?')" >Simpan</button>
			                                </div>
			                                </form>
			                                </div>
			                                <!-- /.modal-content -->
			                            </div>								
			                            <!-- /.modal-dialog -->
			                        </div>
								<?php $i++; } ?>

							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.box-content -->
	</div>

</div> 
