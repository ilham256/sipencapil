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
                        <div class="small-box">
                            <div class="inner">
                                
                                <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modal-default">
                                <i class="ion ion-plus"></i> &nbsp; Tambah Matakuliah Baru
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
                    <form method="post" action="<?php echo site_url('matakuliah/sesuaikan') ?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                        <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name='kode'>
                            <option value="<?php echo $kurikulum_terpilih	;?>" selected="selected" disabled >- <?php echo $kurikulum_terpilih	;?> -</option>
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
            <div class="card card-outline card-danger">
              <div class="card-header">
                <h3 class="card-title">List Matakuliah</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th> 
                        <th>Mata Kuliah</th> 
                        <th>SKS</th>  
                        <th></th> 
                    </tr>  
                  </thead>
                  <tbody> 
                    <?php $i = 1; foreach ($datas as $r) { ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $r->kode_mk; ?></td>
                            <td><a href="#" data-toggle="modal" data-target="#editModal<?= $r->kode_mk ?>"> <?= $r->nama_mata_kuliah; ?> </a></td>
                            <td><?= $r->sks; ?></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#hapusModal<?= $r->kode_mk ?>"><i class="fa fa-trash" title="Hapus Data produk"></i></a>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal<?= $r->kode_mk ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $r->kode_mk ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Mata Kuliah <?= $r->kode_mk; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="<?php echo site_url('matakuliah/submit_edit') ?>" enctype="multipart/form-data">
                                <div class="modal-body">			
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kurikulum</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $kurikulum_terpilih	;?>" name="kurikulum" disabled>
                                        <input type="hidden" name="kode_kurikulum" value="<?php echo $kurikulum_terpilih	;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kode Mata Kuliah</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $r->kode_mk	;?>" name="kode_mata_kuliah_default" maxlength="10" disabled>
                                        <input type="hidden" name="kode_mata_kuliah" value="<?php echo $r->kode_mk	;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Mata Kuliah</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $r->nama_mata_kuliah	;?>" name="nama_mata_kuliah" maxlength="30" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jumlah SKS</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $r->sks	;?>" name="sks" maxlength="10" required>
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
                        <!-- /.modal-hapu -->
                        <div class="modal fade" id="hapusModal<?= $r->kode_mk ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $r->kode_mk ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-warning">
                                <div class="modal-header">
                                    <h4 class="modal-title">Hapus Mata Kuliah <?= $r->kode_mk." - ".$r->nama_mata_kuliah ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Menghapus Matakuliah berpotensi menghilangkan data Formula CPL Kurikulum Terkait yang sudah diinput !</p>
                                    <p>Apakah anda yakin akan tetap menghapus data?</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                    <a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('matakuliah/hapus/'.$r->kode_mk); ?>"><button type="submit" class="btn btn-outline-dark" name="simpan" value="simpan">Hapus</button></a>
                                </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>								
                            <!-- /.modal-dialog -->
                        </div>
                    <?php $i++; } ?>
                  </tbody> 
                  <tfoot>
                  <tr>
                    <th>#</th>
                        <th>Kode</th> 
                        <th>Mata Kuliah</th> 
                        <th>SKS</th> 
                        <th></th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Tambah Matakuliah</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form method="post" action="<?php echo site_url('matakuliah/submit_tambah') ?>" enctype="multipart/form-data">
		<div class="modal-body">			
			<div class="form-group">
				<label for="exampleInputEmail1">Kurikulum</label>
				<input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $kurikulum_terpilih	;?>" name="kurikulum" disabled>
                <input type="hidden" name="kode_kurikulum" value="<?php echo $kurikulum_terpilih	;?>">
			</div>
            <div class="form-group">
				<label for="exampleInputEmail1">Kode Mata Kuliah</label>
				<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Kode" name="kode_mata_kuliah" maxlength="10" required>
			</div>
            <div class="form-group">
				<label for="exampleInputEmail1">Nama Mata Kuliah</label>
				<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="nama_mata_kuliah" maxlength="30" required>
			</div>
            <div class="form-group">
				<label for="exampleInputEmail1">Jumlah SKS</label>
				<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Jumlah SKS" name="sks" maxlength="10" required>
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
<!-- /.modal -->
