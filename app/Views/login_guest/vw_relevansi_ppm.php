<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<h5 class="box-title">Input Relevansi PPM</h5>
			
				<div class="row mb-3">
					<div class="col-md-9 col-sm-12">
						<div> 
							<hr>
							 Data Relevansi PPM  
							<hr>
						</div>
						<table id="example1" class="table table-striped table-bordered display" style="width:100%">
							<thead>
								<tr>
									<th>No</th> 
									<th>Nama</th>
									<th>Posisi</th>
									<th>Jenis Kelamin</th>
									<th>Tahun Lulusan</th>
									<th>Nama Organisasi</th> 
									<th>Alamat</th>
									<th>HP</th>
									<th>Email</th>									
								</tr>
							</thead>

							<tbody>
			                    <?php $i = 1; foreach($datas as $r) { ?>
			                    <tr>
			                        <td><?php echo $i	; ?></td>
			                        <td><?php echo $r->nama ; ?></td>
			                        <td><?php echo $r->posisi ; ?></td>
			                        <td><?php echo $r->jenis_kelamin ; ?></td>
			                        <td><?php echo $r->tahun_lulusan ; ?></td>
			                        <td><?php echo $r->nama_organisasi ; ?></td>
			                        <td><?php echo $r->alamat ; ?></td>
			                        <td><?php echo $r->hp ; ?></td>
			                        <td><?php echo $r->email ; ?></td>		                        
			                    </tr>
			                    <?php $i++; } ?>

							</tbody>
						</table>
					</div> 
					<div class="col-md-3 col-sm-12">

					</div>

				</div>

			
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>