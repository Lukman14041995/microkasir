 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php 
	$id = $_GET['id'];
	require "konfig.php";
	$sql = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori = '$id' ");
	$hasil = mysqli_fetch_array($sql);	
?>
      <!-- <div class="container-fluid"> -->
          <!-- <section class="wrapper"> -->

              <div class="row">
                  <div class="col-lg-12 main-chart">
					  	<div class="card">
 							<div class="card-body">
							 <a href="index.php?page=kategori"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali </button></a>
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
						<table class="table table-striped">
							<form action="fungsi/edit/edit.php?kategori=edit" method="POST">
                                    <input type="hidden" value="<?php echo $hasil['id_kategori'] ?>" name="id">
								<tr>
									<td>Nama Kategori</td>
									<td><input type="text" class="form-control" value="<?php echo $hasil['nama_kategori'];?>" name="nama"></td>
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
