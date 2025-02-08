 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->

 <!-- <div class="container-fluid"> -->
 <!-- <section class="wrappe/r"> -->

 <div class="row">
 	<div class="col-lg-12 main-chart">
 		<div class="card">
 			<div class="card-body">
 				<h5>Data Laporan Pejualan Hari Ini, <?php echo date('j F Y, G:i') ?>
 				</h5>
 				<h5>Cari Laporan Per Tanggal</h5>
 				<form method="post" action="index.php?page=today&cari=ok">
 					<div class="row">
 						<div class="col-md-4">
 							Dari Tanggal
 							<input type="date" name="datefrom" class="form-control" id="">
 						</div>
 						<div class="col-md-4">
 							Sampai Tanggal
 							<input type="date" name="dateto" class="form-control" id="">
 						</div>
 						<div class="col-md-4" style="margin-top: 20px;">
 							<input type="hidden" name="periode" value="ya">
 							<button class="btn btn-primary">
 								<i class="fa fa-search"></i> Filter
 							</button>
 							<a href="index.php?page=today" class="btn btn-success" style="color: white;">
 								<i class="fa fa-refresh"></i> Refresh</a>
 						</div>
 					</div>


 				</form>
 				<?php if (!empty($_GET['cari'])) {
					?>
 					<div style="background-color: rgb(13, 197, 13); color: white; padding: 10px; border-radius: 6px;">
 						Dari Tanggal <?php echo $_POST['datefrom'] ?> Sampai Tanggal <?php echo $_POST['dateto'] ?>
 					</div>
 				<?php } ?>
 				<br />

 				<?php if (!empty($_GET['cari'])) { ?>
 					<h5>Original</h5>
 					<div class="table-responsive">
 						<table class="table table-bordered" id="tabel1">
 							<thead>
 								<tr style="background:#DFF0D8;color:#333;">
 									<th> No</th>
 									<th> Nama Barang</th>
 									<th> Banyaknya</th>
 									<th>Jenis</th>
 									<th> Harga Satuan</th>
 									<th> Jumlah</th>
 								</tr>
 							</thead>
 							<tbody>
 								<?php $no = 1;
									//  $hasil = $lihat -> pengeluaran();
									?>
 								<?php
									// foreach($hasil as $isi){ 
									require "konfig.php";
									$no = 1;
									$tanggal1 = $_POST['datefrom'];
									$tanggal2 = $_POST['dateto'];
									$id = $_SESSION['admin']['id_cabang'];
									require "konfig.php";
									$date =  date('Y-m-d');
									$sql = mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlah,nota.total, barang_name.id_barang,barang_name.id_kat, barang_name.nama_barang, barang_name.harga_jual,kategori_brg.nama_kat
                                    FROM nota
                                    INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
                                    INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
                                    WHERE barang_name.id_kat = '1' and nota.periode between '$tanggal1' and '$tanggal2' GROUP BY nota.id_barang");
									while ($a = mysqli_fetch_array($sql)) {
										$jumlah += $a['jumlah'];
										$total = $a['jumlah'] * $a['harga_jual'];
										$totsem += $total;
									?>
 									<tr>
 										<td><?php echo $no; ?></td>
 										<td><?php echo $a['nama_barang']; ?></td>
 										<td><?php echo $a['jumlah']; ?></td>
 										<td><?php echo $a['nama_kat'] ?></td>
 										<td>Rp. <?php echo number_format($a['harga_jual']) ?>,-</td>
 										<td>Rp. <?php echo number_format($total) ?>,-</td>
 									</tr>
 								<?php $no++;
									} ?>
 								<?php $hasil = $lihat->jml_pengeluaran(); ?>
 							</tbody>
 							<tfoot>
 								<tr>
 									<th colspan="4" style="background:#ddd"></th>
 									<th>Total </td>
 										<!-- <th></td> -->
 									<th>Rp.<?php echo number_format($totsem); ?>,-</td>
 								</tr>
 							</tfoot>
 						</table>
 					</div>
 					<div class="clearfix" style="padding-top:5pc;"></div>

 					<h5>UMKM 1</h5>
 					<div class="table-responsive">
 						<table class="table table-bordered" id="tabel2">
 							<thead>
 								<tr style="background:#DFF0D8;color:#333;">
 									<th> No</th>
 									<th> Nama Barang</th>
 									<th> Banyaknya</th>
 									<th>Jenis</th>
 									<th> Harga Satuan</th>
 									<th> Jumlah</th>
 								</tr>
 							</thead>
 							<tbody>
 								<?php $no = 1;
									//  $hasil = $lihat -> pengeluaran();
									?>
 								<?php
									// foreach($hasil as $isi){ 
									require "konfig.php";
									$no = 1;
									$id = $_SESSION['admin']['id_cabang'];
									$tanggal1 = $_POST['datefrom'];
									$tanggal2 = $_POST['dateto'];
									require "konfig.php";
									$date =  date('Y-m-d');
									$sql = mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlah,nota.total, barang_name.id_barang,barang_name.id_kat, barang_name.nama_barang, barang_name.harga_jual,kategori_brg.nama_kat
                                    FROM nota
                                    INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
                                    INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
                                    WHERE barang_name.id_kat = '2' and nota.periode between '$tanggal1' and '$tanggal2' GROUP BY nota.id_barang");
									while ($a = mysqli_fetch_array($sql)) {
										$jumlah += $a['jumlah'];
										$total = $a['jumlah'] * $a['harga_jual'];
										$tot += $total;
									?>
 									<tr>
 										<td><?php echo $no; ?></td>
 										<td><?php echo $a['nama_barang']; ?></td>
 										<td><?php echo $a['jumlah']; ?></td>
 										<td><?php echo $a['nama_kat'] ?></td>
 										<td>Rp. <?php echo number_format($a['harga_jual']) ?>,-</td>
 										<td>Rp. <?php echo number_format($total) ?>,-</td>
 									</tr>
 								<?php $no++;
									} ?>
 								<?php $hasil = $lihat->jml_pengeluaran(); ?>
 							</tbody>
 							<tfoot>
 								<tr>
 									<th colspan="4" style="background:#ddd"></th>
 									<th>Total </td>
 										<!-- <th></td> -->
 									<th>Rp.<?php echo number_format($tot); ?>,-</td>
 								</tr>
 							</tfoot>
 						</table>
 					</div>
 					<h5>UMKM 2</h5>
 					<div class="table-responsive">
 						<table class="table table-bordered" id="tabel3">
 							<thead>
 								<tr style="background:#DFF0D8;color:#333;">
 									<th> No</th>
 									<th> Nama Barang</th>
 									<th> Banyaknya</th>
 									<th>Jenis</th>
 									<th> Harga Satuan</th>
 									<th> Jumlah</th>
 								</tr>
 							</thead>
 							<tbody>
 								<?php $no = 1;
									//  $hasil = $lihat -> pengeluaran();
									?>
 								<?php
									// foreach($hasil as $isi){ 
									require "konfig.php";
									$no = 1;
									$id = $_SESSION['admin']['id_cabang'];
									$tanggal1 = $_POST['datefrom'];
									$tanggal2 = $_POST['dateto'];
									require "konfig.php";
									$date =  date('Y-m-d');
									$sql = mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlah,nota.total, barang_name.id_barang,barang_name.id_kat, barang_name.nama_barang, barang_name.harga_jual,kategori_brg.nama_kat
                                    FROM nota
                                    INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
                                    INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
                                    WHERE barang_name.id_kat = '5' and nota.periode between '$tanggal1' and '$tanggal2' GROUP BY nota.id_barang");
									while ($a = mysqli_fetch_array($sql)) {
										$jumlah += $a['jumlah'];
										$total = $a['jumlah'] * $a['harga_jual'];
										$tott += $total;
									?>
 									<tr>
 										<td><?php echo $no; ?></td>
 										<td><?php echo $a['nama_barang']; ?></td>
 										<td><?php echo $a['jumlah']; ?></td>
 										<td><?php echo $a['nama_kat'] ?></td>
 										<td>Rp. <?php echo number_format($a['harga_jual']) ?>,-</td>
 										<td>Rp. <?php echo number_format($total) ?>,-</td>
 									</tr>
 								<?php $no++;
									} ?>
 								<?php $hasil = $lihat->jml_pengeluaran(); ?>
 							</tbody>
 							<tfoot>
 								<tr>
 									<th colspan="4" style="background:#ddd"></th>
 									<th>Total </td>
 										<!-- <th></td> -->
 									<th>Rp.<?php echo number_format($tott); ?>,-</td>
 								</tr>
 							</tfoot>
 						</table>
 					</div>
 					<div class="clearfix" style="padding-top:5pc;"></div>
 					<?php
						require "konfig.php";
						$date = date("Y-m-d");
						$tanggal1 = $_POST['datefrom'];
						$tanggal2 = $_POST['dateto'];
						$queryT = mysqli_query($koneksi, "SELECT SUM(potongan) as potongan, SUM(totalsemua) as totalsemua FROM transaksi WHERE periode between '$tanggal1' and '$tanggal2'");
						$data = mysqli_fetch_array($queryT);
						$penjualan = $data['totalsemua'];
						$potongan = $data['potongan'];
						?>
 					<!-- <h4>Total Penjualan : Rp. <?php echo number_format($penjualan) ?> </h4> -->
 					<h4>Total Potongan : Rp. <?php echo number_format($potongan) ?></h4>
 					<!-- <?php $hasil = $data['totalsemua'] - $data['potongan'] ?> -->
 					<h4>Hasil Keseluruhan: Rp. <?= number_format($penjualan) ?></h4>
 				<?php } else { ?>
 					<!-- view barang -->
 					<h5>Original</h5>
 					<div class="table-responsive">
 						<table class="table table-bordered" id="table1">
 							<thead>
 								<tr style="background:#DFF0D8;color:#333;">
 									<th> No</th>
 									<th> Nama Barang</th>
 									<th> Banyaknya</th>
 									<th>Jenis</th>
 									<th> Harga Satuan</th>
 									<th> Jumlah</th>
 								</tr>
 							</thead>
 							<tbody>
 								<?php $no = 1;
									//  $hasil = $lihat -> pengeluaran();
									?>
 								<?php
									// foreach($hasil as $isi){ 
									require "konfig.php";
									$no = 1;
									$id = $_SESSION['admin']['id_cabang'];
									require "konfig.php";
									$date =  date('Y-m-d');
									$sql = mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlah,nota.total, barang_name.id_barang,barang_name.id_kat, barang_name.nama_barang, barang_name.harga_jual,kategori_brg.nama_kat
                                    FROM nota
                                    INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
                                    INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
                                    WHERE barang_name.id_kat = '1' and nota.periode like '%" . $date . "%' GROUP BY nota.id_barang");
									while ($a = mysqli_fetch_array($sql)) {
										$jumlah += $a['jumlah'];
										$total = $a['jumlah'] * $a['harga_jual'];
										$bigtot += $total;
									?>
 									<tr>
 										<td><?php echo $no; ?></td>
 										<td><?php echo $a['nama_barang']; ?></td>
 										<td><?php echo $a['jumlah']; ?></td>
 										<td><?php echo $a['nama_kat'] ?></td>
 										<td>Rp. <?php echo number_format($a['harga_jual']) ?>,-</td>
 										<td>Rp. <?php echo number_format($total) ?>,-</td>
 									</tr>
 								<?php $no++;
									} ?>
 								<?php $hasil = $lihat->jml_pengeluaran(); ?>
 							</tbody>
 							<tfoot>
 								<tr>
 									<th colspan="4" style="background:#ddd"></th>
 									<th>Total </td>
 										<!-- <th></td> -->
 									<th>Rp.<?php echo number_format($bigtot); ?>,-</td>
 								</tr>
 							</tfoot>
 						</table>
 					</div>
 					<div class="clearfix" style="padding-top:5pc;"></div>

 					<h5>UMKM 1</h5>
 					<div class="table-responsive">
 						<table class="table table-bordered" id="table2">
 							<thead>
 								<tr style="background:#DFF0D8;color:#333;">
 									<th> No</th>
 									<th> Nama Barang</th>
 									<th> Banyaknya</th>
 									<th>Jenis</th>
 									<th> Harga Satuan</th>
 									<th> Jumlah</th>
 								</tr>
 							</thead>
 							<tbody>
 								<?php $no = 1;
									//  $hasil = $lihat -> pengeluaran();
									?>
 								<?php
									// foreach($hasil as $isi){ 
									require "konfig.php";
									$no = 1;
									$id = $_SESSION['admin']['id_cabang'];
									require "konfig.php";
									$date =  date('Y-m-d');
									$sql = mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlah,nota.total, barang_name.id_barang,barang_name.id_kat, barang_name.nama_barang, barang_name.harga_jual,kategori_brg.nama_kat
                                    FROM nota
                                    INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
                                    INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
                                    WHERE barang_name.id_kat = '2' and nota.periode like '%" . $date . "%' GROUP BY nota.id_barang");
									while ($a = mysqli_fetch_array($sql)) {
										$jumlah += $a['jumlah'];
										$total = $a['jumlah'] * $a['harga_jual'];
										$big += $total;
									?>
 									<tr>
 										<td><?php echo $no; ?></td>
 										<td><?php echo $a['nama_barang']; ?></td>
 										<td><?php echo $a['jumlah']; ?></td>
 										<td><?php echo $a['nama_kat'] ?></td>
 										<td>Rp. <?php echo number_format($a['harga_jual']) ?>,-</td>
 										<td>Rp. <?php echo number_format($total) ?>,-</td>
 									</tr>
 								<?php $no++;
									} ?>
 								<?php $hasil = $lihat->jml_pengeluaran(); ?>
 							</tbody>
 							<tfoot>
 								<tr>
 									<th colspan="4" style="background:#ddd"></th>
 									<th>Total </td>
 										<!-- <th></td> -->
 									<th>Rp.<?php echo number_format($big); ?>,-</td>
 								</tr>
 							</tfoot>
 						</table>
 					</div>
 					<div class="clearfix" style="padding-top:5pc;"></div>
 					<h5>UMKM 2</h5>
 					<div class="table-responsive">
 						<table class="table table-bordered" id="table3">
 							<thead>
 								<tr style="background:#DFF0D8;color:#333;">
 									<th> No</th>
 									<th> Nama Barang</th>
 									<th> Banyaknya</th>
 									<th>Jenis</th>
 									<th> Harga Satuan</th>
 									<th> Jumlah</th>
 								</tr>
 							</thead>
 							<tbody>
 								<?php $no = 1;
									//  $hasil = $lihat -> pengeluaran();
									?>
 								<?php
									// foreach($hasil as $isi){ 
									require "konfig.php";
									$no = 1;
									$id = $_SESSION['admin']['id_cabang'];
									require "konfig.php";
									$date =  date('Y-m-d');
									$sql = mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlah,nota.total, barang_name.id_barang,barang_name.id_kat, barang_name.nama_barang, barang_name.harga_jual,kategori_brg.nama_kat
                                    FROM nota
                                    INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
                                    INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
                                    WHERE barang_name.id_kat = '5' and nota.periode like '%" . $date . "%' GROUP BY nota.id_barang");
									while ($a = mysqli_fetch_array($sql)) {
										$jumlah += $a['jumlah'];
										$total = $a['jumlah'] * $a['harga_jual'];
										$bigg += $total;
									?>
 									<tr>
 										<td><?php echo $no; ?></td>
 										<td><?php echo $a['nama_barang']; ?></td>
 										<td><?php echo $a['jumlah']; ?></td>
 										<td><?php echo $a['nama_kat'] ?></td>
 										<td>Rp. <?php echo number_format($a['harga_jual']) ?>,-</td>
 										<td>Rp. <?php echo number_format($total) ?>,-</td>
 									</tr>
 								<?php $no++;
									} ?>
 								<?php $hasil = $lihat->jml_pengeluaran(); ?>
 							</tbody>
 							<tfoot>
 								<tr>
 									<th colspan="4" style="background:#ddd"></th>
 									<th>Total </td>
 										<!-- <th></td> -->
 									<th>Rp.<?php echo number_format($bigg); ?>,-</td>
 								</tr>
 							</tfoot>
 						</table>
 					</div>
 					<div class="clearfix" style="padding-top:5pc;"></div>
 					<?php
						require "konfig.php";
						$date = date("Y-m-d");
						$queryT = mysqli_query($koneksi, "SELECT SUM(potongan) as potongan, SUM(totalsemua) as totalsemua FROM transaksi WHERE periode like '%" . $date . "%'");
						$data = mysqli_fetch_array($queryT);
						$penjualan = $data['totalsemua'];
						$potongan = $data['potongan'];
						?>
 					<!-- <h4>Total Penjualan : Rp. <?php echo number_format($penjualan) ?> </h4> -->
 					<h4>Total Potongan : Rp. <?php echo number_format($potongan) ?></h4>
 					<!-- <?php $hasil = $data['totalsemua'] - $data['potongan'] ?> -->
 					<h4>Hasil Keseluruhan: Rp. <?= number_format($penjualan) ?></h4>

 				<?php } ?>


 			</div>
 		</div>
 	</div>
 </div>
 </div>
 <!-- tambah barang MODALS-->


 </div>

 <!-- </section> -->
 <!-- </div> -->
 <!-- <script>
   $(document).ready(function() {
    $('#table2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
	} );
	</script>
	<script>
	$(document).ready(function() {
		$('#table1').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
		} );
	} );
  </script> -->
 <script>
 	$(document).ready(function() {
 		$('#table3').DataTable({
 			dom: 'Bfrtip',
 			buttons: [{
 					extend: 'print',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				},
 				{
 					extend: 'pdfHtml5',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				}
 				// { extend: 'excelHtml5', footer: true },
 			]
 		});
 	});
 	$(document).ready(function() {
 		$('#table2').DataTable({
 			dom: 'Bfrtip',
 			buttons: [{
 					extend: 'print',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				},
 				{
 					extend: 'pdfHtml5',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				}
 				// { extend: 'excelHtml5', footer: true },
 			]
 		});
 	});
 	$(document).ready(function() {
 		$('#table1').DataTable({
 			dom: 'Bfrtip',
 			buttons: [{
 					extend: 'print',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				},
 				{
 					extend: 'pdfHtml5',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				}
 				// { extend: 'excelHtml5', footer: true },
 			]
 		});
 	});
 	$(document).ready(function() {
 		$('#tabel3').DataTable({
 			dom: 'Bfrtip',
 			buttons: [{
 					extend: 'print',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				},
 				{
 					extend: 'pdfHtml5',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				}
 				// { extend: 'excelHtml5', footer: true },
 			]
 		});
 	});
 	$(document).ready(function() {
 		$('#tabel2').DataTable({
 			dom: 'Bfrtip',
 			buttons: [{
 					extend: 'print',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				},
 				{
 					extend: 'pdfHtml5',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				}
 				// { extend: 'excelHtml5', footer: true },
 			]
 		});
 	});
 	$(document).ready(function() {
 		$('#tabel1').DataTable({
 			dom: 'Bfrtip',
 			buttons: [{
 					extend: 'print',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				},
 				{
 					extend: 'pdfHtml5',
 					messageTop: 'Laporan Penjualan Hari Ini',
 					footer: true
 				}
 				// { extend: 'excelHtml5', footer: true },
 			]
 		});
 	});
 </script>
 <!-- <script>
	var rupiah = document.getElementById("rupiah");
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