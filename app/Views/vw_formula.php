<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<h4 class="box-title">Formula CPL Kurikulum (<?php echo $kurikulum_terpilih[0]['kode_kurikulum'];  ?>)</h4> 
			<p>

			<!-- <a class="btn btn-info waves-effect waves-light" href="<?php // echo site_url('formula/tambah') ?>" > + Tambah CPL</a> -->
			
			<div class="row">
				<div class="col-12">
					<div class="card card-maroon card-tabs">
						<div class="card-header p-0 pt-1">
							<ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
								<li class="pt-2 px-3"><a href="<?php echo site_url('cpmkcpl/tambahcpl') ?>" ><i class="fa fa-plus" title="Edit CPL"></i></a>
								</li>
								<?php $i = 1; foreach($datas as $r) { ?>
								<li class="nav-item">
									<a class="nav-link <?php if ($r->id_cpl_langsung == 'CPL_1'){echo 'active';}  ?>" id="<?php echo $r->id_cpl_langsung;?>-tab" data-toggle="pill" href="#<?php echo $r->id_cpl_langsung	;?>" role="tab" aria-controls="<?php echo $r->id_cpl_langsung;?>" aria-selected="true"><?php echo $r->nama	;?></a>
								</li>
								<?php $i++; } ?>

								<li class="nav-item">
									<a class="nav-link" id="cpmk-tab" data-toggle="pill" href="#cpmk" role="tab" aria-controls="cpmk" aria-selected="true">List Sub-CPL</a>
								</li>
							</ul>
						</div> 
						<div class="card-body">
							<div class="tab-content" id="custom-tabs-two-tabContent">
								<?php $i = 1; foreach($datas as $r) { ?> 
								<div class="tab-pane fade <?php if ($r->id_cpl_langsung == 'CPL_1'){echo 'show active';}  ?>" role="tabpanel" id="<?php echo $r->id_cpl_langsung;?>" aria-labelledby="<?php echo $r->id_cpl_langsung;?>-tab">
								<div class=”col-md-6″>

									<table class="table table-bordered text-center">
									<tr>
										<th><a class="btn btn-block btn-outline-primary btn-sm" href="<?php echo site_url('formula/edit/'.$r->id_cpl_langsung); ?>"><?php echo $r->nama	;?></a></th>
										<th>=</th>
										<?php $z = 1; foreach($rumus_deskriptor as $p) { ?>
										
										<?php if ($p->id_cpl_langsung == $r->id_cpl_langsung) { ?> 
											<th>
											<?php echo " &nbsp; + &nbsp;";
											echo $p->persentasi."&nbsp;";
											?>
											</th>
											<th>
											<a class="btn btn-block btn-outline-secondary btn-sm" href="<?php echo site_url('formula/edit_rumus_deskriptor/'.$p->id_cpl_rumus_deskriptor); ?>"><?php echo $p->nama_deskriptor	;?></a>	
										</th>
										<?php } ?>
										<?php $z++; } ?>
									</tr> 
									</table>
									
								</div>	
								<div class=”col-md-1″>
								</div>
										<?php $i = 1; foreach($data_deskriptor as $d) { 
											if ( $r->id_cpl_langsung == $d->id_cpl_langsung) {
											?> 
										
										<div class="card card-outline card-info">
										<div class="card-header">
											<h4 class="box-title"><a class="btn btn-block btn" href="<?php echo site_url('formuladeskriptor/edit_deskriptor/'.$d->id_deskriptor); ?>"><?php echo $d->nama_deskriptor	;?></a></h4>
											<p>
											<?php echo $d->deskripsi	;?>
											</p>
										</div>
										<div class="card-body">
											<table id="example-edit" class="display" style="width: 100%" >
												<thead>
													<tr>
														<th style="width: 150px;">Bobot (Persen)</th>
														<th style="width: 200px;">Kode CPMK</th>
														<th style="width: 400px;">Nama Mata Kuliah</th>
														
														<th></th>  
													</tr>
												</thead>
												<tfoot > 
													<tr>
														<th>
					
														<?php 
														$jumlah = 0;
														$i = 1; foreach($rumus as $u) { 
														if ($d->id_cpl_rumus_deskriptor == $u->id_deskriptor) { 
															$jumlah += floatval($u->persentasi);
														}
														$i++; }
														//echo '<pre>';  var_dump($p->persentasi); echo '</pre>';
														echo $jumlah;
														?>
														<p style="color: red;">
														<?php
														if ($jumlah != 1) {
																//echo "<br>"." Jumlah bobot"."<br>"."tidak sama "."<br>"."dengan 1";
														}
														?>
														</p>
														</th>
														<th></th>
														<th></th>
														
														<th></th>
													</tr>
												</tfoot>
												<tbody>
													<?php $i = 1; foreach($rumus as $s) { ?>
													<?php if ($d->id_cpl_rumus_deskriptor == $s->id_deskriptor) { ?>
													<tr> 
														<td><?php echo $s->persentasi; ?></td>
														<td><?php echo $s->nama; ?></td>
														<td><?php echo $s->nama_kode.' '.$s->nama_mata_kuliah; ?></td>
														
														<td><a href="<?php echo site_url('formuladeskriptor/edit_formula_deskriptor/'.$s->id_deskriptor_rumus_cpmk); ?>"><i class="fa fa-edit" title="Edit Data produk"></i></a> |
														<a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('formuladeskriptor/hapus_formula_deskriptor/'.$s->id_deskriptor_rumus_cpmk); ?>"><i class="fa fa-trash" title="Hapus Data produk"></i></a> 
														</td>
													</tr>

													<?php } ?>
													<?php $i++; } ?>				 
												</tbody>
											</table>	
											<hr>
										</div>
										<div class="card-footer d-flex justify-content-end">


													<a href="<?php echo site_url('formuladeskriptor/tambah_formula_deskriptor/'.$d->id_cpl_rumus_deskriptor); ?>" ><button type="button" class="btn btn-block btn-secondary">+ Formula CPMK</button></a>

										</div>
										</div>
										
										<?php } $i++; } ?>


								</div>
								
								<?php $i++; } ?>

								<div class="tab-pane fade" role="tabpanel" id="cpmk" aria-labelledby="cpmk-tab">
									<br>
									<h4 class="box-title">List Keseluruhan Deskriptor</h4>
										
									

									<?php $i = 1; foreach($rumus_deskriptor as $d) { ?> 
									<div class="box-content bordered">
										<h4 class="box-title"><a class="btn btn-block btn" href="<?php echo site_url('formuladeskriptor/edit_deskriptor/'.$d->id_deskriptor); ?>"><?php echo $d->nama_deskriptor	;?></a></h4>
										<p>
										<?php echo $d->deskripsi	;?>
										</p>
										<table id="example-edit" class="display" style="width: 100%">
											<thead>
												<tr>
													<th style="width: 300px;">Kode CPMK</th>
													<th style="width: 450px;">Nama Mata Kuliah</th>
													<th style="width: 200px;">Bobot (Persen)</th>
													<th></th>  
												</tr>
											</thead>
											<tfoot>  
												<tr>
													<th>Kode CPMK</th>
													<th>Nama Mata Kuliah</th>
													<th>Bobot (Persen)</th>
													<th></th>
												</tr>
											</tfoot>
											<tbody>
												<?php $i = 1; foreach($rumus as $s) { ?>
												<?php if ($d->id_deskriptor == $s->id_deskriptor) { ?>
												<tr> 
													<td><?php echo $s->nama; ?></td>
													<td><?php echo $s->nama_kode.' '.$s->nama_mata_kuliah; ?></td>
													<td><?php echo $s->persentasi; ?></td>
													<td><a href="<?php echo site_url('formuladeskriptor/edit_formula_deskriptor/'.$s->id_deskriptor_rumus_cpmk); ?>"><i class="fa fa-edit" title="Edit Data produk"></i></a> |
													<a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('formuladeskriptor/hapus_formula_deskriptor/'.$s->id_deskriptor_rumus_cpmk); ?>"><i class="fa fa-trash" title="Hapus Data produk"></i></a>
													</td>
												</tr>

												<?php } ?>
												<?php $i++; } ?>				 
											</tbody>
										</table>	
										<br>
										<div class="col-lg-12 col-xs-12">
											<div class="text-right">

												<a class="btn btn-block btn-success" href="<?php echo site_url('formuladeskriptor/tambah_formula_deskriptor/'.$d->id_deskriptor); ?>" > + Bobot CPMK</a>
											</div>
										</div>
									</div>
									<?php $i++; } ?>
										
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>  
</div>

<div class="tab-pane fade" role="tabpanel" id="cpmk" aria-labelledby="cpmk-tab">
	<div class="col-lg-12 col-xs-12">

	</div>
	
	<!-- /.col-lg-9 col-xs-12 -->
</div>

<?php  //echo '<pre>';  var_dump(substr($p->id_cpl_langsung,3,2)); echo '</pre>'; ?>
<?php //echo '<pre>';  var_dump(substr($d->id_deskriptor,10,2)); echo '</pre>'; ?>