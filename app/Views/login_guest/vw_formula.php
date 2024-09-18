<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<h4 class="box-title">Formula CPL</h4>
			<p>

			<!-- <a class="btn btn-info waves-effect waves-light" href="<?php // echo site_url('formula/tambah') ?>" > + Tambah CPL</a> -->
			
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				 

				<?php $i = 1; foreach($datas as $r) { ?>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php if ($r->id_cpl_langsung == 'CPL_1'){echo 'active';}  ?>" id="<?php echo $r->id_cpl_langsung	;?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo $r->id_cpl_langsung	;?>" type="button" role="tab" aria-controls="<?php echo $r->id_cpl_langsung	;?>" aria-selected="false"><?php echo $r->nama	;?></button>
				</li>
				<?php $i++; } ?>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="cpmk-tab" data-bs-toggle="tab" data-bs-target="#cpmk" type="button" role="tab" aria-controls="cpmk" aria-selected="false">List Deskriptor</button>
				</li>
				
			</ul> 

			<div class="tab-content" id="myTabContent">
			<?php $i = 1; foreach($datas as $r) { ?> 
			<div class="tab-pane fade <?php if ($r->id_cpl_langsung == 'CPL_1'){echo 'show active';}  ?>" role="tabpanel" id="<?php echo $r->id_cpl_langsung;?>" aria-labelledby="<?php echo $r->id_cpl_langsung;?>-tab">
			<div class=”col-md-6″>


				<?php echo $r->nama	;?>
				&nbsp; =
				<?php $i = 1; foreach($rumus_deskriptor as $p) { ?>
				<?php if ($p->id_cpl_langsung == $r->id_cpl_langsung) {
					echo " &nbsp; + &nbsp;";
					echo $p->persentasi."&nbsp;";
				  ?> 
				<?php echo '('.$p->nama_deskriptor.')'	; }?>
				<?php $i++; } ?>
				
			</div>	
			<div class=”col-md-1″> 
			<br>


			</div>


					<?php $i = 1; foreach($data_deskriptor as $d) { 
						if ( substr($r->id_cpl_langsung,3,2) == substr($d->id_deskriptor,10,2)) {
						?> 
					<div class="box-content bordered">
						<h4 class="box-title"><?php echo $d->nama_deskriptor	;?></h4>
						<p>
						<?php echo $d->deskripsi	;?>
						</p>
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
									if ($d->id_deskriptor == $u->id_deskriptor) { 
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
								<?php if ($d->id_deskriptor == $s->id_deskriptor) { ?>
								<tr> 
									<td><?php echo $s->persentasi; ?></td>
									<td><?php echo $s->nama; ?></td>
									<td><?php echo $s->nama_kode.' '.$s->nama_mata_kuliah; ?></td>
									
									<td>
			                        </td>
								</tr>

								<?php } ?>
								<?php $i++; } ?>				 
							</tbody>
						</table>	
						<br>
						
					</div>
					<?php } $i++; } ?>


			</div>
			<?php $i++; } ?>

					<div class="tab-pane fade" role="tabpanel" id="cpmk" aria-labelledby="cpmk-tab">
						<br>
						<h4 class="box-title">List Keseluruhan Deskriptor</h4>
							
						

						<?php $i = 1; foreach($data_deskriptor as $d) { ?> 
						<div class="box-content bordered">
							<h4 class="box-title"><?php echo $d->nama_deskriptor	;?></h4>
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
										<td>
				                        </td>
									</tr>

									<?php } ?>
									<?php $i++; } ?>				 
								</tbody>
							</table>	
							<br>
							<div class="col-lg-12 col-xs-12">
								
							</div>
						</div>
						<?php $i++; } ?>
							
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