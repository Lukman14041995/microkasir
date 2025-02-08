<?php 

require "koneksi.php";
if (isset($_POST['return'])) {
    $invoice = $_POST['barang'];
    $namabarang = $_POST['namabarang'];
    $jumlah = $_POST['jumlah'];
    $idbarang = $_POST['idbarang'];
    $sql = mysqli_query($koneksi, "UPDATE barang SET stok = stok + '$jumlah' WHERE id_barang = '$idbarang'");
    $s = mysqli_query($koneksi, "UPDATE nota SET jumlah = jumlah - '$jumlah' WHERE id_barang = '$idbarang'");
    echo "<script>window.location.href='index.php?page=laporan/detail'</script>";
}


?>