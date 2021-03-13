 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Data User</h3>
						<br/>
						<?php if(isset($_GET['success-stok'])){?>
						<div class="alert alert-success">
							<p>Tambah Stok Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Tambah Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>

						<?php 
							$sql1=" select * from barang where stok <= 3";
							$row1 = $config -> prepare($sql1);
							$row1 -> execute();
							$r = $row1 -> fetchAll();
							foreach($r as $q){
						?>	
						<?php
								echo "
								<div class='alert alert-warning'>
									<span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $q['nama_barang']."</a>  / <span style='color:red'> ID ". $q['id_barang']."</span> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!
								</div>
								";	
							}
						?>
						
						<!-- Trigger the modal with a button -->
						<button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-plus"></i> Insert Data</button>
						<div class="clearfix"></div>
						<br/>
						<!-- view barang -->	
						<div class="modal-view">
							<table class="table table-bordered table-striped" id="example1">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th>No.</th>
										<th>Nama Member</th>
										<th>NIK</th>
										<th>Telephone</th>
										<th>Email</th>
										<th>Foto</th>
										<th>Alamat</th>
									</tr>
								</thead>
								<tbody>

								<?php
								$no = 1;
								$hasil = $lihat -> user();
								foreach ($hasil as $hsl) {
								$no++;
								 ?>
									<tr>
										<td><?php echo $no ?></td>
										<td><?php echo $hsl['nm_member'] ?></td>
										<td><?php echo $hsl['NIK'] ?></td>
										<td><?php echo $hsl['telepon'] ?></td>
										<td><?php echo $hsl['email'] ?></td>
										<td><img src="assets/img/user/<?php echo $hsl['gambar'];?>" width="80" alt=""></td>
										<td><?php echo $hsl['alamat_member'] ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="clearfix" style="margin-top:7pc;"></div>
					<!-- end view barang -->
					<!-- tambah barang MODALS-->
						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content" style=" border-radius:0px;">
								<div class="modal-header" style="background:#285c64;color:#fff;">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Member</h4>
								</div>										
								<form action="fungsi/tambah/tambah.php?member=tambah" enctype="multipart/form-data" method="POST">
									<div class="modal-body">
								
										<table class="table table-striped bordered">
											<tr>
												<td>Nama Member</td>
												<td><input type="text" placeholder="Nama Member" required class="form-control" name="nama"></td>
											</tr>
											<tr>
												<td>NIK</td>
												<td><input type="number" placeholder="NIK" required class="form-control"  name="nik"></td>
											</tr>
											<tr>
												<td>Telephone</td>
												<td><input type="number" placeholder="Telephone" required class="form-control" name="telp"></td>
											</tr>
											<tr>
												<td>Email</td>
												<td><input type="email" placeholder="Email" required class="form-control"  name="email"></td>
											</tr>
											<tr>
												<td>Foto</td>
												<td>
                                                <input type="file" placeholder="Foto" required class="form-control"  name="foto">
												</td>
											</tr>
											<tr>
												<td>Status</td>
												<td>
                                                    <select name="status" class="form-control" id="">
                                                        <option value="">--Pilih Status--</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="superuser">Super User</option>
                                                        <option value="kasir">Kasir</option>
                                                    </select>
                                                </td>
											</tr>
											<tr>
												<td>Alamat</td>
												<td>
                                                    <textarea name="alamat" class="form-control"></textarea>
                                                </td>
											</tr>
											<tr>
												<td>Username</td>
												<td><input type="text" placeholder="Username" required class="form-control"  name="username"></td>
											</tr>
											<tr>
												<td>Password</td>
												<td><input type="password" placeholder="Password" required class="form-control"  name="password"></td>
											</tr>
										</table>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert Data</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>
              	</div>
          	</section>
      	</section>
	
