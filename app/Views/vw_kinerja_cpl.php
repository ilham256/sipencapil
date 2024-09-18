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
					<div class="card card-maroon">
					<div class="card-header">
						<h3 class="card-title">Progress Capaian Pembelajaran Lulusan (CPL) - Tahun <?php echo $tahun; ?></h3>

						<div class="card-tools">
						<div class="input-group input-group-sm" style="width: 150px;">

						</div>
						</div>
					</div>
					<!-- /.card-header -->
					<form method="post" action="<?php echo site_url('kincpl') ?>" enctype="multipart/form-data">
					<div class="card-body">
						<div class="form-group">
						<select id="angkatan" class="form-control select2 select2-danger" name="tahun">
                            <option value="<?= $simpanan_tahun ?>" style="background: lightblue;"><?= $simpanan_tahun . '/' . $t_simpanan_tahun; ?></option>
                            <?php foreach ($tahun_masuk as $d) { ?>
                            <option value="<?= $d->tahun_masuk ?>"><?= $d->tahun_masuk; ?></option>
                            <?php } ?>
                        </select>
						<br>
						<select id="cpl" class="form-control select2 select2-danger" name="cpl">
							<option value="<?php echo $simpanan_cpl; ?>" style="background: lightblue;"><?php echo $simpanan_cpl; ?></option>
							<?php $i = 1; foreach($cpl as $d) { ?>
							<option value="<?php echo $d->id_cpl_langsung; ?>"><?php echo $d->nama; ?></option>
							<?php $i++; } ?>
						</select>
						</div>
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
					<button type="submit" class="btn btn-info" name="pilih" value="pilih">Pilih</button>
					</div>
					</form>
					<!-- /.card-footer -->
					</div>
					<!-- /.card -->
					</div>
					<!-- ./col -->
				</div>
			</div>
			
			<hr>
				<div> 
					<p >Data Kinerja  <?php echo $simpanan_cpl; ?> </p>
					<p>Tahun Angkatan (<?php echo $tahun; ?>)</p>
				</div>	
			<div class="col-md-12 col-sm-12" style="">
				<canvas id="pemenuhan_cpl_tahun" class="chartjs-chart" width="480" height="320"></canvas>
			</div>
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>
<!-- chart.js Chart -->
<script src="<?= base_url('plugin/chart/node_modules/chartjs-plugin-error-bars/node_modules/chart.js/dist/Chart.bundle.min.js') ?>"></script>
<script src="<?= base_url('plugin/chart/node_modules/chartjs-plugin-error-bars/build/Plugin.Errorbars.js') ?>"></script>

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


		console.log(cap);

		var data = {
			labels: sms,
			datasets: [
			{
				label: "Capaian",
				backgroundColor: "rgba(48,79,254,1)",
				borderColor: "rgba(48,79,254,1)",
				data: cap,
				barThickness: 30,

			},
			{
				label: "Target",
				backgroundColor: "rgba(246,14,14,1)",
				borderColor: "rgba(246,14,14,0.3)",
				data: nt,
				barThickness: 30,

			},
			{
				label: "Nilai Tertinggi yang dapat dicapai",
				backgroundColor: "rgba(48,79,254,0.5)",
				borderColor: "rgba(48,79,254,0.3)",
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