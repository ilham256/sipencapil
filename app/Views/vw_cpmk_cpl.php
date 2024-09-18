<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-sm-8">
					<div class="card card-maroon card-tabs">
						<div class="card-header p-0 pt-1">
							<ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
							<li class="pt-2 px-3"><a href="<?php echo site_url('cpmkcpl/tambahcpl') ?>" ><i class="fa fa-plus" title="Edit CPL"></i></a>
							</li>
							<?php $i = 1; foreach($data_cpl as $r) { ?>
							<li class="nav-item">
								<a class="nav-link <?php if ($r->id_cpl_langsung == 'CPL_1'){echo 'active';}  ?>" id="<?php echo $r->id_cpl_langsung;?>-tab" data-toggle="pill" href="#<?php echo $r->id_cpl_langsung;?>" role="tab" aria-controls="<?php echo $r->id_cpl_langsung;?>" aria-selected="true"><?php echo $r->nama	;?></a>
							</li>
							<?php $i++; } ?>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content" id="custom-tabs-two-tabContent">
							<?php $i = 1; foreach($data_cpl as $r) { ?>
							<div class="tab-pane fade <?php if ($r->id_cpl_langsung == 'CPL_1'){echo 'show active';}  ?>" id="<?php echo $r->id_cpl_langsung;?>" role="tabpanel" aria-labelledby="<?php echo $r->id_cpl_langsung;?>-tab">
								<h4 class="box-title"><a  class="btn btn-info waves-effect waves-light" href="<?php echo site_url('cpmkcpl/editcpl/'.$r->id_cpl_langsung); ?>"><?php echo $r->nama	;?></a> 
									| <a onclick="return confirm('Apakah anda ingin mengubah CPL ?')" href="<?php echo site_url('cpmkcpl/editcpl/'.$r->id_cpl_langsung); ?>"><i class="fa fa-edit" title="Edit CPL"></i></a> |
									<a onclick="return confirm('Apakah anda ingin menghapus CPL ?')" href="<?php echo site_url('cpmkcpl/hapuscpl/'.$r->id_cpl_langsung); ?>"><i class="fa fa-trash" title="Hapus Data produk"></i></a>
									</h4> 
									<p>
									<?php echo $r->deskripsi	;?>
									</p>
									<table id="example-edit" class="display" style="width: 100%">
										<thead>
											<tr>
												<th style="width: 200px;">Deskriptor</th>
												<th style="width: 800px;">Deskripsi Deskriptor</th>
												<th style="width: 300px; text-align: center;">Bobot</th>
												<th style="width: 400px;"></th> 
											</tr>
										</thead>
										<tfoot> 
											<tr>
												<th>Total</th>
												<th></th>
												<th style=" text-align: center; font-weight: normal;">
												<b>
												<?php 
												$jumlah = 0;
												$i = 1; foreach($rumus_deskriptor as $p) { 
												if ($r->id_cpl_langsung == $p->id_cpl_langsung) { 
													$jumlah += floatval($p->persentasi);
												}
												$i++; }
												//echo '<pre>';  var_dump($p->persentasi); echo '</pre>';
												echo "<hr>".$jumlah; ?>
												</b>
												<p style="color: red; font-size: 20px;">
												<?php
												if ($jumlah != 1) {
														//echo "<br>"." Jumlah bobot"."<br>"."tidak sama dengan 1";
												}
												?>
												</p>
												</th>
												<th> 
													<?php 
													
												?> 
												</th>
											</tr>
										</tfoot>
										<tbody>
											<?php $i = 1; foreach($rumus_deskriptor as $p) { ?>
											<?php if ($r->id_cpl_langsung == $p->id_cpl_langsung) { ?>
											<tr> 
												<td><br><?php echo $p->nama_deskriptor; ?></td>
												<td><br><?php echo $p->deskripsi; ?></td>
												<td style=" text-align: center;"><br><?php echo ' '.$p->persentasi; ?></td>
												<td><br><a href="<?php  echo site_url('formula/edit_rumus_deskriptor/'.$p->id_cpl_rumus_deskriptor); ?>"><i class="fa fa-edit" title="Edit Formula Bobot"></i></a> |
												<a onclick="return confirm('Apakah anda ingin menghapus Formula Bobot ?')" href="<?php echo site_url('formula/hapus_rumus_deskriptor/'.$p->id_cpl_rumus_deskriptor); ?>"><i class="fa fa-trash" title="Hapus Rumus Bobot"></i></a>
												</td>
											</tr>
											<?php } ?>
											<?php $i++; } ?>				 
										</tbody>
									</table>	
									<br>
									<div class="col-lg-12 col-xs-12">
										<div class="text-right"> 

											<a class="btn btn-block btn" href="<?php echo site_url('cpmkcpl/tambahdeskriptor/'.$r->id_cpl_langsung); ?>" > + Deskriptor</a>
										</div>
									</div>

							</div>
							<?php $i++; } ?>
							<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
								Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
							</div>
							<div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
								Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
							</div>
							<div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
								Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
							</div>
							</div>
						</div>
						<!-- /.card -->
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card card-success">
						<div class="card-header">
							<h3 class="card-title">CPMK</h3>
						</div>
						<div class="card-body">
							<p>
							<a class="btn btn-success waves-effect waves-light" href="<?php echo site_url('cpmkcpl/tambahcpmk') ?>" > + CPMK</a>
							</p>
							<table id="example4" class="display" style="width: 100%">
								<thead>
									<tr style="color: green">
										<th>No</th>
										<th>CPMK</th> 
										<th>Deskripsi</th> 
										<th></th> 
									</tr>  
								</thead> 
								<tbody> 
								<?php $i = 1; foreach($data_cpmk as $r) { ?>
									<tr style="color: green">
										<td scope="row"><?php echo $i; ?></td>
										<td><span class="label label-success"><?php echo $r->nama; ?></span></td>
										<td><?php echo $r->deskripsi	; ?></td>

										<td><a href="<?php echo site_url('cpmkcpl/editcpmk/'.$r->id_cpmk_langsung); ?>"><i class="fa fa-edit" title="Edit Data produk"></i></a> |
										<a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('cpmkcpl/hapuscpmk/'.$r->id_cpmk_langsung); ?>"><i class="fa fa-trash" title="Hapus Data produk"></i></a>
										</td>
									</tr>
								<?php $i++; } ?>
								</tbody> 
							</table>
						</div>
						<div class="card-footer">
						The footer of the card
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div> 
</div>


 