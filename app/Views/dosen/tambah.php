<div class="col-lg-12">
	<div class="card">
		<div class="card-body">


			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Tambah Dosen</h3>
              </div> 
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('dosen/submit_tambah') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="exampleInputEmail1">NIP</label>
	                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan NIP" name="nip" maxlength="50" minlength="2" required>
	                  </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Dosen</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Dosen" name="nama_dosen" maxlength="50" minlength="2" required>
                    </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan" onclick="return confirm('apakah anda ingin menambahkan data dosen ?')" >Submit</button>
                </div>
              </form>


            </div>

		</div>
		
	</div>

</div>
 