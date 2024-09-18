<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<h4 class="box-title">Analisis & Evaluasi Pengukuran Langsung / Evaluasi Ketercapaian CPL</h4>
			
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Analisis Kinerja CPL</button>
				</li> 
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('evaluasil/evaluasikinerjacpl')?>" ><button class="nav-link">Analisis Status Pencapaian CPL</button></a>
				</li> 
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" role="tabpanel" id="cpl" aria-labelledby="cpl-tab">

					<div class="box-content">		 
						<h5 class="box-title">Evaluasi Ketercapaian CPL</h5>
					

						<?php 

						//$data_tahun = array_map('intval', explode(',', str_replace(array('[', ']'),'', $tahun)));
						//echo '<pre>';  var_dump($tahun); echo '</pre>'; ?>

						<?php $i=0; foreach($tahun as $key) { ?>
						<table class="table table-bordered display" style="width:100%; vertical-align: middle; text-align: center; ">
							<p><?php echo "Evaluasi Ketercapaian CPL Tahun ".$key ?></p>

							<thead style="background-color: darkblue; color: white; vertical-align: middle; ">
								<tr>
									<th></th>
									<th>Nilai CPL</th>
									<th>Target</th>
									<th>Status</th>
									<th style="width: 350px;"></th>
								</tr>
							</thead>
						
							<tbody> 
								<?php $j=0; foreach($data_cpl as $key2) { ?>
								<tr>
									<td><?php echo $key2->nama ?></td>
									<td><?php echo $nilai_cpl[$i][$j] ?></td>
									<td><?php echo $target_cpl[0]->nilai_target_pencapaian_cpl ?></td>
									<td><?php if ($nilai_cpl[$i][$j]>$target_cpl[0]->nilai_target_pencapaian_cpl) {
										echo "Lebih dari target"; 
									} 
									else { echo "Kurang dari target"; }  ?></td>
									<td>
										<a class="btn waves-effect waves-light" style="color: white; background-color: darkorange;" href="<?php echo site_url('evaluasi_l/identifikasi/'.$key) ?>" > Perlihatkan Nilai CPMK Pendukung </a>
									</td> 

								</tr>
								<?php $j++;}; ?>
							</tbody>
						
						</table>
						<br>
						<br>
						<?php $i++; }; ?>

					</div>
				</div>
				</div>
				
			</div>
			

		</div>
		<!-- /.box-content -->
	</div>
	
	<!-- /.col-lg-9 col-xs-12 -->
</div>

<script src="<?= base_url('plugin/chart/chartjs/Chart.bundle.min.js') ?>"></script>

<script>

</script>
<?php  //echo '<pre>';  var_dump($nilai_cpl); echo '</pre>';?>