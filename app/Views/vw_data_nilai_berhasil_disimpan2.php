<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
		<?php foreach ($datas as $key) { ?>
		
			<div class="col-12">
            <div class="alert alert-<?php if ($key["id_nilai"] == "Data_CPMK_Kosong") {
                   	echo "danger";
                   } 
                   else { echo "success"; }?> alert-dismissible">                
                   <?php if ($key["id_nilai"] == "Data_CPMK_Kosong") {
                   	echo "Data CPMK (".$key["id_matakuliah_has_cpmk"].") Tidak Ada, Harap Masukan Data CPMK Mata Kuliah";
                   } 
                   else { echo $key["nim"]." -> ".$key["id_matakuliah_has_cpmk"]." -> ".$key["nilai_tak_langsung"]." Berhasil Disimpan"; }?>
                </div>
            <!-- /.card-body -->
          <!-- /.card -->
        	</div>	
		

		<?php } ?>
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>
 