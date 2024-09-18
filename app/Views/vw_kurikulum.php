<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<div class="row">
				
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
							<div class="small-box">
								<div class="inner">
									
									<button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">
									<i class="ion ion-plus"></i> &nbsp; Tambah Kurikulum Baru
									</button>
								</div>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-9">
						<div class="card card-maroon">
						<div class="card-header">
							<h3 class="card-title">Sesuaikan Kurikulum</h3>

							<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">

							</div>
							</div>
						</div>
						<!-- /.card-header -->
						<form method="post" action="<?php echo site_url('kurikulum/sesuaikan') ?>" enctype="multipart/form-data">
						<div class="card-body">
							<div class="form-group">
							<select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name='kode'>
								<option value="<?php echo $kurikulum_terpilih	;?>" selected="selected">- <?php echo $kurikulum_terpilih	;?> -</option>
								<?php foreach ($kurikulum as $key) { ?>
								<option value="<?php echo $key['kode_kurikulum']; ?>"><?php echo $key['kode_kurikulum']." - ".$key['nama'];?></option>
								<?php }; ?>
							</select>
							</div>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
						<button type="submit" class="btn btn-info" name="pilih" value="pilih">Pilih</button>
						</div>
						</form>
						<!-- /.card-footer -->
						</div>
						<!-- /.card -->
						</div>
						<!-- ./col -->
					</div>
				</div>

				<br>

				<br>
				<div class="col-12">
					<div class="card card-outline card-danger">
					<div class="card-header">
						<h3 class="card-title">List Kurikulum</h3>

						<div class="card-tools">
						<div class="input-group input-group-sm" style="width: 150px;">

						</div>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
						<thead style="background-color: pink;">
							<tr>
							<th>Kode</th>
							<th>Nama Kurikulum</th>
							<th>Tahun</th>
							<th>Keterangan</th>
							<th></th>
							<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($kurikulum as $key) { ?>
							<tr>
								<td><?php echo $key['kode_kurikulum'];?></td>
								<td><?php echo $key['nama'];?></td>
								<td><?php echo $key['tahun'];?></td>
								<td><?php echo $key['keterangan'];?></td>
								<td>
									<button class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $key['kode_kurikulum'] ?>">Edit</button>
								</td>
								<td>
									<button class="btn btn-warning" data-toggle="modal" data-target="#hapusModal<?= $key['kode_kurikulum'] ?>">Hapus</button>
								</td>
							</tr>
							<!-- /.modal-edit -->
							<div class="modal fade" id="editModal<?= $key['kode_kurikulum'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $key['kode_kurikulum'] ?>" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Edit Kurikulum <?= $key['kode_kurikulum'] ?></h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form method="post" action="<?php echo site_url('kurikulum/edit') ?>" enctype="multipart/form-data">
									<div class="modal-body">
										<div class="form-group">
											<label for="exampleInputEmail1">Kode</label>
											<input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?= $key['kode_kurikulum'] ?>" maxlength="10" disabled>
											<input type="hidden" class="form-control" name="kode" value="<?= $key['kode_kurikulum'] ?>">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Nama</label>
											<input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="nama" maxlength="20" required>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Tahun</label>
											<input type="number" class="form-control" id="exampleInputEmail1" placeholder="" name="tahun" required>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Keterangan</label>
											<textarea class="form-control" rows="3" placeholder="" name="keterangan" maxlength="50"></textarea>
										</div>
									</div>
									<div class="modal-footer justify-content-between">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary" name="simpan" value="simpan" onclick="return confirm('apakah anda ingin mengubah data ?')" >Simpan</button>
									</div>
									</form>
									</div>
									<!-- /.modal-content -->
								</div>								
								<!-- /.modal-dialog -->
							</div>
							<!-- /.modal-hapu -->
							<div class="modal fade" id="hapusModal<?= $key['kode_kurikulum'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel<?= $key['kode_kurikulum'] ?>" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content bg-warning">
									<div class="modal-header">
										<h4 class="modal-title">Hapus Kurikulum <?= $key['kode_kurikulum'] ?></h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p>Menghapus Kurikulum berpotensi menghilangkan data Formula CPL Kurikulum Terkait yang sudah diinput !</p>
										<p>Apakah anda yakin akan tetap menghapus data?</p>
									</div>
									<div class="modal-footer justify-content-between">
										<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
										<a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('kurikulum/hapus/'.$key['kode_kurikulum']); ?>"><button type="submit" class="btn btn-outline-dark" name="simpan" value="simpan">Hapus</button></a>
									</div>
									</div>
									<!-- /.modal-content -->
								</div>								
								<!-- /.modal-dialog -->
							</div>

							<?php }; ?>
						</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Tambah Kurikulum Baru</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form method="post" action="<?php echo site_url('kurikulum/submit_tambah') ?>" enctype="multipart/form-data">
		<div class="modal-body">
			<div class="form-group">
				<label for="exampleInputEmail1">Kode</label>
				<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Kode" name="kode" maxlength="10" required>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Nama</label>
				<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="nama" maxlength="20" required>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Tahun</label>
				<input type="number" class="form-control" id="exampleInputEmail1" placeholder="Tahun" name="tahun" required>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Keterangan</label>
				<textarea class="form-control" rows="3" placeholder="Keterangan ..." name="keterangan" maxlength="50"></textarea>
			</div>
		</div>
		<div class="modal-footer justify-content-between">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary" name="simpan" value="simpan" onclick="return confirm('apakah anda ingin menambahkan data kurikulum ?')" >Simpan</button>
		</div>
		</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="card overflow-auto"></div>


