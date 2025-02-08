 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
<?php 
	$id = $_GET['barang'];
	require "konfig.php";
	$sql = mysqli_query($koneksi, "SELECT barang_name.*, kategori.nama_kategori, kategori_brg.nama_kat FROM barang_name INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori
	INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg  WHERE barang_name.id_barang = '$id' ");
	$hasil = mysqli_fetch_array($sql);	
?>
      <!-- <div class="container-fluid"> -->
          <!-- <section class="wrapper"> -->

              <div class="row">
                  <div class="col-lg-12 main-chart">
					 <div class="card">
 						<div class="card-body">
						 <a href="index.php?page=input_barang"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali </button></a>
						<h3 class="mt-5">Details Barang</h3>
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
						<table class="table">
							<form action="fungsi/edit/edit.php?input_barang=edit" method="POST">
								<tr>
									<td>ID Barang</td>
									<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $hasil['id_barang'];?>" name="id"></td>
								</tr>
								<tr>
									<td>Nama Barang</td>
									<td><input type="text" class="form-control" value="<?php echo $hasil['nama_barang'];?>" name="nama"></td>
								</tr>
								<tr>
									<td>Kategori</td>
									<td>
									<select name="kategori" class="form-control">
										<option value="<?php echo $hasil['id_kategori'];?>"><?php echo $hasil['nama_kategori'];?></option>
										<option value="#">Pilih Kategori</option>
										<?php  $kat = $lihat -> kategori(); foreach($kat as $isi){ 	?>
										<option value="<?php echo $isi['id_kategori'];?>"><?php echo $isi['nama_kategori'];?></option>
										<?php }?>
									</select>
									</td>
								</tr>
								<tr>
									<td>Jenis Produk</td>
									<td>
									<select name="jenisbrg" class="form-control">
										<option value="<?php echo $hasil['idbrg'];?>"><?php echo $hasil['nama_kat'];?></option>
										<option value="#">Pilih Kategori</option>
										<?php  require "konfig.php";
											$sql = mysqli_query($koneksi, "SELECT * FROM kategori_brg");
											while ($a = mysqli_fetch_array($sql)) { 	?>
										<option value="<?php echo $a['idbrg'];?>"><?php echo $a['nama_kat'];?></option>
										<?php }?>
									</select>
									</td>
								</tr>
								<tr>
									<td>Harga Jual</td>
									<td><input type="number" class="form-control" value="<?php echo $hasil['harga_jual'];?>" name="jual"></td>
								</tr>
								<tr>
									<td>Tanggal Update</td>
									<td><input type="text" readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
								</tr>
								<tr>
									<td></td>
									<td><button class="btn btn-primary"><i class="fa fa-edit"></i> Update Data</button></td>
								</tr>
							</form>
						</table>
						<div class="clearfix" style="padding-top:16%;"></div>
						</div>
					 </div> 	
				  </div>
              </div>
          <!-- </section> -->
      <!-- </div> -->
