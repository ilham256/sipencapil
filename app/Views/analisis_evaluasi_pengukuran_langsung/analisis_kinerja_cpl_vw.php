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
					</div>
					<!-- ./col -->
					<div class="col-lg-9">
						<div class="card card-success" >
							<div class="card-header" style="background-color: #6a0dad; color: white;">
								<h3 class="card-title">Analisis & Evaluasi Pengukuran Langsung</h3>

								<div class="card-tools">
								<div class="input-group input-group-sm" style="width: 150px;">

								</div>
								</div>
							</div>
							<!-- /.card-header -->
							<form method="post" action="<?php echo site_url('evaluasil') ?>" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<select id="angkatan-min" class="form-control select2 select2-danger" name="tahun_masuk_min">
												<option value="" style="background: lightblue;" selected disabled>- Tahun Angkatan -</option>
												<?php $i = 1; foreach($tahun_masuk as $d) { ?>
												<option value="<?php echo $d->tahun_masuk; ?>"><?php echo $d->tahun_masuk; ?></option>
												<?php $i++; } ?>
											</select>
										</div>
										<div class="input-group-append">
											<span class="input-group-text"> <i class="fas fa-arrows-alt-h"></i> </span>
										</div>
										<div class="input-group-append">
											<select id="angkatan-max" class="form-control select2 select2-danger" name="tahun_masuk_max">
												<option value="" style="background: lightblue;" selected disabled>- Tahun Angkatan -</option>
												<?php $i = 1; foreach($tahun_masuk as $d) { ?>
												<option value="<?php echo $d->tahun_masuk; ?>"><?php echo $d->tahun_masuk; ?></option>
												<?php $i++; } ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
							<button type="submit" class="btn" style="background-color: #6a0dad; color: white;" name="pilih" value="pilih">Tampilkan</button>
							</div>
							</form>
						<!-- /.card-footer -->
						</div>
					<!-- /.card -->
					</div>
					<!-- ./col -->

				</div>
			</div>

			<div>				
				<div class="card" style="">		 
					<div class="card-body">
					<?php 
					$list_angkatan = [];
					foreach($tahun_masuk_select as $d) {
						array_push($list_angkatan, $d);
						}

					$jml_mk = count($list_angkatan);

					
					?>

					<h4 class="box-title">Data Analisis Kinerja CPL tahun <?php echo $simpanan_tahun_min; if ($simpanan_tahun_max > $simpanan_tahun_min) {
						echo " - ".$simpanan_tahun_max;
					} ?></h4>
					<br>
					<canvas id="evaluasi_cpl_pertama" class="chartjs-chart" width="480" height="220"></canvas>
					<br>


					<?php
					
					//echo '<pre>';  var_dump($list_angkatan); echo '</pre>';
					?>
					</div>
				</div>


				<div class="text-right">
					<?php 

					//$data_tahun = array_map('intval', explode(',', str_replace(array('[', ']'),'', $tahun)));
					//echo '<pre>';  var_dump($tahun_masuk_select); echo '</pre>'; ?>
			
			</div>
		</div>
		<!-- /.box-content -->
	</div>
	
	<!-- /.col-lg-9 col-xs-12 -->
</div>

<script src="<?= base_url('plugin/chart/chartjs/Chart.bundle.min.js') ?>"></script>

<script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>

<!-- ChartJS -->
<script src="<?= base_url('plugins/chart.js/Chart.min.js') ?>"></script>

<script>
		var e = {},
        o = function(min) {
            return Math.round(15 * Math.random()) + min
        };

	var arr = <?php echo json_encode($nilai_cpl); ?>;
	var arr_max = <?php echo json_encode($nilai_std_max); ?>;
	var arr_min = <?php echo json_encode($nilai_std_min); ?>;
	var target = <?php echo json_encode($target); ?>;
	var nama_cpl = <?php echo json_encode($nama_cpl); ?>;
	var des_cpl = <?php echo json_encode($des_cpl); ?>;
	var tahun_masuk_select = <?php echo json_encode($tahun_masuk_select); ?>;

	var title = 'Nilai'
	var data_target_cpl = <?php echo $katkin[0]->nilai_target_pencapaian_cpl; ?>;
	var warna = ['#1C9B8E','#0F1E64', '#53DFD1', '#50655B','#614729', '#493620', '#4361ee','#4895ef', '#4cc9f0','#322618','#1d170f','#7209b7', '#560bad', '#480ca8','#3a0ca3', '#3f37c9'];


	
	var datai = [];
	var a = arr.length
	
		radarDataError = function() {
			var data = {
				labels: nama_cpl,
				datasets: []
			};

			for (var j = 0; j < arr.length; j++) {
			data.datasets.push(
				{
				label: tahun_masuk_select[j],
				backgroundColor: warna[j],
				borderColor: warna[j],
				pointBackgroundColor: warna[j],
				pointBorderColor: "#00FF00",
				borderWidth: 1,
				data: arr[j],
				}
				)
			}
            return data;
        };



    var cpl_descriptions = des_cpl;	
	var length_line = 68;
	var options = { 
			
			legend: {
				position: "right",
				labels: {  
			        fontColor:'green',
			        fontSize: 14,  
			        boxWidth:27,
			        usePointStyle: true,			        
			      } 
			},

			elements: {
				line: {
					borderWidth: 4
				},
				
			},

			scales: {
				yAxes: [{
					stacked: false,
                 	ticks: {
                        beginAtZero: true 
                    }
				}]

			},

			plugins: {
				filler: {
					propagate: false
				},
				'samples-filler-analyser': {
					target: 'chart-analyser'
				}
			},
			interaction: {
				intersect: false
			},
			tooltips: {
				callbacks: {
					label: function(tooltipItem, data) {
						var label = data.datasets[tooltipItem.datasetIndex].label || '';
						if (label) {
							label += ': ';
						}
						label += Math.round(tooltipItem.yLabel * 100) / 100;

						var labels = [label];

						var desc = cpl_descriptions[tooltipItem.index];

						while (desc.length>length_line) {
							var desc_line = desc.substring(0, length_line);
							var spaceIndex = desc_line.lastIndexOf(" ") + 1;
							var sentence = desc_line.substr(0, spaceIndex);
							desc = desc.substring(spaceIndex);
							labels.push(sentence);
						}
						labels.push(desc);

						return labels;
					}
				}
			}
		};

	
		var ctxEvaluasiCPL = document.getElementById('evaluasi_cpl_pertama');

		if (ctxEvaluasiCPL != null) {
			var chartCPL = new Chart(ctxEvaluasiCPL, {
				type: 'bar',
				data: radarDataError(),
				options: options,
			});
		}

</script>
<?php  //echo '<pre>';  var_dump($nilai_cpl); echo '</pre>';?>