<div class="col-lg-12">
	<div class="card">
		<div class="card-body">


			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Update Data Mahasiswa dari Data Pusat</h3>
              </div> 
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('mahasiswa/submit_tambah') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="exampleInputEmail1">Tahun Angkatan</label>
	                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Tahun angkatan yang ingin di update" name="tahun">
	                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan" onclick="return confirm('apakah anda ingin update data ?')" >Update</button>
                </div>
              </form>


            </div>

		</div>
		
	</div>

</div>
 