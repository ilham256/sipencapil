<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<h4 class="box-title">Laporan</h4>
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_dosen')?>" ><button class="nav-link">Kinerja CPL Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_dosen')?>" ><button class="nav-link">Kinerja CPMK Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_dosen')?>" ><button class="nav-link">Rapor Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_dosen/mata_kuliah')?>" ><button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Rapor Mata Kuliah</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_dosen/relevansi_ppm')?>" ><button class="nav-link">Relevansi PPM</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_dosen/efektivitas_cpl')?>" ><button class="nav-link">Efektivitas CPL</button></a>
				</li> 
			</ul> 
			<div class="tab-content" id="myTabContent">
				
					<form role="form" id="contactform" action="<?php echo site_url('report_dosen/mata_kuliah')?>" method="post">
						<div class="row mb-3">
							<label for="angkatan" class="col-sm-3 col-form-label">Silahkan Pilih Tahun Angkatan</label>
							<div class="row mb-3">
								<label for="angkatan" class="col-sm-3 col-form-label">Masukan Tahun Angkatan</label>
								<div class="col-sm-6"> 
									<input type="text" name="tahun" class="form-control" placeholder="- Tahun Angkatan -" required>
								</div>
							</div>
						</div>		
						<div class="row mb-3">
							<label for="angkatan" class="col-sm-3 col-form-label">Silahkan Pilih Mata Kuliah</label>
							<div class="col-sm-6">
								<div class="input-group">
								<select id="cpl" class="form-select" name="mk">
									<option value="<?php echo $simpanan_mk; ?>" style="background: lightblue;"><?php echo $simpanan_mk; ?></option>
									<?php $i = 1; foreach($mata_kuliah as $d) { ?>
									<option value="<?php echo $d->kode_mk; ?>"><?php echo $d->kode_mk." (".$d->nama_mata_kuliah.")"; ?></option>
									<?php $i++; } ?>
								</select>
								<button type="submit" class="btn btn-primary" name="pilih_4" value="pilih_4">Pilih</button> 
								</div>
							</div>
						</div>		
					</form>
					<br>
					<div id="printContent">
						<div class="row small-spacing">
						<div class="col-xs-12">
							<div class="invoice-box">
								<div class="row">
									<div class="col-md-12 col-xs-12 text-center">
										<p><strong>INSTITUT PERTANIAN BOGOR<br>
										DEPARTEMEN TEKNIK SIPIL DAN LINGKUNGAN<br>
										P.S. TEKNIK SIPIL DAN LINGKUNGAN
										<br><br>
										</strong>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 col-xs-12">
										Nama Mata Kuliah
									</div>
									<div class="col-md-6 col-xs-12">
										<?php echo $data_mk["0"]->nama_mata_kuliah; ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 col-xs-12">
										Kode
									</div>
									<div class="col-md-6 col-xs-12">
										<?php echo $data_mk["0"]->kode_mk; ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 col-xs-12">
										Beban SKS
									</div>
									<div class="col-md-6 col-xs-12">
										<?php echo $data_mk["0"]->sks; ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 col-xs-12">
										Dosen Pengajar
									</div>
									<div class="col-md-6 col-xs-12">
										<?php echo $data_mk["0"]->dosen; ?><br><br>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 col-xs-12">
										Angkatan
									</div>
									<div class="col-md-6 col-xs-12">
										<?php echo $tahun_mk; ?><br><br>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-xs-12 text-center">
										<p><strong>CPMK Langsung
										</strong>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-xs-12">
										<canvas id="rapor_matakuliah" class="chartjs-chart" width="480" height="220"></canvas>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-12 col-xs-12 text-center">
										<p><strong>Persentase CPMK Langsung
										</strong>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-xs-12 text-center">
										<table class="table table-striped table-bordered display">
											<thead>
												<tr>
													<th></th>
													<?php $i = 1; foreach($mk_raport as $d) { ?>
													<th style="text-align: center;"><?php echo $d; ?></th>
													<?php $i++; } ?>
													<th>Target</th>
													
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Sangat Baik</td>
													<?php $a = 0; foreach($mk_raport as $d) { 
														 $j=0; 
														foreach ($nilai_mk_raport_keseluruhan[$a] as $key) {
															if ($key >= $target_cpl[0]->batas_bawah_kategori_sangat_baik_cpl) {
																$j += 1;
																}
															}
														 ?>
														<td style="text-align: center;" >
														<?php
														$k = round($j/$jumlah[$a] * 100 ,2);
														echo $k."%";
													?></td>
													<?php $a++; } ?>
													<td style="color: blue;"><?php echo $target_cpl[0]->target_jumlah_mahasiswa_sangat_baik_cpl.' %'; ?></td>
													
												</tr>
												<tr>
													<td>Baik</td>
													<?php $a = 0; foreach($mk_raport as $d) { 
														 $j=0; 
														foreach ($nilai_mk_raport_keseluruhan[$a] as $key) {
															if ($key >= $target_cpl[0]->batas_bawah_kategori_baik_cpl && $key < $target_cpl[0]->batas_bawah_kategori_sangat_baik_cpl) {
																$j += 1;
																}
															}
														 ?>
														<td style="text-align: center;" >
														<?php
														$k = round($j/$jumlah[$a]*100,2);
														echo $k."%";
													?></td>
													<?php $a++; } ?>
													<td style="color: blue;"><?php echo $target_cpl[0]->target_jumlah_mahasiswa_baik_cpl.' %'; ?></td>
												</tr>
												<tr>
													<td>Cukup</td>
													<?php $a = 0; foreach($mk_raport as $d) { 
														 $j=0; 
														foreach ($nilai_mk_raport_keseluruhan[$a] as $key) {
															if ($key >= $target_cpl[0]->batas_bawah_kategori_cukup_cpl && $key < $target_cpl[0]->batas_bawah_kategori_baik_cpl) {
																$j += 1;
																}
															}
														 ?>
														<td style="text-align: center;">
														<?php
														$k = round($j/$jumlah[$a]*100,2);
														echo $k."%";
													?></td>
													<?php $a++; } ?>
													<td style="color: blue;"><?php echo $target_cpl[0]->target_jumlah_mahasiswa_cukup_cpl.' %'; ?></td>
												</tr>
												<tr>
													<td>Kurang</td>
													<?php $a = 0; foreach($mk_raport as $d) { 
														 $j=0; 
														foreach ($nilai_mk_raport_keseluruhan[$a] as $key) {
															if ($key > 0 && $key < $target_cpl[0]->batas_bawah_kategori_cukup_cpl) {
																$j += 1;
																}
															}
														 ?>
														<td style="text-align: center;">
														<?php
														$k = round($j/$jumlah[$a]*100,2);
														echo $k."%";
													?></td>
													<?php $a++; } ?>
													<td></td>
												</tr>
												<tr>
													<td>Total</td>
													<?php $a = 0; foreach($mk_raport as $d) { 
														 ?>
														<td style="text-align: center;">
														<?php
														$k = round(100,2);
														echo $k."%";
													?></td>
													<?php $a++; } ?>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<br>

								<div class="row">
									<div class="col-md-12 col-xs-12 text-center">
										<p><strong>CPMK Tak Langsung
										</strong>
										</p>
									</div>
								</div> 
								<div class="row">
									<div class="col-md-12 col-xs-12">
										<canvas id="rapor_matakuliah_tl" class="chartjs-chart" width="480" height="220"></canvas>
									</div>
								</div>
								<br>
								<div class="float-end margin-top-50"></div>
							</div>
							<!-- /.invoice-box -->
						</div>
						<!-- /.col-xs-12 -->
					</div>
					</div>
					<!-- /.row small-spacing -->
				
			</div>
			

		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>
