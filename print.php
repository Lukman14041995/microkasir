<?php 
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	// $hsl = $lihat -> keranjang();
	
    if (isset($_GET['bayar'])) {
		require "konfig.php";
		$idbarang = $_GET['idbarang'];
        $subtotal = $_GET['subtot'];
        $invoice = $_GET['invoice'];
        $idmember = $_GET['idmember'];
        $idcabang = $_GET['idcabang'];
        $nmmember = $_GET['nmmember'];
        $diskon = $_GET['disc'];
		$jumlah = $_GET['stok'];
        $potongan = $_GET['pot'];
        $bigtotal = $_GET['bigtotal'];
        $bayar = $_GET['cash'];
        $tgl_input = $_GET['tgl_input'];
        $periode = $_GET['periode'];	
		$per = date("Y-m-d");
		$bulan = date("F");
		$invo = $_GET['invo'];
		$cabang = $_GET['cabang'];
		$kembalian = $_GET['kembalian'];
		$subtot = $_GET['subtot'];
		$jml = count($idbarang);
		
		include "config.php";
		for ($x = 0; $x < $jml; $x++) { 
			$d = array(
				$idbarang[$x],
				$idmember[$x],
				$invoice[$x],
				$jumlah[$x],
				$subtotal[$x],
				$tgl_input[$x],
				$periode[$x]
			); 
			$ceki = mysqli_query($koneksi, "SELECT * FROM nota WHERE id_barang = '$idbarang[$x]' and invoice = '$invoice[$x]'");
			if (mysqli_num_rows($ceki) > 0) {
				// echo "double";
			}else{
			$sql = "INSERT INTO nota (id_barang,id_member,invoice,jumlah,total,tanggal_input,periode) VALUES(?,?,?,?,?,?,?)";
			$row = $config->prepare($sql);
			$row->execute($d);

			// ubah stok barang
			$sql_barang = "SELECT * FROM barang WHERE id_barang = ?";
			$row_barang = $config->prepare($sql_barang);
			$row_barang->execute(array($idbarang[$x]));
			$hsl = $row_barang->fetch();
			
			$stok = $hsl['stok'];
			$idb  = $hsl['id_barang'];

			$total_stok = $stok - $jumlah[$x];
			// echo $total_stok;
			$sql_stok = "UPDATE barang SET stok = ? WHERE id_barang = ?";
			$row_stok = $config->prepare($sql_stok);
			$row_stok->execute(array($total_stok, $idb));
			}
		}
// 		$hapus=$_GET['hapus'];
// $id_cabang=$_GET['id_cabang'];
		require "konfig.php";
		$cek = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE invoice = '$invo'");
		if (mysqli_num_rows($cek) > 0) {
			# code...
		}else {
			$insert = mysqli_query($koneksi, "INSERT INTO transaksi VALUES (null, '$invo', '$diskon', '$potongan','$bigtotal', '$bayar', '', '$per', '$bulan', '$cabang', 'open')");
		}
	}
?>
<html>
	<head>
		<title>Print</title>
		
	</head>
	<style>
		 * {
    font-size: 12px;
    font-family: 'Merchant Copy Doublesize';
	}

	
	tr.border {
		border-top : 1px solid black;
		border-collapse: collapse;
	}

	td.description,
	th.description {
		text-align : center;
		width: 30px;
		max-width: 75px;
	}

	td.quantity,
	th.quantity {
		width: 74px;
		max-width: 74px;
		word-break: break-all;
		
	}

	td.price,
	th.price {
		width: 80px;
		max-width: 80px;
		word-break: break-all;
	}

	.centered {
		text-align: center;
		align-content: center;
	}

	.ticket {
		width: 200px;
		max-width: 200px;
	}

	img {
		max-width: inherit;
		width: inherit;
	}
	table{
		margin-right: 20px;
	}
	@media print {
		.hidden-print,
		.hidden-print * {
			display: none !important;
		}
	}   
	</style>
	<body>
		
		<div class="ticket" style="margin-left: -8px">
            <!-- <img src="./logo.png" alt="Logo"> -->
			<img src="assets/img/logo.png" style="margin-left: -18px" class="img-fluid  d-block" width="80" alt="">
			<!-- <h1 style="text-align:center">Nusantara</h1> -->
            <p class="centered">
					<!-- <p><?php echo $toko['nama_toko'];?></p> -->
						<p><?php echo $toko['alamat_toko'];?></p>
						<p>Invoice : <?php echo $invo;?></p>
						<p>Tanggal : <?php  echo date("j F Y, G:i");?></p>
						<p>Kasir : <?php  echo $nmmember ;?></p>
						<p>HP : 0857-1390-8598</p>
					</p>
			=============================
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Barang</th>
                        <th class="description">Qty</th>
                        <th class="description">Disc</th>
                        <th class="price">Sub Total</th>
                    </tr>
                </thead>
			</table>
			=============================
			<table>
                <tbody>
				<?php $no=1;
						require "konfig.php";
						$cabang = $_GET['cabang'];
						$sql = mysqli_query($koneksi, "SELECT keranjang.*, barang.id_barang, barang_name.nama_barang, barang_name.disc, barang_name.harga_jual, member.id_member, member.nm_member from keranjang left join barang on barang.id_barang=keranjang.id_barang left join barang_name on barang_name.id_barang = barang.id_barang left join member on member.id_member=keranjang.id_member
						WHERE keranjang.id_cabang = '$cabang'");

						while($isi = mysqli_fetch_array($sql)){?>
						<?php $totalsemua = $isi['stok'] * $isi['harga_jual'] ?>
						<tr class="border">
							<td class="quantity"><?php echo $isi['nama_barang'];?></td>
							<td class="description"><?php echo $isi['stok'];?></td>
							<td class="description"><?php echo $isi['disc'];?></td>
							<td class="price">Rp <?php echo number_format($totalsemua)?></td>
						</tr>
					<?php } ?>
					</table>
					=============================
					<table>
                    <tr>
                        <td class="quantity">Big Total</td>
                        <td class="description"></td>
                        <td class="price">Rp. <?php echo number_format($bigtotal); ?>,-</td>
                    </tr>
                    <tr>
                        <td class="quantity">Diskon</td>
                        <td class="description"></td>
                        <td class="price"> <?php echo $disc . "%";?></td>
                    </tr>
                    <tr>
                        <td class="quantity">Potongan</td>
                        <td class="description"></td>
                        <td class="price">Rp. <?php echo number_format($potongan) ;?></td>
                    </tr>
                    <tr>
                        <td class="quantity">Bayar</td>
                        <td class="description"></td>
                        <td class="price">Rp. <?php echo number_format($bayar) ; ?>,-</td>
                    </tr>
                    <tr>
                        <td class="quantity">Kembalian</td>
                        <td class="description"></td>
                        <td class="price">Rp. <?php echo number_format($kembalian) ; ?>,-</td>
                    </tr>
					
                </tbody>
            </table>
            <p style="text-align:center; margin-top: 50px;">Terima Kasih Telah berbelanja di Nusantara </p>
                <p style="text-align:center;">&copy; <?php echo date('Y') ?></p>
        </div>



		
		<script>window.print();</script>
		
	</body>
</html>
