<h3>Daily Report Bolu Nanas Randudongkal, <?php echo date('j F Y, G:i') ?></h3>

<p>Jumlah Kunjungan</p>
<p>30 Customer</p>

<?php
require "konfig.php";
$date =  date('Y-m-d');
$sql = mysqli_query($koneksi, "SELECT sum(totalsemua) as tot FROM transaksi WHERE periode like '%". $date ."%'");
$data = mysqli_fetch_array($sql);
$total = $data['tot'];
?>
<h4>Total Omset : <?php echo $total ?> </h4>

<?php
require "konfig.php";
$date =  date('Y-m-d');
$q =mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlah,barang_name.id_barang, SUM(barang_name.harga_jual) as harga_jual, barang_name.id_kat, barang_name.nama_barang ,kategori_brg.nama_kat
FROM nota
INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
WHERE nota.periode like '%". $date ."%' and kategori_brg.nama_kat = 'ORIGINAL' ");
while ($data = mysqli_fetch_array($q)) {
   $totalori =  $data['harga_jual'];  
}

$r =mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlah,barang_name.id_barang, SUM(barang_name.harga_jual) as harga_jual, barang_name.id_kat, barang_name.nama_barang ,kategori_brg.nama_kat
FROM nota
INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
WHERE nota.periode like '%". $date ."%' and kategori_brg.nama_kat = 'UMKM' ");
while ($data1 = mysqli_fetch_array($r)) {
  echo $totalukm =  $data1['harga_jual'];  
}

$t =mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlahnya,barang_name.id_barang,barang_name.id_kat, barang_name.nama_barang ,kategori.nama_kategori
FROM nota
INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori
WHERE nota.periode like '%". $date ."%' and kategori.nama_kategori = 'tart' ");
$data2 = mysqli_fetch_array($t);
  
?>
<p>Ritel Toko : <?php echo $totalori ?></p>
<p>UKM : <?php echo $totalukm ?></p>
<!-- <p>Tart : <?php echo $data2['jumlahnya'] ?></p> -->

<h4>Bolu Nanas Terjual :</h4>
<?php 
require "konfig.php";
$koneksi = mysqli_connect("localhost","root","","db_toko");
$date =  date('Y-m-d');
$sql =mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlah,barang_name.id_barang,barang_name.id_kat, barang_name.nama_barang ,kategori_brg.nama_kat
FROM nota
INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
WHERE nota.periode like '%". $date ."%' and kategori_brg.nama_kat = 'ORIGINAL' GROUP BY nota.id_barang");
while ($a = mysqli_fetch_array($sql)) {
    // $jumlah += $a['jumlah']; 
?>
<p><?php echo $a['nama_barang'] ?> : <?php echo $a['jumlah'] ?></p>
<?php } ?>

<h4>UKM :</h4>
<?php 
require "konfig.php";
$koneksi = mysqli_connect("localhost","root","","db_toko");
$date =  date('Y-m-d');
$sql =mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlah,barang_name.id_barang,barang_name.id_kat, barang_name.nama_barang ,kategori_brg.nama_kat
FROM nota
INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
WHERE nota.periode like '%". $date ."%' and kategori_brg.nama_kat = 'UMKM' GROUP BY nota.id_barang");
while ($a = mysqli_fetch_array($sql)) {
    // $jumlah += $a['jumlah']; 
?>
<p><?php echo $a['nama_barang'] ?> : <?php echo $a['jumlah'] ?></p>
<?php } ?>

<h4>Tester :</h4>

<h4>Pendapatan : <?php echo $total ?></h4>
<?php
require "konfig.php";
// $id = $_SESSION['admin']['id_cabang'];
$date = date('Y-m-d');
$query_pengeluaran = mysqli_query($koneksi, "SELECT SUM(nominal) as nominal FROM pengeluaran WHERE periode like '%". $date ."%'");
$pengeluaran = mysqli_fetch_assoc($query_pengeluaran); 
?>
<h4>Pengeluaran : <?php echo $pengeluaran['nominal'] ?></h4>
<?php $saldo = $total - $pengeluaran['nominal'] ?>
<h4>Sisa Saldo : <?php echo $saldo ?> </h4>