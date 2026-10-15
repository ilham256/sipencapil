<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
  
 
			 <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Edit Perbaikan Matakuliah</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('perbaikanmatakuliahdosen/submit_edit') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                			
  			                  <div class="form-group">
			                    <label for="exampleInputEmail1">NIP</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" disabled value="<?= $data[0]->NIP; ?>" >
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Nama Dosen</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" disabled value="<?= $data[0]->nama_dosen; ?>">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Matakuliah</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" disabled value="<?= $data[0]->nama_mata_kuliah; ?>">
			                  </div>
			                  <br>
					            <div class="form-group">
					              <label for="exampleInputEmail1">Tahun</label>
					              <input type="number" class="form-control" id="exampleInputEmail1" disabled value="<?= $data[0]->tahun; ?>">
					            </div>
					            <br>

					            <div class="form-group">
					              <label for="exampleInputEmail1">Hasil Analisis dan Evaluasi</label><br>
					              <textarea class="form-control" rows="5" name="analisis"><?= $data[0]->analisis; ?></textarea>
					            </div>
					            <br>

					            <div class="form-group">
					              <label for="exampleInputEmail1">Tindak Lanjut dan Bukti Perbaikan</label>
					              <textarea class="form-control" rows="5" name="perbaikan"><?= $data[0]->perbaikan; ?></textarea>
                    			</div>

                    			<input type="hidden" name="id" value="<?= $data[0]->id; ?>">

                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                </div>

              </form>

            </div>

		</div>
		
	</div>

</div>
