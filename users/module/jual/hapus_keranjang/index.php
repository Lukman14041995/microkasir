<?php
include "konfig.php";
$hapus=$_GET['hapus'];
$id_cabang=$_GET['id_cabang'];
$query_hapus=mysqli_query($koneksi, "DELETE FROM keranjang where id_keranjang='$hapus'");
if(!$query_hapus){
	?>
	<script> alert('Data Berhasil Di Simpan'); location.href='index.php?hal=master/barang/list' </script>
	<?php
}else{
	echo "<script>window.location.href='index.php?page=jual'</script>";
}
?>