 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php 
		  $id = $_SESSION['admin']['id_member'];
		  $hasil = $lihat -> member_edit($id);
      ?>
      <!-- <div class="container-fluid"> -->
          <!-- <section class="wrapper"> -->
              <div class="row">
                  <div class="col-lg-12 main-chart">
						<div class="card">
 							<div class="card-body">
							 <h3>Profil Pengguna Aplikasi</h3>
						<br>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Edit Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>
							<div class="row">
							<!-- <div class="col-sm-3">
								<div class="panel panel-primary">
									<div class="panel-heading">
									</div>
									<div class="panel-body">
										<center><img src="assets/img/user/<?php echo $hasil['gambar'];?>"  alt="#" style="width:200px;border:4px solid #ddd;"/></center>			
									</div>
									<div class="panel-footer mt-3">
										<form method="POST" action="fungsi/edit/edit.php?gambar=user" enctype="multipart/form-data">
											<input type="file" accept="image/*" name="foto">
											<input type="hidden" value="<?php echo $hasil['gambar'];?>" name="foto2">
											<input type="hidden"  name="id" value="<?php echo $hasil['id_member'];?>">
											<span class="pull-right ">
												<button type="submit"  class="btn btn-primary btn-sm" style="margin-top: 10px;" value="Tambah"><i class="fa fa-pencil"> Ganti Foto</i></button>
											</span>
										</form>
										<br/>
										<br/>
									</div>
								</div>
							</div> -->
							<div class="col-sm-6">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h4><i class="fa fa-user"></i>  Kelola Pengguna </h4>
									</div>
									<div class="panel-body">
										<div class="box-content">
											<form class="form-horizontal" method="POST" action="fungsi/edit/edit.php?profil=edit" enctype="multipart/form-data">
												<fieldset>
													<div class="control-group">
														<label class="control-label" for="typeahead">Nama </label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
															</div>
															<input type="text" name="nama" class="form-control"
																aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $hasil['nm_member']; ?>" required="required">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="typeahead">Email </label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-square"></i></span>
															</div>
															<input type="text" name="email" class="form-control"
																aria-label="Username" aria-describedby="basic-addon1" name="email" value="<?php echo $hasil['email']; ?>" required="required">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="typeahead">Telepon </label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
															</div>
															<input type="text" class="form-control"
																aria-label="Username" aria-describedby="basic-addon1" name="tlp" value="<?php echo $hasil['telepon']; ?>" required="required">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="typeahead">NIK ( KTP ) </label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
															</div>
															<input type="text" class="form-control"
																aria-label="Username" aria-describedby="basic-addon1" name="nik" value="<?php echo $hasil['NIK']; ?>" required="required">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="typeahead">Alamat </label>
														<div class="controls">
															<textarea  name="alamat" rows="3" class="form-control" style="border-radius:0px;" required="required"><?php echo $hasil['alamat_member']; ?></textarea>
														</div>
													</div>
													<br>
													<div class="form-actions pull-right">
														<input type="hidden" name="id" value="<?php echo $hasil['id_member']; ?>">
														<button class="btn btn-primary" name="btn" value="Tambah" style="border-radius:0px;"><i class="fa fa-pencil"></i> Ubah Profil</button>
													</div>
												</fieldset>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h4><i class="fa fa-lock"></i>  Ganti Password</h4>
									</div>
									<div class="panel-body">
										<div class="box-content">
											 <form class="form-horizontal" method="POST" action="fungsi/edit/edit.php?pass=ganti-pas">
												
												<fieldset>
													<div class="control-group">
														<label class="control-label" for="typeahead">Username </label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
															</div>
															<input type="text" class="form-control"
																aria-label="Username" aria-describedby="basic-addon1" name="user" data-items="4" value="<?php echo $hasil['user'];?>">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="typeahead">Password Baru</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
															</div>
															<input type="text" class="form-control"
																aria-label="Username" aria-describedby="basic-addon1" id="pass" name="pass" required>
														</div>
													</div>
													<br>
													<div class="pull-right">															
														<input type="hidden" class="form-control" style="border-radius:0px;" name="id" value="<?php echo $hasil['id_member'];?>" required="required"/>
														<button type="submit" class="btn btn-primary" value="Tambah" style="border-radius:0px;" name="proses"><i class="fa fa-pencil"></i> Ubah Password</button>
													</div>
												</fieldset>
											</form>
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
					<div class="clearfix" style="padding-top:5%;"></div>
							 </div>
						</div>
				  </div>
              </div>
          <!-- </section> -->
      <!-- </div> -->
	
