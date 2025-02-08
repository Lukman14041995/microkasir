 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <!-- <div class="container-fluid"> -->
          <!-- <section class="wrapper"> -->
              <div class="row">
                  <div class="col-lg-12">
						<div class="card">
 							<div class="card-body">

							 <h3>Data Stok Barang</h3>
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

						<!-- <?php 
						require "konfig.php";
						$id = $_SESSION['admin']['id_cabang'];
						$query = mysqli_query($koneksi, "SELECT barang.*, barang_name.nama_barang FROM barang INNER JOIN barang_name ON barang.id_barang = barang_name.id_barang WHERE barang.stok <= 3 and barang.id_cabang = '$id'");
							
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
						?> -->

						<!-- <?php 
							$id = $_SESSION['admin']['id_cabang'];
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
						
						<!-- Trigger the modal with a button -->
						
						<a href="index.php?page=barang/insert" class="btn btn-primary btn-md pull-right">
							<i class="fa fa-plus"></i> Insert Data</a>
							
						<div class="clearfix"></div>
						<br/>
						<!-- view barang -->	
						<div class="table-responsive">
							<table id="zero_config" style="border:rgb(216, 216, 216) 1px solid;" class="table table-bordered">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th>No.</th>
										<th>ID Barang</th>
										<!-- <th>Kategori</th>	 -->
										<th>Nama Barang</th>
										<!-- <th>Merk</th> -->
										<!-- <th>HPP</th> -->
										<th>Harga Jual</th>
										<th width="10%">Stok</th>
										<th>Satuan</th>
										<!-- <th>Barcode</th> -->
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>

								<?php 
									$totalBeli = 0;
									$totalJual = 0;
									$totalStok = 0;

									$id = $_SESSION['admin']['id_cabang'];
									require "konfig.php";
									$query = mysqli_query($koneksi, "SELECT barang.*, barang_name.nama_barang, barang_name.harga_jual, kategori.nama_kategori FROM barang INNER JOIN barang_name ON barang.id_barang = barang_name.id_barang INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori WHERE barang.id_cabang = '$id'
									ORDER BY id_barang asc ");
									$no= 1;

									while ($isi = mysqli_fetch_array($query)) {
										
								?>
									<tr>
										<td><?php echo $no ;?></td>
										<td><?php echo $isi['id_barang'];?></td>
										<!-- <td><?php echo $isi['nama_kategori'];?></td> -->
										<td><?php echo $isi['nama_barang'];?></td>
										<!-- <td><?php echo $isi['merk'];?></td> -->
										<!-- <td>Rp.<?php echo $isi['harga_beli'];?>,-</td> -->
										<td>Rp.<?php echo number_format($isi['harga_jual']);?>,-</td>
										<td>
											<?php if($isi['stok'] == '0'){?>
												<button class="btn btn-danger" style="color: white;"> Habis</button>
											<?php }else{?>
												<?php echo $isi['stok'];?>
											<?php }?>
										</td>
										<td> <?php echo $isi['satuan_barang'];?></td>
										<!-- <td> <img src="../../../php-barcode-master/barcode.php?text='<?php echo $isi['barcode'] ?>'&print=true&size=65" /></td> -->
										<td> 
											<?php if($isi['stok'] <=  '3'){?>
												<form method="POST" action="fungsi/edit/edit.php?stok=edit">
													<input type="text" name="restok" class="form-control">
													<input type="hidden" name="id" value="<?php echo $isi['id_barang'];?>" class="form-control">
													<button class="btn btn-primary">
														Restok
													</button>
												</form>
											<?php }else{?>
											<a href="index.php?page=barang/details&barang=<?php echo $isi['id_barang'];?>"><button class="btn btn-primary btn-xs" title="Details"><i class="mdi mdi-information-variant"></i></button></a>
											<a href="index.php?page=barang/edit&barang=<?php echo $isi['id_barang'];?>"><button class="btn btn-warning btn-xs" title="Edit"><i class="mdi mdi-lead-pencil"></i></button></a>
											<a href="fungsi/hapus/hapus.php?barang=hapus&id=<?php echo $isi['id'];?>" onclick="javascript:return confirm('Hapus Data barang ?');"><button class="btn btn-danger btn-xs" title="Hapus"><i style="color: white;" class="mdi mdi-delete"></i></button></a>
											<?php }?>
										</td>
									</tr>
								<?php 
										$no++; 
										$totalBeli += $isi['harga_beli']; 
										$totalJual += $isi['harga_jual'];
										$totalStok += $isi['stok'];
									}
								?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3">Total </td>
										<!-- <th>Rp.<?php echo $totalBeli;?>,-</td> -->
										<th>Rp.<?php echo number_format($totalJual);?>,-</td>
										<th><?php echo $totalStok;?></td>
										<th colspan="2" style="background:#ddd"></th>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="clearfix" style="margin-top:7pc;"></div>
					<!-- end view barang -->
					<!-- tambah barang MODALS-->
							</div>
						</div>	
					</div>
              	</div>
          	<!-- </section> -->
      	<!-- </div> -->
	
		  <script>
	  $(document).ready(function() {
    $('#zero_config').DataTable( {
        // dom: 'Bfrtip',
        // buttons: [
        //     { extend: 'print', footer: true }
        // ]
    } );
} );
  </script>