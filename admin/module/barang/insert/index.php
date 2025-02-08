 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
	<?php 
	// require "konfig.php";
	// if (isset($_POST['insert'])) {
	// 	$idbarang = $_POST['idbarang'];
	// 	$idcabang = $_POST['id_cabang'];
	// 	$satuan = $_POST['satuan'];
	// 	$stok = $_POST['stok'];
	// 	$tgl = $_POST['tgl'];

	// 	$query = mysqli_query($koneksi, "INSERT INTO barang (id_barang,satuan_barang,stok,tgl_input,id_cabang) VALUES ('$idbarang', '$satuan', '$stok', '$tgl', '$idcabang')");  
	// 	if ($query) {
	// 		echo "berhasil disiman";
	// 	}else{
	// 		echo "gagal";
	// 	}
	// }
	 
	?>
      <!-- <div class="container-fluid"> -->
          <!-- <section class="wrapper"> -->

              <div class="row">
                  <div class="col-lg-12 main-chart">
					<div class="card">
						<div class="card-body">
						<a href="index.php?page=barang"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali </button></a>
						<h3 class=" mt-5">Tambah Barang</h3>
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
						<!-- fungsi/tambah/tambah.php?barang=tambah -->
							<form action="" method="POST">
								<?php 
								$id = $_SESSION['admin']['id_cabang'];
								?>
								<input type="hidden" value="<?= $id ?>" name="id_cabang">
								<tr>
								<td>Nama Barang</td>
								<td>
									<select name="idbarang" class="form-control" data-live-search="true">
										<option value="">Cari..</option>
										<?php 
										require "konfig.php";
										
										$sql = mysqli_query($koneksi, "SELECT * FROM barang_name WHERE id_cabang = '$id' ORDER BY nama_barang ");
										
										while ($a = mysqli_fetch_array($sql)) {
											
										?>
										<option  value="<?= $a['id_barang']; ?>"><?= $a['nama_barang']; ?></option>
										<?php } ?>
									</select>
									</td>
								</tr>
								<!-- <tr>
									<td>Merk Barang</td>
									<td><input type="text" class="form-control" name="merk"></td>
								</tr> -->
								<!-- <tr>
									<td>Harga Beli</td>
									<td><input type="number" class="form-control"  name="beli"></td>
								</tr> -->
								<tr>
									<td>Satuan Barang</td>
									<td>
										<select name="satuan" class="form-control" data-live-search="true">
											<option value="#">Pilih Satuan</option>
											<option value="PCS">PCS</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Stok</td>
									<td><input type="number" class="form-control"  name="stok"></td>
								</tr>
								<tr>
									<td>Tanggal Input</td>
									<td><input type="text" readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
								</tr>
                                <!-- <tr>
                                    <td>Tanggal Expired</td>
                                    <td><input type="date" required  class="form-control" name="tgl_expired"></td>
                                </tr> -->
								<tr>
									<td></td>
									<td><button class="btn btn-primary" name="insert" type="submit"><i class="fa fa-plus"></i> Insert Data</button></td>
								</tr>
						</form>
						</table>
						<div class="clearfix" style="padding-top:16%;"></div>
						</div>
					</div>
				  </div>
              </div>


<?php

require "konfig.php";
if (isset($_POST['insert'])) {
	$idbarang = $_POST['idbarang'];
	$idcabang = $_POST['id_cabang'];
	$satuan = $_POST['satuan'];
	$stok = $_POST['stok'];
	$tgl = $_POST['tgl'];
	$tgl_input = date('Y-m-d');
	$cek = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$idbarang'");
	if (mysqli_num_rows($cek) > 0) {
		echo "<script>alert('Barang Sudah Ada');window.location.href='index.php?page=barang'</script>";
	}else{
		$insert = mysqli_query($koneksi, "INSERT INTO barang VALUES('','$idbarang','$satuan','$stok','$tgl','','$tgl_input','','$idcabang','')");
		echo "<script>window.location.href='index.php?page=barang'</script>";
	}
}


?>
          <!-- </section> -->
      <!-- </div> -->

	<!-- <script type="text/javascript"> 
		<?php echo $jsArray; ?>
		function changeValue(id){
			document.getElementById('id_barang').value = prdName[id].id_barang;
			document.getElementById('nama_barang').value = prdName[id].nama_barang;
			document.getElementById('harga_jual	').value = prdName[id].harga_jual;
		};
	</script> -->
	<!-- <script>
	var rupiah = document.getElementById("harga_jual");
	rupiah.addEventListener("keyup", function(e) {
	// tambahkan 'Rp.' pada saat form di ketik
	// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
	rupiah.value = formatRupiah(this.value);
	});

	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? + rupiah : "";
	}

	</script> -->
