<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6">
						<div class="card card-secondary">
							<div class="card-header" style="background-color: #216a8d; color: #FFFFFF;">
								<h3 class="card-title"> <i class="nav-icon fas fa-file-alt"></i>&nbsp; Laporan Mahasiswa</h3>
							</div> 
							<!-- /.card-header -->
							<form role="form" id="contactform" action="<?php echo site_url('report/mahasiswa')?>" method="post">
							<div class="card-body">
								<div class="container-fluid">
									<select id="nim_3" class="form-control select2 select2-danger" name="nim_2" required>
										<option value="" style="background: lightblue;" selected disabled>- Mahasiswa -</option>
										<?php $i = 1; foreach($data_mahasiswa as $d) { ?>
										<option value="<?php echo $d->nim; ?>"><?php echo $d->nim.' - '.$d->nama.' - '.$d->tahun_masuk; ?></option>
										<?php $i++; } ?>
									</select>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-secondary" name="pilih_2" value="pilih_2" style="background-color: #216a8d; color: #FFFFFF;">Tampilkan</button>
								
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
						<div class="small-box" style="background-color: #216a8d; color: #FFFFFF;">
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
			
			<div class="card card-dark" id="printCard">
				<div class="card-header" style="background-color: #216a8d; color: #FFFFFF;">
				</div>
				<div class="card-body">	
					

							<div class="text-center" style="color: #216a8d; font-size: 24px;">
								<p><strong>INSTITUT PERTANIAN BOGOR<br>
								DEPARTEMEN TEKNIK SIPIL DAN LINGKUNGAN<br>
								P.S. TEKNIK SIPIL DAN LINGKUNGAN
								<br><hr>
								</strong>
								</p>
							</div>

						<div class="row">
							<div class="col-md-6 col-xs-12" style='font-weight: bold; color: #216a8d;'>
								Nama Lengkap
							</div>

						</div>
						<div class="row">
							<div class="col-md-6 col-xs-12" style='font-weight: bold; color: grey;'>
								<?php echo $nama_rapor_mahasiswa; ?>
							</div>

						</div>
						<br>
						<div class="row">
							<div class="col-md-6 col-xs-12" style='font-weight: bold; color: #216a8d;'>
								Nomor Induk Mahasiswa
							</div>

							
						</div>
						<div class="row">
							<div class="col-md-6 col-xs-12" style='font-weight: bold; color: grey;'>
								<?php echo $nim_rapor_mahasiswa; ?>
							</div>

						</div> 
						<br>
						<table class="table"> 
							<thead style="background-color: #216a8d; color: white;  ">
								<tr>
									<th style='font-weight: normal; vertical-align: middle; text-align: center;'>Capaian Pembelajaran Lulusan</th>
									<th style='font-weight: normal; vertical-align: middle; text-align: center;'>Deskripsi</th> 
									<th style='font-weight: normal; vertical-align: middle; text-align: center;'>Nilai</th> 
									<th style='font-weight: normal; vertical-align: middle; text-align: center;'>Pencapaian</th> 
								</tr> 
							</thead>  
							<tbody > 

								<?php for ($i=0; $i < count($data_cpl); $i++) { ?>
								<tr> 
									<th scope="row"><?php  echo $data_cpl[$i]->nama ; ?></th> 
									<td style="text-align: justify; "><p><?php  echo ($data_cpl[$i]->deskripsi); ?></p></td> 
									<td style="text-align: center; "><?php echo (round($nilai_cpl_mahasiswa[$i],2)); ?></td> 
									<td><?php echo $status_nilai_cpl_mahasiswa[$i]; ?></td> 
								</tr> 
								<?php } ?>
							</tbody>  
						</table>
						<div class="float-end margin-top-50">

							<form role="form" id="contactform" action="<?php echo site_url('report/periksa_kekurangan_cpmk_mahasiswa')?>" method="post">

								<input type="hidden" name="nim" value="<?php echo $nim_rapor_mahasiswa; ?>">

								<button type="submit" class="btn btn-default waves-effect waves-light" name="pilih" value="pilih"><i class="nav-icon fas fa-search"></i>&nbsp; Periksa Kekurangan Nilai</button>
								<button class="btn btn-primary" onclick="printDiv()"><i class="nav-icon fas fa-print"></i>&nbsp; Cetak Laporan Mahasiswa</button>
								

							</form>

							
						</div>
					
					<!-- /.invoice-box -->
					<p><?php  //echo '<pre>';  var_dump($data_cpl); echo '</pre>';?></p>
				</div>
				<!-- /.col-xs-12 -->
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
    function printDiv() {
        var printContents = document.getElementById('printCard').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload(); // Reload halaman untuk memastikan tampilan kembali normal
    }
</script>

 


<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>