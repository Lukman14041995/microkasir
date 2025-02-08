<?php
require "konfig.php";

$input = $_GET['input'];
$id_cabang = $_SESSION['kasir']['id_cabang'];
$id_member = $_SESSION['kasir']['id_member'];
$id_barang = $_GET['id_barang'];

if(isset($_POST['qty'])){
    $qty = $_POST['qty'];
    $idbarang = $_POST['idbarang'];

    mysqli_query($koneksi, "UPDATE keranjang SET stok='$qty' where id_barang='$idbarang' and id_cabang='$id_cabang'");
    echo "<script>window.location.href='index.php?page=jual#atas'</script>";
}

if($input == "add"){
    // $sid = session_id();
    $sql = mysqli_query($koneksi, "SELECT stok FROM barang WHERE id_barang='$id_barang' and id_cabang= '$id_cabang'");
    $s = mysqli_fetch_array($sql);
    $stok = $s['stok']; 
    //echo $stok; exit();

    if ($stok == 0) {
         echo "<script> alert('stock habis'); location.href='jual.php' </script>";
         exit();
    } else {
    $query=mysqli_query($koneksi, "SELECT id_barang, stok from keranjang where id_barang='$id_barang' and id_cabang='$id_cabang'");
    $data_tmp=mysqli_fetch_array($query);
    $cek=mysqli_num_rows($query);
    $qty = $data_tmp['stok'];
    $idbarangg = $data_tmp['id_barang'];
    if($cek == 0){
        mysqli_query($koneksi, "INSERT INTO keranjang VALUES (null, '$id_barang','$id_member','1','$id_cabang')");
        
    }
    else if($qty >= $stok){

        echo "<script> alert('Stock yang tersedia tidak cukup'); location.href='index.php?page=jual' </script>";
                exit();
    }
    else{
        mysqli_query($koneksi, "UPDATE keranjang SET stok=stok+1 where id_barang='$id_barang' and id_cabang='$id_cabang'");
    }
    header("location:index.php?page=jual&id_barang='$idbarangg'");
    // echo "<script>window.location.href='index.php?page=jual&id_barang=$idbarangg'</script>";
    }
}
elseif ($kurang = "add") {
    mysqli_query($koneksi, "UPDATE keranjang SET stok=stok-1 WHERE id_barang='$id_barang' and id_cabang='$id_cabang'");
    echo "<script>window.location.href='index.php?page=jual'</script>";
}




?>
