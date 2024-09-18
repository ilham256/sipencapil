<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<h4 class="box-title">Profil Mata Kuliah - Kurikulum (<?php echo $kurikulum_terpilih;?>)</h4>
 		</div >
		<style>
			/* CSS to hide the table header only on this page */
			#example3 thead {
			display: none;
			}

			
		</style>
		 <div class="card-body">
			<div class="card card-outline card-danger">
              <div class="card-header">
                <h3 class="card-title">List Matakuliah Kurikulum (<?php echo $kurikulum_terpilih;?>)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example3" class="table table-sm"" >
                  <thead>
                    <tr>

                        <th style="width: 150px;"></th> 
						<th style="text-align: right;">Kode</th> 

                    </tr>  
                  </thead>
                  <tbody style="text-align: left;"> 
				  		<?php $i = 1; foreach($datas as $r) { ?>
                        <tr>

                            <td style="width: 200px;">
								<b>	
									<p></p>
									<p> Kurikulum </p>
									<p> Kode</p>
									<p> Matakuliah</p>
									<p> CPMK Terdaftar</p>
									<p></p>
								</b>
							</td>
							<td>	<p></p>
									<p><?php echo $r->kode_kurikulum;?></p>
									<p><?php echo $r->kode_mk;?></p>
									<p><?php echo $r->nama_mata_kuliah;?></p>
										<?php $i = 1; foreach($rumus as $p) { ?>
										<?php if ($r->kode_mk == $p->kode_mk) { ?>

											<a href="#" data-toggle="modal" data-target="#editModal<?= $p->id_matakuliah_has_cpmk ?>"><?php echo $p->nama; ?></a>
											<p><?php echo $p->deskripsi_matakuliah_has_cpmk; ?></p>
											<div class="modal fade" id="editModal<?= $p->id_matakuliah_has_cpmk ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $p->id_matakuliah_has_cpmk ?>" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Data <?= $p->nama; ?></h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form method="post" action="<?php echo site_url('profilmatakuliah/submit_edit_matakuliah_has_cpmk') ?>" enctype="multipart/form-data">
													<div class="modal-body">			
														<div class="form-group">
															<label for="exampleInputEmail1">Kode Matakuliah</label>
															<input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $p->kode_mk	;?>" name="kurikulum" disabled>
															<input type="hidden" name="id_matakuliah_has_cpmk" value="<?php echo $p->id_matakuliah_has_cpmk	;?>">
															<input type="hidden" name="mk" value="<?php echo $p->kode_mk	;?>">
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">CPMK</label>
															<input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $p->nama	;?>" name="cpmk" disabled>
															<input type="hidden" name="cpmk" value="<?php echo $p->id_cpmk_langsung	;?>">
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">Deskripsi</label>
															<textarea class="form-control" rows="3" name="deskripsi" maxlength="500"><?php echo $p->deskripsi_matakuliah_has_cpmk; ?></textarea>
														</div>
													</div>
													<div class="modal-footer justify-content-between">
														
														<button type="submit" class="btn btn-primary" name="simpan" value="simpan" onclick="return confirm('Save Data ?')" >Simpan Perubahan</button>
													</div>
													</form>
													<div class="modal-footer justify-content-between">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<a onclick="return confirm('apakah anda ingin menghapus data <?php echo $p->nama	;?> pada matakuliah <?php echo $p->kode_mk	;?>')" href="<?php echo site_url('profilmatakuliah/hapus_matakuliah_has_cpmk/'.$p->id_matakuliah_has_cpmk); ?>"><button type="submit" class="btn btn btn-danger" name="hapus" value="hapus">Hapus</button></a>
													</div>
													
													</div>
													<!-- /.modal-content -->
												</div>								
												<!-- /.modal-dialog -->
											</div>

										<?php } ?>
										<?php $i++; } ?>
									</p>
									<p style="text-align: right;"><button type="submit" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#tambahModal<?= $r->kode_mk ?>"><i class="ion ion-plus"></i> &nbsp; Tambah CPMK</button></p>

									<div class="modal fade" id="tambahModal<?= $r->kode_mk ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $r->kode_mk ?>" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Data <?= $p->nama; ?></h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form method="post" action="<?php echo site_url('profilmatakuliah/submit_tambah_matakuliah_has_cpmk') ?>" enctype="multipart/form-data">
											<div class="modal-body">			
												<div class="form-group">
													<label for="exampleInputEmail1">Kode Matakuliah</label>
													<input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $p->kode_mk	;?>" name="kurikulum" disabled>
													<input type="hidden" name="mk" value="<?php echo $r->kode_mk	;?>">
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1">CPMK</label>
													<select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name='cpmk'>
														<?php foreach ($cpmk as $key) { ?>
														<option value="<?php echo $key->id_cpmk_langsung; ?>"><?php echo $key->nama ;?></option>
														<?php }; ?>
													</select>
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1">Deskripsi</label>
													<textarea class="form-control" rows="3" placeholder="Deskripsi . . . ." name="deskripsi" maxlength="500" required></textarea>
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
							</td>

                        </tr>
						<?php $i++; } ?>
                  </tbody> 

                </table>
              </div>
              <!-- /.card-body -->
            </div>
		<div>
		
	</div>

</div>




<?php //echo '<pre>';  var_dump($rumus); echo '</pre>';  ?>