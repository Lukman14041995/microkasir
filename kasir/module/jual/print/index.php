<?php 
	$konek = mysqli_connect("localhost","root","","db_toko");
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	// $hsl = $lihat -> keranjang();
	function isi_keranjang(){
		require "konfig.php";

		$isikeranjang = array();
		$id_member = $_SESSION['admin']['id_member'];
        $id_cabang = $_SESSION['admin']['id_cabang'];
        $sql = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_member = '$id_member' and id_cabang = '$id_cabang'");
        while ($r = mysqli_fetch_array($sql)) {
            $isikeranjang[] = $r;
        }
        return $isikeranjang;
	}
    $isikeranjang = isi_keranjang();
    $jml = count($isikeranjang);

    if ($jml == 0) {
        echo "<script>alert('Produk masih kosong'); window.location='index.php?page=jual'</script>";
    }
    if (isset($_POST['bayar'])) {
        $subtotal = $_POST['subtotal'];
        $invoice = $_POST['invoice'];
        $idmember = $_POST['idmember'];
        $idcabang = $_POST['idcabang'];
        $nmmember = $_POST['nmmember'];
        $diskon = $_POST['diskon'];
        $potongan = $_POST['potongan'];
        $bigtotal = $_POST['bigtotal'];
        $bayar = $_POST['cash'];
        $tgl_input = date("j F Y, G:i");
        $periode = date("Y-m-d");	
		$bulan = date("F");

        for ($i = 0; $i < $jml ; $i++) { 
            require "konfig.php";
            mysqli_query($koneksi, "INSERT INTO nota ('id_barang', 'id_member', 'invoice', 'jumlah', 'total','tanggal_input', 'periode') VALUES ('{$isikeranjang[$i]['id_barang']}','{$isikeranjang[$i]['$idmember']}','$invoice','{$isikeranjang[$i]['stok']}','{$isikeranjang[$i]['$subtotal']}','{$isikeranjang[$i]['$tgl_input']}','{$isikeranjang[$i]['$periode']}')");
            mysqli_query($koneksi, "UPDATE barang SET stok = stok - '{$isikeranjang[$i]['stok']}' WHERE id_barang = '{$isikeranjang[$i]['id_barang']}'");
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

	@media print {
		.hidden-print,
		.hidden-print * {
			display: none !important;
		}
	}   
	</style>
	<body>
		
		<div class="ticket">
            <!-- <img src="./logo.png" alt="Logo"> -->
			<img src="assets/img/Logo AHSAN.png" class="img-fluid mx-auto d-block" width="80" alt="">
			<!-- <h1 style="text-align:center">AHSAN</h1> -->
            <p class="centered">
					<!-- <p><?php echo $toko['nama_toko'];?></p> -->
						<p><?php echo $toko['alamat_toko'];?></p>
						<p>Invoice : <?php echo $invoice;?></p>
						<p>Tanggal : <?php  echo date("j F Y, G:i");?></p>
						<p>Kasir : <?php  echo $member ;?></p>
					</p>
			=============================
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Barang</th>
                        <th class="description">Qty</th>
                        <th class="price">Sub Total</th>
                    </tr>
                </thead>
			</table>
			=============================
			<table>
                <tbody>
				<?php $no=1;
						require "konfig.php";
						$sql = mysqli_query($koneksi, "SELECT keranjang.*, barang.id_barang, barang_name.nama_barang, barang_name.harga_jual, member.id_member,
						member.nm_member from keranjang 
					   left join barang on barang.id_barang=keranjang.id_barang
					   left join barang_name on barang_name.id_barang = barang.id_barang 
					   left join member on member.id_member=keranjang.id_member
					   WHERE keranjang.id_cabang = '$id_cabang';
					   ORDER BY id_keranjang");
						foreach($hsl as $isi){?>
						<tr class="border">
							<td class="quantity"><?php echo $isi['nama_barang'];?></td>
							<td class="description"><?php echo $isi['jumlah'];?></td>
							<td class="price">Rp <?php echo number_format($isi['total']);?></td>
						</tr>
					<?php } ?>
					</table>
					=============================
					<table>
                    <tr>
                        <td class="quantity">Big Total</td>
                        <td class="description"></td>
                        <td class="price">Rp. <?php echo number_format($totalbayar); ?>,-</td>
                    </tr>
                    <tr>
                        <td class="quantity">Diskon</td>
                        <td class="description"></td>
                        <td class="price">Rp. <?php echo $disc . "%";?></td>
                    </tr>
                    <tr>
                        <td class="quantity">Potongan</td>
                        <td class="description"></td>
                        <td class="price">Rp. <?php echo number_format($potongan);?></td>
                    </tr>
                    <tr>
                        <td class="quantity">Bayar</td>
                        <td class="description"></td>
                        <td class="price">Rp. <?php echo number_format($pay); ?>,-</td>
                    </tr>
                    <tr>
                        <td class="quantity">Kembalian</td>
                        <td class="description"></td>
                        <td class="price">Rp. <?php echo number_format($kembali); ?>,-</td>
                    </tr>
					
                </tbody>
            </table>
            <p style="text-align:center; margin-top: 50px;">Terima Kasih Telah berbelanja di Roti Ahsan </p>
                <p style="text-align:center;">&copy; <?php echo date('Y') ?></p>
        </div>



		
		<script>window.print();</script>
		
	</body>
</html>
