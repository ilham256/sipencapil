<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<h5 class="box-title">Input Nilai CPMK (Pengukuran Langsung)</h5>
			<form role="form" id="contactform" action="<?php echo site_url('input_asesmen_guest/Cpmklang')?>" method="post">
				<div class="row mb-3">
					<label for="angkatan" class="col-sm-3 col-form-label">Silahkan pilih Mata Kuliah</label>
					<div class="col-sm-6">
						<select id="mata_kuliah" class="form-select" name="mata_kuliah">
							<option value="<?php echo $simpanan_mk	; ?>" style="background: lightblue;"><?php echo $simpanan_nama_mk; ?></option>
							<?php $i = 1; foreach($mata_kuliah as $d) { ?>
							<option value="<?php echo $d->kode_mk; ?>"><?php echo $d->nama_kode.' ('.$d->nama_mata_kuliah.')'; ?></option>
							<?php $i++; } ?>
						</select>
					</div>  
				</div>  
				<div class="row mb-3">
					<label for="mata_kuliah" class="col-sm-3 col-form-label">Silahkan pilih Tahun Akademik</label>
					<div class="col-sm-3 ">
						<div class="input-group">
						<select id="angkatan" class="form-select" name="tahun_masuk">
							<option value="<?php echo $simpanan_tahun	; ?>" style="background: lightblue;"><?php echo $simpanan_tahun.$t_simpanan_tahun; ?></option>
							<?php $i = 1; foreach($tahun_masuk as $d) { ?>
							<option value="<?php echo $d->tahun_masuk; ?>"><?php echo $d->tahun_masuk.'/'.($d->tahun_masuk+1); ?></option>
							<?php $i++; } ?>
						</select>

						<button type="submit" class="btn btn-primary" name="pilih" value="pilih">Pilih</button> 
						</div>
					</div>
				</div>  
				
			</form> 
				<div class="row mb-3">
					<div class="col-md-9 col-sm-12">
						<table id="example2" class="table table-striped table-bordered display" style="width:100%">
							<thead>
								<tr>
									<th>NIM</th>
									<th>Nama</th>
									<?php foreach ($data_matakuliah_has_cpmk as $row) { ?>
									<th><?php echo $row->nama	; ?></th>
									<?php } ?>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>NIM</th>
									<th>Nama</th> 
									<?php foreach ($data_matakuliah_has_cpmk as $row) { ?>
									<th><?php echo $row->nama	; ?></th>
									<?php } ?>
								</tr> 
							</tfoot>
 							<tbody>
			                    <?php $i = 1; foreach($data_mahasiswa as $r) { ?>
			                    <tr>
			                        <td><?php echo $r["Nim"]	; ?></td>
			                        <td><?php echo $r["Nama"] ; ?></td>

			                        <?php foreach ($data_matakuliah_has_cpmk as $row) { ?>
									<td>
										<?php foreach($datas as $w) { ?>
												<?php if ($w->nim == $r["Nim"]) {
													if ($row->id_matakuliah_has_cpmk == $w->id_matakuliah_has_cpmk) {
														echo $w->nilai_langsung;
													} } } ?>
			                    	</td>
									<?php } ?>


			                        
			                    </tr>
			                    <?php $i++; } ?>

							</tbody>
						</table>
					</div> 
					<div class="col-md-3 col-sm-12">
						<div class="row small-spacing">
							<div class="col-lg-12 col-xs-12">
								 <?php if ($error == true): ?>
								<div class="box-content">
						     
						          <div class="col-12">
						              <div class="alert alert-warning">
						                <?= $message; ?>
						              </div>
						              <!-- /.card-body -->
						            <!-- /.card -->
						            </div>  
								
								</div>
						     	 <?php endif ?>

								<!-- /.box-content -->
							</div>
							<!-- /.col-lg-9 col-xs-12 -->
						</div>
						 
						
					</div>

				</div>

			
		</div>
		<!-- /.box-content -->
	</div>
	<?php echo "PHP version :".phpversion()	; ?>
	<!-- /.col-lg-9 col-xs-12 -->
</div>
