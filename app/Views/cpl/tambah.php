<div class="col-lg-12">
	<div class="card">
		<div class="card-body">


			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Tambah CPL</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('cpmkcpl/submittambahcpl') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="exampleInputEmail1">Nama CPL</label>
	                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama CPL" name="nama_cpl">
	                  </div>
	                  <br> 
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Deskripsi</label>
			                    
			                    <textarea class="form-control" rows="3" id="text" placeholder="Enter ..." name="deskripsi"></textarea>
			                  </div>
			                  <br>

                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                </div>
              </form>


            </div>

		</div>
		
	</div> 

</div>
