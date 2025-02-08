 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <!-- <section id="main-content">
          <section class="wrapper"> -->
		<?php 
		require "konfig.php";
		$sql = mysqli_query($koneksi, "SELECT * FROM toko");
		$toko = mysqli_fetch_array($sql);

		$id = $_SESSION['admin']['id_cabang'];
		$q = mysqli_query($koneksi, "SELECT * FROM cabang WHERE id_cabang = 1");
		$tampil = mysqli_fetch_array($q);
		?>
 			<div class="card">
				 <div class="card-body">
				 <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Pengaturan Toko</h3>
						<br>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Ubah Data Berhasil !</p>
						</div>
						<?php }?>
						<table class="table table-stripped">
							<thead>
								<tr>
									<td>Nama Toko</td>
									<!-- <td>Kontak (Hp)</td> -->
									<td>Alamat</td>
									<td>Aksi</td>
								</tr>
							</thead>
							<tbody>
								<form method="post" action="fungsi/edit/edit.php?pengaturan=ubah">		
								<tr>
									<input type="hidden" name="id" value="<?php echo $id ?>">
									<td><input class="form-control" readonly name="namatoko" value="<?php echo $toko['nama_toko'];?>" placeholder="Nama Toko"></td>
									<!-- <td><input class="form-control" name="kontak" value="<?php echo $toko['tlp'];?>" placeholder="Kontak (Hp)"></td> -->
									<td><textarea name="alamat" class="form-control"><?php echo $tampil['alamat'] ?></textarea></td>
									<td><button id="tombol-simpan" class="btn btn-primary"><i class="fa fa-pencil"></i> Update Data</button></td>
								</tr>
								</form>
							</tbody>
						</table>
						<div class="clearfix" style="padding-top:41%;"></div>
				  </div>
              </div>
				 </div>
			 </div>
             
          <!-- </section>
      </section> -->
	