<?php  //echo '<pre>';  var_dump($nilai_mk_raport_keseluruhan); echo '</pre>';?>
<!-- chart.js Chart -->
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/node_modules/chart.js/dist/Chart.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/build/Plugin.Errorbars.js"></script>


<script>
	var temp;
	var title = 'Nilai'

	var labels = ['Raport_Mata_Kuliah'];

	var warna = ['#008000', '#6495ED', '#FF8C00','#DC143C', '#00FFFF', '#00008B','#008B8B', '#4cc9f0', '#f72585','#b5179e','#7209b7', '#560bad', '#480ca8','#3a0ca3', '#3f37c9', '#4361ee','#4895ef', '#4cc9f0'];



	var mk_raport = <?php echo json_encode($mk_raport); ?>;
	var mk_raport_nilai = <?php echo json_encode($nilai_mk_raport); ?>;
	var mk_raport_nilai_tl = <?php echo json_encode($nilai_mk_raport_tak_langsung); ?>;


	var barChartDataError = {
		labels: [title],
		datasets: []
		};

	var p = mk_raport.length;

	for (var j = 0; j < p; j++) {
			barChartDataError.datasets.push(
				{
				label: mk_raport[j],
				backgroundColor: warna[j], 
				borderColor: warna[j],
				pointBackgroundColor: warna[j],
				pointBorderColor: "#fff",
				borderWidth: 1,
				data: [mk_raport_nilai[j]],
				errorBars: {
					'Nilai': {plus: 15, minus: 10},
						}
					},
				)
		}
	

	var ctxRapor = document.getElementById('rapor_matakuliah');

	if (ctxRapor != null) {
			var chartCPMK = new Chart(ctxRapor, {
				type: 'bar',
				data: barChartDataError,
				options: {
					responsive: true,
					legend: {
						position: "right"}
					,
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
									labelString: 'Raport_Mata_Kuliah'
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


	var barChartDataError_tl = {
		labels: [title],
		datasets: []
		};

	var p = mk_raport.length;

	for (var j = 0; j < p; j++) {
			barChartDataError_tl.datasets.push(
				{
				label: mk_raport[j],
				backgroundColor: warna[j], 
				borderColor: warna[j],
				pointBackgroundColor: warna[j],
				pointBorderColor: "#fff",
				borderWidth: 1,
				data: [mk_raport_nilai_tl[j]],
				errorBars: {
					'Nilai': {plus: 0.5, minus: 0.5},
						}
					},
				)
		}
	

	var ctxRapor_tl = document.getElementById('rapor_matakuliah_tl');

	if (ctxRapor_tl != null) {
			var chartCPMK_tl = new Chart(ctxRapor_tl, {
				type: 'bar',
				data: barChartDataError_tl,
				options: {
					responsive: true,
					legend: {
						position: "right"}
					,
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
									labelString: 'Raport_Mata_Kuliah'
								},
							}],
						yAxes: [{
								display: true,
								ticks: {
									beginAtZero: true,
									steps: 1,
									stepValue: 1,
									max: 6
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

	
</script>

