<div class="col-lg-12">
	<div class="card">
		<div class="card-body">



			<div class="card card-dark">
				<div class="card-header" style="background-color: #216a8d; color: #FFFFFF;">
				</div>
				<div class="card-body">	
					
								<p>Data Nilai Dibawah Target CPMK (<?php  echo ($target_cpmk); ?>)</p>

						<table class="table"> 
							<thead style="background-color: #216a8d; color: white;  ">
								<tr>
									<th style='font-weight: normal; vertical-align: middle; text-align: center;'>Mata Kuliah</th>
									<th style='font-weight: normal; vertical-align: middle; text-align: center;'>CPMK</th> 
									<th style='font-weight: normal; vertical-align: middle; text-align: center;'>Nilai</th> 
								</tr> 
							</thead>  
							<tbody > 

								<?php foreach ($nilai_dibawah_target as $key) {
									 ?>
								<tr> 
									<th scope="row"><?php  echo $key['MataKuliah']; ?></th> 
									<td style="text-align: justify; "><p><?php  echo $key['CPMK'];  ?></p></td> 
									<td style="text-align: center; "><?php echo $key['Nilai'];  ?></td> 
								</tr> 
								<?php } ?>
							</tbody>  
						</table>
				</div>
				<!-- /.col-xs-12 -->
			</div>
				

		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>

<!-- chart.js Chart -->
<script src="<?php echo base_url() ?>plugin/chart/node_modules/chartjs-plugin-error-bars/node_modules/chart.js/dist/Chart.bundle.min.js"></script>
<script src="<?php echo base_url() ?>plugin/chart/node_modules/chartjs-plugin-error-bars/build/Plugin.Errorbars.js"></script>



 


<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>