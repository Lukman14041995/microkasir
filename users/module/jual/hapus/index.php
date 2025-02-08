<?php 

$idcabang = $_GET['id_cabang'];
$q = mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_cabang = '$idcabang'");
echo "<script>window.location.href='index.php?page=jual'</script>";

?>
