<div class="col-lg-12">
	<div class="card">
		<div class="card-body">	
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6">
						<div class="card card-secondary">
							<div class="card-header" style="background-color: #FF6F61; color: #FFFFFF;">
								<h3 class="card-title"> <i class="nav-icon fas fa-file-alt"></i>&nbsp; Laporan Kinerja CPL - Mahasiswa</h3>
							</div>
							<!-- /.card-header -->
							<form role="form" id="contactform" action="<?php echo site_url('reportdosen')?>" method="post">
							<div class="card-body">
								<div class="container-fluid">
									<select id="nim_3" class="form-control select2 select2-danger" name="nim_3" required>
										<option value="" style="background: lightblue;" selected disabled>- Mahasiswa -</option>
										<?php $i = 1; foreach($data_mahasiswa as $d) { ?>
										<option value="<?php echo $d->nim; ?>"><?php echo $d->nim.' - '.$d->nama.' - '.$d->tahun_masuk; ?></option>
										<?php $i++; } ?>
									</select>
									<p></p>
									<select id="cpl" class="form-control select2 select2-danger" name="cpl" required>
										<option value="" style="background: lightblue;" selected disabled>- CPL -</option>
										<?php $i = 1; foreach($cpl as $d) { ?>
										<option value="<?php echo $d->id_cpl_langsung; ?>"><?php echo $d->nama; ?></option>
										<?php $i++; } ?>
									</select>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-secondary" name="pilih_3" value="pilih_3" style="background-color: #FF6F61; color: #FFFFFF;">Tampilkan</button> 
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
						<div class="small-box" style="background-color: #FF6F61; color: #FFFFFF;">
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
				<div class="card-header" style="background-color: #FF6F61; color: #FFFFFF;">
					Data Kinerja  <?php echo $simpanan_cpl; ?>
				</div>				
				<div class="card-body">
					<?php 
					if (!empty($nama_mahasiswa)) {
						echo $nama_mahasiswa[0]->nama;
						echo " (".$nim_3.")";
					}else {
						echo "Kode Mahasiswa (".$nim_3.") Tidak terdaftar";
					}  ?>
					<hr>
					<div class="card">
						<div class="card-body">
						<canvas id="pemenuhan_cpl_tahun" class="chartjs-chart" width="480" height="320"></canvas>
						<div>
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

	/*Chart.plugin.register({
      afterDatasetsUpdate: function(chart) {
        Chart.helpers.each(chart.getDatasetMeta(0).data, function(rectangle, index) {
          rectangle._view.width = rectangle._model.width = 30;
        });
      },
    })*/

	var ctxCPLTahun = document.getElementById('pemenuhan_cpl_tahun');

	if (ctxCPLTahun != null) {
		var options = {
			legend: {
				position: "bottom"
			},
			scales: {
				yAxes: [{
					stacked: false,
                 	ticks: {
                        beginAtZero: true 
                    }
				}]

			},
			responsive: true,
			maintainAspectRatio: false,
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
						//label += '%';
						return label;
					}
				},
				intersect : false,
				mode:'index'
			}
		};

		var sms = <?php echo json_encode($nama_semester); ?>;
		var cap = <?php echo json_encode($capaian); ?>;
		var ntt = <?php echo json_encode($nilai_tertinggi); ?>;
		var nt = <?php echo json_encode($target); ?>;
		
		var data = {
			labels: sms,
			datasets: [
			{
				label: "Capaian",
				backgroundColor: "#087e8b",
				borderColor: "#087e8b",
				data: cap,
				barThickness: 30,
				
			}, 
			{
				label: "Target",
				backgroundColor: "#c81d25",
				borderColor: "#c81d25",
				data: nt,
				barThickness: 30,
				
			},
			{
				label: "Batas Maksimum",
				backgroundColor: "#bfd7ea",
				borderColor: "#bfd7ea",
				data: ntt, 
				barThickness: 30,
				
			}]
		};

		var cplTahun = new Chart(ctxCPLTahun, {
			type: 'bar',
			data: data,
			options: options
		});
	}
</script>
 



<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>