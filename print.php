<?php 
	$konek = mysqli_connect("localhost","root","","db_toko");
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	$hsl = $lihat -> penjualan();
	if (isset($_GET['print'])) {
		$id_barang = $_GET['id_barang'];
		$id_member = $_GET['id_member'];
		$invoice = $_GET['invoice'];
		$jumlah = $_GET['jumlah'];
		$total = $_GET['total'];
		$tgl_input = $_GET['tgl_input'];
		$periode = $_GET['periode'];
		$member = $_GET['member'];
		$disc = $_GET['disc'];
		$pay = $_GET['pay'];
		$kembali = $_GET['kembali'];
		$totalakhir = $_GET['totalakhir'];
		$totalbayar = $_GET['totalbayar'];
		$jumlah_dipilih = count($id_barang);
		$periode = date("Y-m-d");	
				
		$q = mysqli_query($konek, "SELECT nota.*,barang.nama_barang FROM nota INNER JOIN barang ON nota.id_barang = barang.id_barang ");
		$cek = mysqli_query($konek, "SELECT	* FROM transaksi WHERE invoice = '$invoice'");
		$a = mysqli_fetch_array($q);
		$nama_barang = $a['nama_barang'];
		if ($q = mysqli_num_rows($cek) > 0 ) {
			echo '<script>alert("Invoice Barang Sudah diPrint");window.location="index.php?page=jual"</script>';
		}else {
			$query = mysqli_query($konek, "INSERT INTO transaksi VALUES (NULL,'$invoice','$disc','$totalakhir','$pay','$kembali','$periode')");
		}
	}
?>
<html>
	<head>
		<title>Print</title>
		<link rel="stylesheet" href="assets/css/bootstrap.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	</head>
	<body>
		<!-- <script>window.print();</script> -->
		<div class="container">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<center>
					<img src="assets/img/logo.png" class="img-fluid mx-auto d-block" width="80" alt="">
					<p><?php echo $toko['nama_toko'];?></p>
						<p><?php echo $toko['alamat_toko'];?></p>
						<p>Invoice : <?php echo $invoice;?></p>
						<p>Tanggal : <?php  echo date("j F Y, G:i");?></p>
						<p>Kasir : <?php  echo $member ;?></p>
					</center>
					<table class="table table-bordered" style="width:100%;">
						<tr>

							<td>Barang</td>
							<td>Jumlah</td>
							<td>Total</td>
						</tr>
						<?php $no=1; foreach($hsl as $isi){?>
						<tr>
							<td><?php echo $isi['nama_barang'];?></td>
							<td><?php echo $isi['jumlah'];?></td>
							<td><?php echo $isi['total'];?></td>
						</tr>
						<?php  }?>
						
					</table>
					<div class="pull-right">
						Jumlah : <?php echo number_format($totalbayar) ?>,-
						<br>
						Diskon : <?php echo $disc . "%"?>
						<br/>
						Total : Rp.<?php echo number_format($totalakhir);?>,-
						<br/>
						Bayar : Rp.<?php echo number_format($pay) ?>,-
						<br/>
						Kembali : Rp.<?php echo number_format($kembali) ?>,-
					</div>
					<div class="clearfix"></div>
					<center style="margin-top: 10px;">
						<p>Terima Kasih Telah berbelanja di toko kami !</p>
					</center>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	</body>
</html>
