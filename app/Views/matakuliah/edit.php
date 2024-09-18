<link rel="stylesheet" href="<?= base_url(); ?>assets/Adminlte/plugins/fontawesome-free/css/all.min.css">
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Mata Kuliah</h3> 
                </div> 
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?= base_url('matakuliah/submit_edit'); ?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="<?= base_url('matakuliah/cetak_edit/'.$data[0]->kode_mk); ?>" target="_blank" class="btn btn-default">
                                    <i class="menu-icon fa fa-print"></i> Cetak
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Mata Kuliah TM-2018</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data[0]->nama_kode ?>" name="kode_mata_kuliah">
                        </div>
                        <br> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Mata Kuliah TM-2019</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data[0]->nama_kode_3 ?>" name="kode_mata_kuliah_3">
                        </div>
                        <br> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Mata Kuliah K-2020</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data[0]->nama_kode_2 ?>" name="kode_mata_kuliah_2">
                        </div>
                        <br> 
                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control" style="width: 100%;" name="semester" placeholder="Pilih Semester">
                                <option value="<?= $data[0]->id_semester ?>" > <?= $data[0]->id_semester ?> </option>
                                <?php foreach ($data as $row): ?>
                                    <option value="<?= $row->id_semester; ?>"><?= $row->id_semester; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                        <br>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data[0]->nama_mata_kuliah ?>" name="nama_mata_kuliah">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleInputEmail1">SKS</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data[0]->sks ?>" name="sks">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Dosen</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data[0]->dosen ?>" name="dosen">
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="box-content bordered primary">
                                <label for="exampleInputEmail1">CPMK</label>
                                <hr>
                                <div>
                                    <?php foreach($cpmk as $p) { ?>
                                        <a href="<?= base_url('matakuliah/edit_matakuliah_has_cpmk/'.$p->id_matakuliah_has_cpmk); ?>">
                                            <b><?= $p->id_cpmk_langsung; ?></b>
                                        </a>
                                        <p><?= $p->deskripsi_matakuliah_has_cpmk; ?></p>          		
                                    <?php } ?>
                                    <hr>
                                    <a class="btn btn-block btn-success" href="<?= base_url('matakuliah/tambah_matakuliah_has_cpmk/'.$p->kode_mk); ?>">+</a>
                                </div>
                            </div>
                        </div> 
                        <br> 
                        <div class="form-group">
                            <p><label for="exampleInputEmail1">RPS</label></p>
                            <p><?= $data[0]->rps ?></p>
                        </div>
                        <input type="hidden" name="kode_mk" value="<?= $data[0]->kode_mk ?>">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php //echo '<pre>'; var_dump($cpmk); echo '</pre>'; ?>
