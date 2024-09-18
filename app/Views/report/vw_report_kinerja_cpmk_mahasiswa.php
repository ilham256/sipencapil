<div class="col-lg-12">
	<div class="card">
		<div class="card-body"> 
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6">
						<div class="card card-secondary">
							<div class="card-header" style="background-color: #56c8d3; color: #FFFFFF;">
								<h3 class="card-title"> <i class="nav-icon fas fa-file-alt"></i>&nbsp; Laporan Kinerja CPL - Mahasiswa</h3>
							</div>
							<!-- /.card-header -->
							<form role="form" id="contactform" action="<?php echo site_url('report/kinerja_cpmk_mahasiswa')?>" method="post">
							<div class="card-body">
								<div class="container-fluid">
									<select id="nim_3" class="form-control select2 select2-danger" name="nim" required>
										<option value="" style="background: lightblue;" selected disabled>- Mahasiswa -</option>
										<?php $i = 1; foreach($data_mahasiswa as $d) { ?>
										<option value="<?php echo $d->nim; ?>"><?php echo $d->nim.' - '.$d->nama.' - '.$d->tahun_masuk; ?></option>
										<?php $i++; } ?>
									</select>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-secondary" name="pilih" value="pilih" style="background-color: #56c8d3; color: #FFFFFF;">Tampilkan</button> 
							</div>
							</form>
							<!-- /.card-footer -->
						<!-- /.card -->
						</div>
					</div>
					<!-- ./col -->
					<?php if ($status == 'tampilkan') { ?>
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box" style="background-color: #56c8d3; color: #FFFFFF;">
							<div class="inner">
								<p>Kurikulum</p>

								<h2><?php echo $kurikulum_mahasiswa	;?></h2>
							</div>
							<div class="icon">
								<i class="ion ion-university"></i>
							</div>
						</div>			
					</div>
					<?php } ?>
					
				</div>
			</div>

			<?php if ($status == 'tampilkan') { ?>
			<div class="card card-dark">
				<div class="card-header" style="background-color: #56c8d3; color: #FFFFFF;">
					Data Kinerja CPMK <?php echo $nim ;?>
				</div>
				<div class="card-body">				
					<div class="row row-inline-block small-spacing js__isotope_items" style="">
						<?php
						$list_matakuliah = [];
						foreach($mata_kuliah as $d) {
							array_push($list_matakuliah, $d->nama_mata_kuliah);
							}
							$jml_mk = count($list_matakuliah);
							for ($i=1; $i<=$jml_mk; $i++) {
						?>
						<div class="col-md-4 col-sm-6 col-tb-6 col-xs-12 js__isotope_item beauty" style="">
							<canvas id="pemenuhan_cpmk<?php echo $i?>" class="chartjs-chart"></canvas>
							<p class="text-center"><?php echo $list_matakuliah[$i-1] ?></p>
						</div>
						<?php
							if ($i%3 == 0) {
						?> 
						<div class="col-md-12" style="">
								<p></p>
						</div>
						<?php						
								}
							}
						?>
					</div>
				</div>
			</div>			
			<?php } ?>
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>

<!-- chart.js Chart -->
<script src="<?php echo base_url() ?>plugin/chart/node_modules/chartjs-plugin-error-bars/node_modules/chart.js/dist/Chart.bundle.min.js"></script>
<script src="<?php echo base_url() ?>plugin/chart/node_modules/chartjs-plugin-error-bars/build/Plugin.Errorbars.js"></script>


