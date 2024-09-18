<div class="col-lg-12">
	<div class="card">
		<div class="card-body">


			<div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Edit Deskriptor</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('formuladeskriptor/submit_edit_deskriptor') ?>" enctype="multipart/form-data">
	                <div class="card-body">

			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Nama CPL</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data[0]->nama_deskriptor ?>" name="nama">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Deskripsi</label>
			                    
			                    <textarea class="form-control" rows="3" id="text" name="deskripsi"><?= $data[0]->deskripsi ?></textarea>
			                  </div>
			                  <input type="hidden" name="id" value="<?= $data[0]->id_deskriptor ?>" >
			                  <br>


                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                </div>
              </form>

	              <div class="card-footer">	                
	              	<a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('formuladeskriptor/hapus_deskriptor/'.$data[0]->id_deskriptor); ?>"><button type="submit" class="btn btn-danger" name="simpan" value="simpan">Hapus Deskriptor</button></a>
	               </div>


            </div> 

		</div> 
		
	</div>

</div> 
