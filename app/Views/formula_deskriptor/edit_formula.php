<div class="col-lg-12">
	<div class="card">
		<div class="card-body">


			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Edit Formula CPMK</h3>
              </div> 
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('formuladeskriptor/submit_edit_formula_deskriptor') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="exampleInputEmail1">Kode Deskriptor</label>
	                    <input type="text" class="form-control" id="exampleInputEmail1" name="id_deskriptor" value="<?= $data[0]->id_deskriptor ?>" disabled>
	                  </div>
	                  <br>

			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Nama Deskriptor</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1"  name="nama" value="<?= str_replace('_', ' ', $data[0]->id_deskriptor) ?>" disabled>
			                  </div>
			                  <br>
			                  <div class="form-group">
			                      <label>CPMK</label>
			                      <select class="form-control" style="width: 100%;" name="cpmk" >
		                      	<option value="<?= $data[0]->id_matakuliah_has_cpmk;  ?>" style="background: lightblue;"><?= $data[0]->kode_mk." - ".$data[0]->nama_mata_kuliah." - ".$data[0]->nama;  ?></option>
			                        <?php $no=1; foreach ($data_formula as $row): ?>
			                        <option value="<?= $row->id_matakuliah_has_cpmk;  ?>"><?= $row->kode_mk." - ".$row->nama_mata_kuliah." - ".$row->nama;  ?></option>
			                        <?php $no++; endforeach; ?>
					                      </select>
					                    </div>  
			                  <br> 
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Persentasi/Bobot</label>

			                    <input type="number" class="form-control" name="persentasi" value="<?= $data[0]->persentasi ?>" required name="price" min="0" value="0" step="0.0000001" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">

			                  </div>
			                  <br>
			                  <input type="hidden" name="id" value="<?= $data[0]->id_deskriptor_rumus_cpmk ?>">

 
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan Perubahan</button>
                </div>

                

              </form>

              <div class="card-footer">
                  
              	<a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('formula/hapus_rumus_deskriptor/'.$data[0]->id_deskriptor_rumus_cpmk); ?>"><button type="submit" class="btn btn-danger" name="simpan" value="simpan">Hapus Formula</button></a>
               </div>


            </div>

		</div>
		
	</div>

</div>
