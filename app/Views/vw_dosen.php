<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<h4 class="box-title">Dosen</h4>
			<div class="form-group">
				<div class="text-right">
					<a class="btn btn-info waves-effect waves-light" href="<?php echo site_url('dosen/tambah') ?>" > + Tambah Dosen</a>
				</div>
				<br> 
			</div> 
			<table id="example1" class="table table-striped table-bordered display" style="width:100%">
				<thead>
					<tr> 
						<th>No.</th>
						<th>NIP</th> 
						<th>Nama</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>No.</th>
						<th>NIP</th> 
						<th>Nama</th>
					</tr>
				</tfoot>

				<tbody> 
                    <?php $i = 1; foreach($datas as $r) { ?>
                    <tr>
                        <td scope="row"><?php echo $i; ?></td>
                        <td><span class="label label-success"><?php echo $r["NIP"]; ?></span></td>
                        <td><?php echo ucwords(strtolower($r["nama_dosen"])); ?></td>
						<td>
                        <a href="#" data-toggle="modal" data-target="#hapusModal<?= $r["NIP"] ?>"><i class="fa fa-trash" title="Hapus Data produk"></i></a>
                        </td>
                    </tr>

					<div class="modal fade" id="hapusModal<?= $r["NIP"] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $r["NIP"] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-warning">
                                <div class="modal-header">
                                    <h4 class="modal-title">Hapus Dosen <?= $r["NIP"] ?></h4>
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
                                    <a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('dosen/hapus/'.$r["NIP"]); ?>"><button type="submit" class="btn btn-outline-dark" name="simpan" value="simpan">Hapus</button></a>
                                </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>								
                            <!-- /.modal-dialog -->
                        </div>
                    <?php $i++; } ?>

				</tbody>
			</table>
			<br>
			<div class="form-group">
			</div>
		</div>
		<!-- /.box-content -->
	</div>
 
</div> 
