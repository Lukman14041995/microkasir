 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
<?php 
	$idbarang = $_GET['barang'];
	// $hasil = $lihat -> barang_edit($id);
	$id = $_SESSION['admin']['id_cabang'];
	require "konfig.php";
	$query = mysqli_query($koneksi, "SELECT barang.*, barang_name.nama_barang, barang_name.harga_jual, kategori.nama_kategori FROM barang INNER JOIN barang_name ON barang.id_barang = barang_name.id_barang INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori WHERE barang.id_barang = '$idbarang'
	ORDER BY id_barang asc ");
	$hasil = mysqli_fetch_array($query);
?>
      <!-- <div class="container-fluid"> -->
          <!-- <section class="wrapper"> -->

              <div class="row">
                  <div class="col-lg-12 main-chart">
					 <div class="card">
 						<div class="card-body">
						 <a href="index.php?page=barang"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Balik </button></a>
						<h3 class="mt-5">Details Barang</h3>
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
						<table class="table">
								<tr>
									<td>ID Barang</td>
									<td><?php echo $hasil['id_barang'];?></td>
								</tr>
								<tr>
									<td>Kategori</td>
									<td><?php echo $hasil['nama_kategori'];?></td>
								</tr>
								<tr>
									<td>Nama Barang</td>
									<td><?php echo $hasil['nama_barang'];?></td>
								</tr>
								<!-- <tr>
									<td>Merk Barang</td>
									<td><?php echo $hasil['merk'];?></td>
								</tr> -->
								<!-- <tr>
									<td>Harga Beli</td>
									<td><?php echo $hasil['harga_beli'];?></td>
								</tr> -->
								<tr>
									<td>Harga Jual</td>
									<td><?php echo $hasil['harga_jual'];?></td>
								</tr>
								<tr>
									<td>Satuan Barang</td>
									<td><?php echo $hasil['satuan_barang'];?></td>
								</tr>
								<tr>
									<td>Stok</td>
									<td><?php echo $hasil['stok'];?></td>
								</tr>
								<tr>
									<td>Tanggal Input</td>
									<td><?php echo $hasil['tgl_input'];?></td>
								</tr>
								<!-- <tr>
									<td>Tanggal Expired</td>
									<td><?php echo $hasil['tgl_expired'];?></td>
								</tr> -->
								<tr>
									<td>Tanggal Update</td>
									<td><?php echo $hasil['tgl_update'];?></td>
								</tr>
						</table>
						<div class="clearfix" style="padding-top:16%;"></div>
						</div>
					 </div>
				  </div>
              </div>
          <!-- </section> -->
      <!-- </div> -->
	