<script>
		var e = {},
        o = function(min) {
            return Math.round(15 * Math.random()) + min
        };

		var e = {},
        barData = function(mk) {
			var data = {
				labels: ["MK " + mk],
				datasets: [{
					label: "CPMK A",
					backgroundColor: "rgba(58,201,214,1)",
					borderColor: "rgba(58,201,214,1)",
					pointBackgroundColor: "rgba(58,201,214,1)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(58,201,214,1)",
					data: [o(60), o(60), o(60), o(60), o(60), o(60), o(60), o(60)]
				}, {
					label: "CPMK B",
					backgroundColor: "rgba(24,138,226,1)",
					borderColor: "rgba(24,138,226,1)",
					pointBackgroundColor: "rgba(24,138,226,1)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(24,138,226,1)",
					data: [o(70), o(70), o(70), o(70), o(70), o(70), o(70), o(70)]
				}, {
					label: "CPMK C",
					backgroundColor: "rgba(63,81,181,1)",
					borderColor: "rgba(63,81,181,1)",
					pointBackgroundColor: "rgba(63,81,181,1)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(63,81,181,1)",
					data: [o(80), o(80), o(80), o(80), o(80), o(80), o(80), o(80)]
				}]
			};

            return data;
        };
    </script>
 
<script>
	var temp;
	var title = 'Nilai'
	var jumlah_mk = <?php echo(count($mk_cpmk)); ?>;

	var labels = ['Raport_Mata_Kuliah'];

	var warna = ['#e85eab', '#f6c0d7', '#faa773','#f9cf57', '#56c8d3', '#00008B','#008B8B', '#4cc9f0', '#f72585','#b5179e','#7209b7', '#560bad', '#480ca8','#3a0ca3', '#3f37c9', '#4361ee','#4895ef', '#4cc9f0'];

	var arr = <?php echo json_encode($mk_cpmk); ?>;
	var arr_nilai = <?php echo json_encode($nilai_cpmk); ?>;

	var ab = arr.length
	console.log(arr);

	var datai = [];

	for (var i = 0; i < jumlah_mk; i++){

		datai[i] = {
		labels: [title],
		datasets: []
		};

		var l = arr[i].length;
		
		for (var j = 0; j < l; j++) {
			datai[i].datasets.push(
				{
				label: arr[i][j],
				backgroundColor: warna[j],
				borderColor: warna[j],
				pointBackgroundColor: warna[j],
				pointBorderColor: "#fff",
				borderWidth: 1,
				data: [arr_nilai[i][j]],
				errorBars: {
					'Nilai': {plus: 15, minus: 10},
						}
					},
				)
		}

	}


	for (var i = 1; i <= jumlah_mk; i++) {
		var ctxPemenuhanCPMK = document.getElementById('pemenuhan_cpmk' + i);
		if (ctxPemenuhanCPMK != null) {
			var pemenuhanCPMK = new Chart(ctxPemenuhanCPMK, {
				type: 'bar',
				data: datai[i-1],
				options: {
					responsive: true,
					legend: {
						position: 'top',
						display: false,
					},
					title: {
						display: false,
						text: 'Chart.js Error Bars Plugin'
					},
					plugins: {
						chartJsPluginErrorBars: {
							color: 'darkgrey',
							width: 10 | '10px' | '60%',
							lineWidth: 2 | '2px',
							absoluteValues: false
						}
					},
					scales: {
						xAxes: [{
								display: false,
								scaleLabel: {
									display: false,
									labelString: 'CPMK'
								},
							}],
						yAxes: [{
								display: true,
								ticks: {
									beginAtZero: true,
									steps: 10,
									stepValue: 5,
									max: 100
								},
								scaleLabel: {
									display: true,
									labelString: title
								}
							}]
					},
					tooltips: {
						callbacks: {
							label: function(tooltipItem, data) {
								var label = data.datasets[tooltipItem.datasetIndex].label || '';
								var errorBars = data.datasets[tooltipItem.datasetIndex].errorBars;
								if (label) {
									label += ': ';
								}

								var value = Math.round(tooltipItem.yLabel * 100) / 100;
								label += value;
								var stdMin = value - errorBars[title].minus;
								var stdMax = value + errorBars[title].plus;								
								label += ' (' + stdMin + '..' + stdMax + ')'
								return label;
							}
						}
					}
				},
			});			

		}
	}

	
	
</script>

<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>