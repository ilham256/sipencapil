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
								<h3 class="card-title">Analisis & Evaluasi Pengukuran Langsung Progres Persemester</h3>

								<div class="card-tools">
								<div class="input-group input-group-sm" style="width: 150px;">

								</div>
								</div>
							</div>
							<!-- /.card-header -->
							<form method="post" action="<?php echo site_url('evaluasil/persemester') ?>" enctype="multipart/form-data">
							<div class="card-body">
							    <div class="form-group">
							        <div class="input-group">

							            <!-- Select Tahun Angkatan -->
							            <div class="input-group-prepend">
							                <select id="angkatan"
							                        class="form-control select2 select2-danger"
							                        name="tahun_masuk">
							                    <option value="" selected disabled>- Tahun Angkatan -</option>
							                    <?php foreach ($tahun_masuk as $d) { ?>
							                        <option value="<?php echo $d->tahun_masuk; ?>">
							                            <?php echo $d->tahun_masuk; ?>
							                        </option>
							                    <?php } ?>
							                </select>
							            </div>

							            <!-- Select Status Nilai Rapor -->
							            <div class="input-group-prepend ml-2">
							                <select id="semester"
							                        class="form-control select2 select2-danger"
							                        name="semester">
							                    <option value="" selected disabled>- Semester -</option>
							                    <?php foreach ($data_semester as $d) { ?>
							                        <option value="<?php echo $d->id_semester; ?>">
							                            <?php echo $d->id_semester; ?>
							                        </option>
							                    <?php } ?>
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
			<?php if ($status == 'tampilkan') { ?>
			<div>				
				<div class="card" style="">		 
					<div class="card-body">

					<h4 class="box-title">Data Analisis Kinerja CPL progres semester <?php echo $semester." Angkatan ".$simpanan_tahun; ?></h4>
					<br>
							<!-- PR: Canvas wajib dibungkus div dengan height fixed agar tidak memanjang terus -->
		            <div style="position: relative; height: 380px; width: 100%;">
		                <canvas id="evaluasi_cpl_pertama"></canvas>
		            </div>
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
			<?php } ?>	
		</div>
		<!-- /.box-content -->
	</div>
	
	<!-- /.col-lg-9 col-xs-12 -->
</div>
<?php if ($status == 'tampilkan') { ?>
<script src="<?php echo base_url() ?>plugin/chart/node_modules/chartjs-plugin-error-bars/node_modules/chart.js/dist/Chart.bundle.min.js"></script>
<script src="<?php echo base_url() ?>plugin/chart/node_modules/chartjs-plugin-error-bars/build/Plugin.Errorbars.js"></script>

<script>
    var ctxCPLTahun = document.getElementById('evaluasi_cpl_pertama');

    if (ctxCPLTahun != null) {
        var cpl = <?php echo json_encode($cpl ?? []); ?>;
        var cap = <?php echo json_encode($nilai_cpl ?? []); ?>;
        var ntt = <?php echo json_encode($target ?? []); ?>;
        var nt  = <?php echo json_encode($nilai_max ?? []); ?>;
        
        var data = {
            labels: cpl,
            datasets: [
                {
                    label: "Capaian",
                    backgroundColor: "#087e8b",
                    borderColor: "#087e8b",
                    data: cap,
                    barThickness: 30
                }, 
                {
                    label: "Target",
                    backgroundColor: "#c81d25",
                    borderColor: "#c81d25",
                    data: ntt,
                    barThickness: 30
                },
                {
                    label: "Batas Maksimum",
                    backgroundColor: "#bfd7ea",
                    borderColor: "#bfd7ea",
                    data: nt, 
                    barThickness: 30
                }
            ]
        };

        var options = {
            responsive: true,
            maintainAspectRatio: false,
            
            // Konfigurasi Legend (Sintaks Chart.js v2)
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    boxWidth: 15,
                    padding: 15
                }
            },

            /* Catatan: Jika perpustakaan JS Anda menggunakan Chart.js v3/v4, 
               pindahkan blok legend ke dalam plugins seperti ini:
            plugins: {
                legend: {
                    display: true,
                    position: "bottom"
                }
            },
            */

            scales: {
                yAxes: [{
                    stacked: false,
                    ticks: {
                        beginAtZero: true 
                    }
                }]
            },
            tooltips: {
                intersect: false,
                mode: 'index',
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                        if (label) {
                            label += ': ';
                        }
                        var value = Math.round(tooltipItem.yLabel * 100) / 100;
                        label += value;
                        return label;
                    }
                }
            }
        };

        var cplTahun = new Chart(ctxCPLTahun, {
            type: 'bar',
            data: data,
            options: options
        });
    }
</script>
<?php } ?>