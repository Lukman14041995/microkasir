 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
<?php 
	$id = $_GET['barang'];
	// $hasil = $lihat -> barang_edit($id);
	require "konfig.php";
	$sql = mysqli_query($koneksi, "SELECT barang.*, barang_name.nama_barang, barang_name.harga_jual, kategori.nama_kategori FROM barang INNER JOIN barang_name ON barang.id_barang = barang_name.id_barang INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori
	where barang.id_barang='$id'");
	$hasil = mysqli_fetch_array($sql);
?>
      <!-- <div class="container-fluid"> -->
          <!-- <section class="wrapper"> -->

              <div class="row">
                  <div class="col-lg-12 main-chart">
					  	<div class="card">
 							<div class="card-body">
							 <a href="index.php?page=barang"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali </button></a>
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
							<form action="fungsi/edit/edit.php?barang=edit" method="POST">
								<tr>
									<td>Nama Barang</td>
									<td>
										
											<select name="id" class="form-control">
												<option selected value="<?= $hasil['id_barang']; ?>"><?= $hasil['nama_barang']; ?></option>
												<option value="">Cari..</option>
												<?php 
												require "konfig.php";
												$id = $_SESSION['superuser']['id_cabang'];
												$sql = mysqli_query($koneksi, "SELECT * FROM barang_name WHERE id_cabang = '$id' ORDER BY nama_barang ");
												
												while ($a = mysqli_fetch_array($sql)) {
													
												?>
												<option  value="<?= $a['id_barang']; ?>"><?= $a['nama_barang']; ?></option>
												<?php } ?>
											</select>
											</td>
									</tr>
								<tr>
									<td>Satuan Barang</td>
									<td>
										<select name="satuan" class="form-control">
											<option value="<?php echo $hasil['satuan_barang'];?>"><?php echo $hasil['satuan_barang'];?></option>
											<option value="#">Pilih Satuan</option>
											<option value="PCS">PCS</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Stok</td>
									<td><input type="number" class="form-control" value="<?php echo $hasil['stok'];?>" name="stok"></td>
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


	  <!-- <script>
		var rupiah = document.getElementById("jual");
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