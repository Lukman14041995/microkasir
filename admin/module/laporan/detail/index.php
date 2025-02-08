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
	$query = mysqli_query($koneksi, 
    "SELECT nota.invoice, SUM(nota.total) as total,
    GROUP_CONCAT(nota.jumlah) as jumlah, barang_name.nama_barang, barang_name.id_kat,
    nota.tanggal_input, transaksi.diskon, transaksi.potongan, transaksi.totalsemua, transaksi.invoice,
    transaksi.bayar, transaksi.kembali,transaksi.status,transaksi.id_cabang, member.nm_member,kategori_brg.nama_kat
    FROM nota
    INNER JOIN transaksi ON nota.invoice = transaksi.invoice 
    INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang 
    INNER JOIN member ON nota.id_member = member.id_member
    INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
    WHERE transaksi.id_cabang = '$id' and transaksi.invoice = $idbarang
    GROUP BY nota.invoice");
	$hasil = mysqli_fetch_array($query);
?>
      <!-- <div class="container-fluid"> -->
          <!-- <section class="wrapper"> -->

              <div class="row">
                  <div class="col-lg-12 main-chart">
					 <div class="card">
 						<div class="card-body">
						 <a href="index.php?page=laporan"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Balik </button></a>
						<h3 class="mt-5">Details Penjualan</h3>
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
									<!-- <td>ID Barang</td> -->
									<td><?php echo $hasil['invoice'];?></td>
								</tr>
                                <?php 

                                $q = mysqli_query($koneksi, 
                                "SELECT nota.invoice ,barang_name.id_barang,
                                barang_name.nama_barang, barang_name.id_kat,
                                nota.tanggal_input, transaksi.diskon, transaksi.potongan, transaksi.totalsemua, transaksi.invoice, nota.jumlah,
                                transaksi.bayar, transaksi.kembali,transaksi.status,transaksi.id_cabang, member.nm_member,kategori_brg.nama_kat
                                FROM nota
                                INNER JOIN transaksi ON nota.invoice = transaksi.invoice 
                                INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang 
                                INNER JOIN member ON nota.id_member = member.id_member
                                INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
                                WHERE transaksi.id_cabang = '$id' and transaksi.invoice = $idbarang
                                ");
                                while ($hsl = mysqli_fetch_array($q)) {
                                ?>
								<tr>
                                <form action="" method="post">
									<!-- <td>Kategori</td> -->
                                    <input type="hidden" name="barang" value="<?php echo $idbarang = $_GET['barang']; ?>">
                                    <input type="hidden" name="idbarang" value="<?php echo $hsl['id_barang'] ?>">
									<td><input type="text" value="<?php echo $hsl['nama_barang'];?>" style="border: none;" name="namabarang"></td>
                                    <td><input type="text" value="<?php echo $hsl['jumlah'];?>" style="width: 100px; border: none;" name="jumlah"></td>
                                    <td><button type="submit" name="return" class="btn btn-danger" style="color: white;">Return</button></td>
                                </form>
								</tr>
                                <?php } ?>
								<!-- <tr> -->
									<!-- <td>Nama Barang</td> -->
									<!-- <td><?php echo $hasil['jumlah'];?></td>
								</tr> -->
								<!-- <tr>
									<td>Merk Barang</td>
									<td><?php echo $hasil['merk'];?></td>
								</tr> -->
								<!-- <tr>
									<td>Harga Beli</td>
									<td><?php echo $hasil['harga_beli'];?></td>
								</tr> -->
								<tr>
									<!-- <td>Harga Jual</td> -->
									<td><?php echo $hasil['totalsemua'];?></td>
								</tr>
								<!-- <tr>
									<td>Satuan Barang</td>
									<td><?php echo $hasil['satuan_barang'];?></td>
								</tr>
								<tr>
									<td>Stok</td>
									<td><?php echo $hasil['stok'];?></td>
								</tr>
								<tr> -->
									<!-- <td>Tanggal Input</td>
									<td><?php echo $hasil['tgl_input'];?></td>
								</tr> -->
								<!-- <tr>
									<td>Tanggal Expired</td>
									<td><?php echo $hasil['tgl_expired'];?></td>
								</tr> -->
								<!-- <tr>
									<td>Tanggal Update</td>
									<td><?php echo $hasil['tgl_update'];?></td>
								</tr> -->
						</table>
                        <div class="row">
                            <div class="col-md-12">
                            <a href="index.php?page=laporan" style="color: white;" class="btn btn-success text-end">Selesai</a>
                            </div>
                        </div>
						<div class="clearfix" style="padding-top:16%;"></div>
						</div>
					 </div>
				  </div>
              </div>
          <!-- </section> -->
      <!-- </div> -->
	
<?php

require "konfig.php";
if (isset($_POST['return'])) {
    $invoice = $_POST['barang'];
    $namabarang = $_POST['namabarang'];
    $jumlah = $_POST['jumlah'];
    $id_barang = $_POST['idbarang'];
    $sql = mysqli_query($koneksi, "UPDATE barang SET stok = stok + $jumlah WHERE id_barang = '$id_barang'");
    $s = mysqli_query($koneksi, "UPDATE nota SET jumlah = jumlah - $jumlah WHERE invoice = '$invoice'");
	$transaksi = mysqli_query($koneksi, "UPDATE transaksi SET status = 'Return' WHERE invoice = '$invoice'");
	echo "<script>window.location.href='index.php?page=laporan/detail&barang=$idbarang'</script>";
}

?>