<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<h4 class="box-title">Reset Password User</h4>
			<form role="form" method="post" action="<?= base_url("user/submit_reset")  ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username
                    </label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Username" name="username" maxlength="50" minlength="2" required>
                  </div>
                  <br>
                  <br>

                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Reset</button>
                </div>
            </form> 
			<br>

		</div>
		<!-- /.box-content -->
	</div>

</div> 
