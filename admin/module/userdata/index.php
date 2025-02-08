 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
	  
      <!-- <div class="container-fluid"> -->
          <!-- <section class="wrapper"> -->

              <div class="row">
                  <div class="col-lg-12 main-chart">
						<div class="card">
 							<div class="card-body">
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

						<!--  -->
						
						<!-- Trigger the modal with a button -->
						<button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#exampleModal">
							<i class="fa fa-plus"></i> Insert Data</button>
						<div class="clearfix"></div>
						<br/>
						<!-- view barang -->	
						<div class="table-responsive">
							<table id="zero_config" class="table table-bordered">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th>No.</th>
										<th>Nama Member</th>
										<th>NIK</th>
										<th>Telephone</th>
										<th>Email</th>
										<!-- <th>Foto</th> -->
										<th>Role</th>
										<th>Cabang</th>
									</tr>
								</thead>
								<tbody>

								<?php
								$no = 0;
								$id = $_SESSION['admin']['id_cabang'];
								$konek = mysqli_connect("localhost","root","","db_toko");
								$sql = mysqli_query($konek, "SELECT member.*, login.role, login.id_cabang,cabang.nama_cabang FROM member 
									INNER JOIN login ON member.id_member = login.id_member
									INNER JOIN cabang ON login.id_cabang = cabang.id_cabang WHERE login.id_cabang = '$id'");
									
								while ($hsl = mysqli_fetch_array($sql)) {
								$no++;
									?>
									<tr>
										<td><?php echo $no ?></td>
										<td><?php echo $hsl['nm_member'] ?></td>
										<td><?php echo $hsl['NIK'] ?></td>
										<td><?php echo $hsl['telepon'] ?></td>
										<td><?php echo $hsl['email'] ?></td>
										<!-- <td><img src="assets/img/user/<?php echo $hsl['gambar'];?>" width="80" alt=""></td> -->
										<td><?php echo $hsl['role'] ?></td>
										<td><?php echo $hsl['nama_cabang'] ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="clearfix" style="margin-top:7pc;"></div>
						<!-- end view barang -->
						<!-- tambah barang MODALS-->
						<!-- Modal -->
							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="" method="post">
										<div class="form-group">
										<label for="">Nama Member</label>
										<input type="text" placeholder="Nama Member" required class="form-control" name="nama">
										</div>
										<div class="form-group">
										<label for="">NIK</label>
										<input type="text" placeholder="NIK" required class="form-control" name="nik">
										</div>
										<div class="form-group">
										<label for="">Telephone</label>
										<input type="text" placeholder="Telephone" required class="form-control" name="telp">
										</div>
										<div class="form-group">
										<label for="">Email</label>
										<input type="text" placeholder="Email" required class="form-control" name="email">
										</div>
										<div class="form-group">
										<label for="">Role</label>
										<select name="role" class="form-control" id="">
											<option value="">--Pilih Role--</option>
											<option value="admin">Admin</option>
											<option value="kasir">Kasir</option>
										</select>
										</div>
										<div class="form-group">
										<label for="">Cabang</label>
										<select name="cabang" class="form-control" id="">
											<option value="">--Pilih Role--</option>
											<?php
											include "koneksi.php";
											$sql = mysqli_query($koneksi, "SELECT * FROM cabang");
											while ($a = mysqli_fetch_array($sql)) {
											?>
											<option value="<?php echo $a['id_cabang'] ?>"><?php echo $a['nama_cabang'] ?></option>
											<?php } ?>
										</select>
										</div>
										<div class="form-group">
										<label for="">Alamat</label>
										<textarea name="alamat" class="form-control"></textarea>
										</div>
										<div class="form-group">
										<label for="">Username</label>
										<input type="text" placeholder="Username" required class="form-control"  name="username">
										</div>
										<div class="form-group">
										<label for="">Password</label>
										<input type="password" placeholder="Password" required class="form-control"  name="password">
										</div>
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary" name="insert">Insert</button>
									</form>
								</div>
								</div>
							</div>
							</div>
						
						</div>
					</div>
              	</div>
          	<!-- </section> -->
      	<!-- </div> -->
<?php
	if (isset($_POST['insert'])) {
		$nama = $_POST['nama'];
		$nik = $_POST['nik'];
		$telp = $_POST['telp'];
		$email = $_POST['email'];
		$status = $_POST['role'];
		$alamat = $_POST['alamat'];
		// $foto = $_FILES['foto']['name'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$cabang = $_POST['cabang'];
		
		require "konfig.php";
		$query = mysqli_query($koneksi, "INSERT INTO member VALUES (NULL, '$nama', '$alamat', '$telp', '$email', '-', '$nik')");
		if ($query = true) {
			$get_id_member = mysqli_query($koneksi, "SELECT id_member FROM member ORDER BY id_member desc");
			$a = mysqli_fetch_array($get_id_member);
			$id_member = $a['id_member'];
			$cek = mysqli_query($koneksi, "SELECT * FROM login WHERE user = '$username'");
			if (mysqli_num_rows($cek) > 0) {
				echo "<script>alert('nama user sudah ada')</script>";
			}else{
				$member = mysqli_query($koneksi, "INSERT INTO login VALUES(NULL, '$username', '$password', '$id_member', '$status', '$cabang')");
			echo '<script>alert("Berhasil Disimpan")</script>';
			}
		}	
	}
?>
	
