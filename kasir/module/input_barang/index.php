 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <!-- <section id="main-content">
          <section class="wrapper"> -->
 				
            <div class="card">
				<div class="card-body">
				<div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Data Barang</h3>
						<br/>
						<?php if(isset($_GET['success-stok'])){?>
						<div class="alert alert-success">
							<p>Tambah Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Tambah Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['edit'])){?>
						<div class="alert alert-success">
							<p>Update Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>

						<?php 
						require "konfig.php";
						$id = $_SESSION['kasir']['id_cabang'];
						$query = mysqli_query($koneksi, "SELECT * from barang where stok <= 3 and id = '$id'");
								
								while($q = mysqli_fetch_array($query)){
							?>	
						<?php
							echo "
							<div class='alert alert-warning'>
								<span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $q['nama_barang']."</a>  / <span style='color:red'> ID ". $q['id_barang']."</span> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!
								<span class='pull-right'><a href='index.php?page=barang'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
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
							<table class="table table-bordered" id="example1">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th>No.</th>
										<th>ID Barang</th>
										<th>Nama Barang</th>
										<th>Harga Jual</th>
										<th>Tanggal Input</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>

								<?php 
									$id = $_SESSION['kasir']['id_cabang'];
									require "konfig.php";
									$query = mysqli_query($koneksi, "SELECT * from barang_name WHERE id_cabang = '$id' ORDER BY id_barang asc ");
									$no= 0;
									while ($isi = mysqli_fetch_array($query)) {
										$no++;
								?>
									<tr>
										<td><?php echo $no ;?></td>
										<td><?php echo $isi['id_barang'];?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo "Rp " . number_format($isi['harga_jual']);?> ,-</td>
										<td> <?php echo $isi['tgl_input'];?></td>
										<td>
											<a href="index.php?page=input_barang/edit&barang=<?php echo $isi['id_barang'];?>"><button class="btn btn-warning btn-xs" title="Edit"><i class="mdi mdi-lead-pencil" title="Edit"></i></button></a>
											<a href="fungsi/hapus/hapus.php?input_barang=hapus&id=<?php echo $isi['id_barang'];?>" onclick="javascript:return confirm('Hapus Data barang ?');"><button class="btn btn-danger btn-xs" style="color: white;" title="Hapus"><i style="color: white;" class="mdi mdi-delete" title="Hapus"></i></button></a>
										</td>
									</tr>
								<?php 
									}
								?>
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
									<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Barang</h4>
								</div>										
								<form action="fungsi/tambah/tambah.php?barang_name=tambah" method="POST">
									<div class="modal-body">
								
										<table class="table table-striped bordered">
											
											<?php
												$id = $_SESSION['kasir']['id_cabang'];
												$format = $lihat -> barang_id();
											?>
											<tr>
											<input type="hidden" value="<?php echo $id; ?>" name="id_cabang">
												<td>ID Barang</td>
												<td><input type="text" readonly="readonly" required value="<?php echo $format;?>" class="form-control"  name="id"></td>
											</tr>
											<tr>
												<td>Nama Barang</td>
												<td><input type="text" placeholder="Nama Barang" required class="form-control" name="nama"></td>
											</tr>
											<tr>
												<td>Kategori</td>
												<td>
													<select name="kategori" class="form-control" id="">
														<option value="">--pilih--</option>
														<?php 
														require "konfig.php";
														$sql = mysqli_query($koneksi, "SELECT * FROM kategori");
														while ($a = mysqli_fetch_array($sql)) {
														?>
														<option value="<?php echo $a['id_kategori'] ?>"><?php echo $a['nama_kategori'] ?></option>
														<?php } ?>
													</select>
												</td>
											</tr>
											<tr>
												<td>Harga Jual</td>
												<td><input type="text" placeholder="Harga Jual" required class="form-control" name="harga"></td>
											</tr>
											<tr>
												<td>Tanggal Input</td>
												<td><input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
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
          
				</div>
			</div>  



				  <!-- </section>
      	</section> -->
	
