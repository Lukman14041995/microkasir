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
						 <h3>Data Cabang</h3>
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
						<?php if(isset($_GET['edit'])){?>
						<div class="alert alert-success">
							<p>Edit Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>

						<?php 
						require "konfig.php";
						$id = $_SESSION['superuser']['id_cabang'];
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
					<!-- expired -->
						<!-- <?php 
							$id = $_SESSION['superuser']['id_cabang'];
							$sql1="SELECT * FROM barang WHERE tgl_expired <= now() and id_cabang = '$id' ";
							$row1 = $config -> prepare($sql1);
							$row1 -> execute();
							$r = $row1 -> fetchAll();
							foreach($r as $q){
						?>	
						<?php
								echo "
								<div class='alert alert-warning'>
									<span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $q['nama_barang']."</a>  / <span style='color:red'> ID ". $q['id_barang']."</span> Kadaluarsa . !! Pada Tanggal " . $q['tgl_expired'] ."
									<span class='pull-right'><a href='fungsi/hapus/hapus.php?expired=hapus&id=". $q['id_barang'] ."'>OK</a></span>
								</div>
								";	
							}
						?> -->
					<!-- end expired -->
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
										<th>Nama Cabang</th>
										<th>Alamat</th>
										<th>Tanggal Input</th>
										<th>Tanggal Update</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>

								<?php
									$hasil = $lihat -> cabang();
									$no=0;
									foreach($hasil as $isi) {
                                        $no++;
								?>
									<tr>
										<td><?php echo $no ?></td>
										<td><?php echo $isi['nama_cabang'];?></td>
										<td><?php echo $isi['alamat'];?></td>
										<td> <?php echo $isi['tgl_input'];?></td>
										<td> <?php echo $isi['tgl_update'];?></td>
										<td>
											<a href="index.php?page=cabang/edit&cabang=<?php echo $isi['id_cabang'];?>"><button class="btn btn-warning btn-xs"><i class="mdi mdi-lead-pencil" title="Edit"></i></button></a>
											<a href="fungsi/hapus/hapus.php?cabang=hapus&id=<?php echo $isi['id_cabang'];?>" onclick="javascript:return confirm('Hapus Data Cabang <?= $isi['nama_cabang']; ?> ?');"><button class="btn btn-danger btn-xs"><i style="color: white;" class="mdi mdi-delete" title="Hapus"></i></button></a>
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
						<!-- new modal -->
						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
									<form action="fungsi/tambah/tambah.php?cabang=tambah" method="POST">
										<div class="modal-body">
												<div class="form-group">
													<label for="">Nama Cabang</label>
													<input type="text" placeholder="Nama Cabang" required class="form-control" name="nama" autofocus>
												</div>
												<div class="form-group">
													<label for="">Alamat Cabang</label>
													<Textarea class="form-control" name="alamat" placeholder="Alamat Cabang"></Textarea>
												</div>
												<div class="form-group">
													<label for="">Tanggal Input</label>
													<input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl">
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Simpan</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end modal -->
					</div>
				  </div>
              </div>
          	<!-- </section> -->
      	<!-- </div> -->
	
