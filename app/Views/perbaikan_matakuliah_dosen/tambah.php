<div class="col-lg-12">
	<div class="card">
		<div class="card-body">


			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Tambah Data - Asesmen dan Tindak Lanjut Perbaikan Matakuliah</h3>
              </div> 
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('perbaikanmatakuliahdosen/submit_tambah') ?>" enctype="multipart/form-data">
	                <div class="card-body"> 
	                  <div class="form-group">
	                    <label for="exampleInputEmail1">Mata Kuliah</label>
	                    <select id="mata_kuliah" class="form-control select2 select2-danger" name="mata_kuliah" required>
                        <option value="" style="background: lightblue;" selected disabled>- Mata Kuliah -</option>
                        <?php $i = 1; foreach($mata_kuliah as $d) { ?>
                        <option value="<?php echo $d->kode_mk; ?>"><?php echo $d->nama_kode.' ('.$d->nama_mata_kuliah.') - '.$d->kode_kurikulum; ?></option>
                        <?php $i++; } ?>
                      </select> 
	                  </div>
                    <br>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Dosen</label>
                      <select id="dosen" class="form-control select2 select2-danger" name="dosen" required>
                        <option value="" style="background: lightblue;" selected disabled>- Dosen -</option>
                        <option value="<?php echo $dosen['NIP']; ?>"><?php echo $dosen['NIP'].' ('.$dosen['nama_dosen'].')'; ?></option>
                      </select>
                    </div> 
                    <br>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tahun</label>
                      <input type="number" class="form-control" id="exampleInputEmail1" name="tahun" required>
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Hasil Analisis dan Evaluasi</label><br>
                      <textarea class="form-control" rows="5" placeholder="Enter ..." name="analisis" required></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tindak Lanjut dan Bukti Perbaikan</label>
                      <textarea class="form-control" rows="5" placeholder="Enter ..." name="perbaikan" required></textarea>
                    </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan" onclick="return confirm('Apakah Anda Ingin Menyimpan Data ?')" >Submit</button>
                </div>
              </form>


            </div>

		</div>
		
	</div>

</div>
 