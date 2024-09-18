<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<h4 class="box-title">User - Mahasiswa</h4>
			<div class="form-group">
				<div class="text-right">
					<a class="btn btn-success waves-effect waves-light" href="<?php echo site_url('user/tambah_mahasiswa') ?>" >+ User Mahasiswa</a>
				</div>
				<br>
			</div> 

			<table id="example1" class="table table-striped table-bordered display" style="width:100%">
				<thead>
					<tr> 
						<th>No.</th>
						<th>Username</th> 
						<th>Login Terakhir</th>
						<th>Action</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>No.</th>
						<th>Username</th> 
						<th>Login Terakhir</th>
						<th>Action</th>
					</tr>
				</tfoot>

				<tbody> 
                    <?php $i = 1; foreach($datas as $r) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><span class="label label-success"><?php echo $r->username; ?></span></td>
                        <td><?php echo $r->last_login; ?></td>
                        <td>
                        <a href="<?= base_url ('user/hapus_Admin/').$r->id; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data admin ?')" >Delete</a>
                      	</td>
                    </tr>
                    <?php $i++; } ?>
 
				</tbody>
			</table>
			<br>

		</div>
		<!-- /.box-content -->
	</div>

</div> 
