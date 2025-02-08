<?php
require "konfig.php";

$input=$_GET['input'];
$id_cabang= $_SESSION['superuser']['id_cabang'];
$id_member= $_SESSION['superuser']['id_member'];
$id_barang=$_GET['id_barang'];



if($input=="add"){
    // $sid = session_id();
    $sql = mysqli_query($koneksi, "SELECT stok FROM barang WHERE id_barang='$id_barang' and id_cabang= '$id_cabang'");
    $s = mysqli_fetch_array($sql);
    $stok = $s['stok']; 
    //echo $stok; exit();

    if ($stok == 0) {
         echo "<script> alert('stock habis'); location.href='index.php?page=jual' </script>";
         exit();
    } else {
    $query=mysqli_query($koneksi, "SELECT id_barang, stok from keranjang where id_barang='$id_barang' and id_cabang='$id_cabang'");
    $data_tmp=mysqli_fetch_array($query);
    $cek=mysqli_num_rows($query);
    $qty = $data_tmp['stok'];
    

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
    // header('location:index.php?page=jual');
    echo "<script>window.location.href='index.php?page=jual'</script>";
    }
}

// session_start();
// //error_reporting(0);
// include "config.php";
// include "tanggal.php";
// $mod = $_GET['mod'];
// $act = $_GET['act'];


// if ($mod == 'basket' AND $act == 'add') {
//     $sid = session_id();
//     $sql = $connect->query("SELECT stock FROM barang WHERE id='$_GET[id]'");
//     $s = mysqli_fetch_array($sql);
//     $stok = $s['stock']; 
//     //echo $stok; exit();

//     if ($stok == 0) {
//          echo "<script> alert('stock habis'); location.href='index.php?hal=pos' </script>";
//          exit();
//     } else {

//         $sql_temp = $connect->query("SELECT * FROM orders_temp WHERE id_barang='$_GET[id]' AND id_session='$sid'");
//         $data_tmp=mysqli_fetch_array($sql_temp);
//         $ketemu = mysqli_num_rows($sql_temp);
//         if(!empty($data_tmp['stok_temp'])) {
//             if ($data_tmp['jumlah'] >= $stok)  {
//                 echo "<script> alert('Jumlah yang dibeli sedang kosong'); location.href='index.php?hal=pos' </script>";
//                 exit();
//             }
//         }

//         if ($ketemu == 0) {
//             // put the product in cart table
//             $connect->query("INSERT INTO orders_temp (id_barang, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp)
// 				VALUES ('$_GET[id]', 1, '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");
//         } else {
//             // update product quantity in cart table
//             $connect->query("UPDATE orders_temp 
// 		        SET jumlah = jumlah + 1
// 				WHERE id_session ='$sid' AND id_barang='$_GET[id]'");
//         }
//         deleteAbandonedCart();
//         echo "<script> alert('Product berhasil dibeli'); location.href='index.php?hal=pos' </script>";
//         exit;
//     }
// } elseif ($mod == 'basket' AND $act == 'del') {
//     $connect->query("DELETE FROM orders_temp WHERE id_orders_temp='$_GET[id]'");
//     echo "<script> alert('Product berhasil dihapus'); location.href='index.php?hal=pos' </script>";
//     exit;
// }


// /*
// 	Delete all cart entries older than one day
// */
// function deleteAbandonedCart()
// {
//     $kemarin = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
//     mysqli_query ("DELETE FROM orders_temp HERE tgl_order_temp < '$kemarin'");
   
// }

?>
