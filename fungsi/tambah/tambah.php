<?php 
session_start();
if(!empty($_SESSION['admin'])){
	require '../../config.php';
	if(!empty($_GET['kategori'])){
		$nama= $_POST['kategori'];
		$tgl= date("j F Y, G:i");
		$data[] = $nama;
		$data[] = $tgl;
		$sql = 'INSERT INTO kategori (nama_kategori,tgl_input) VALUES(?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';
	}
	if(!empty($_GET['barang'])){
		$id = $_POST['id'];
		$kategori = $_POST['kategori'];
		$nama = $_POST['nama'];
		$merk = $_POST['merk'];
		$beli = $_POST['beli'];
		$jual = $_POST['jual'];
		$satuan = $_POST['satuan'];
		$stok = $_POST['stok'];
		$tgl = $_POST['tgl'];
		
		$data[] = $id;
		$data[] = $kategori;
		$data[] = $nama;
		$data[] = $merk;
		$data[] = $beli;
		$data[] = $jual;
		$data[] = $satuan;
		$data[] = $stok;
		$data[] = $tgl;
		$sql = 'INSERT INTO barang (id_barang,id_kategori,nama_barang,merk,harga_beli,harga_jual,satuan_barang,stok,tgl_input) 
			    VALUES (?,?,?,?,?,?,?,?,?) ';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
	}
	if(!empty($_GET['jual'])){
		$id = $_GET['id'];
		$kasir =  $_GET['id_kasir'];
		$jumlah = '0';
		$total = '0';
		$tgl = date("j F Y, G:i");
		
		$data1[] = $id;
		$data1[] = $kasir;
		$data1[] = $jumlah;
		$data1[] = $total;
		$data1[] = $tgl;
		$sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
		$row1 = $config -> prepare($sql1);
		$row1 -> execute($data1);
 		echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
	}


	if (!empty($_GET['pengeluaran'])) {
		$nopengeluaran = $_POST['nopeng'];
		$kategori = $_POST['kategori'];
		$guna = $_POST['guna'];
		$barang = $_POST['barang'];
		$nominal = $_POST['nominal'];
		$oleh = $_POST['oleh'];
		$tgl = date("j F Y, G:i");
		$periode = date("Y-m-d");

		$data2[] = $nopengeluaran;
		$data2[] = $kategori;
		$data2[] = $guna;
		$data2[] = $barang;
		$data2[] = $nominal;
		$data2[] = $oleh;
		$data2[] = $tgl;
		$data2[] = $periode;
		$sql2 = "INSERT INTO pengeluaran (no_pengeluaran, id_kategori, guna, barang, nominal, oleh, tanggal_input, periode) VALUES (?,?,?,?,?,?,?,?) ";
		$row2 = $config -> prepare($sql2);
		$row2 -> execute($data2);
		echo '<script>window.location="../../index.php?page=pengeluaran&success=tambah-data"</script>';
	}

	if (!empty($_GET['member'])) {
		$id = htmlentities($_POST['id']);
		set_time_limit(0);
		$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
		
		if ($_FILES['foto']["error"] > 0) {
			$output['error']= "Error in File";
		} elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
			echo "You can only upload JPG, PNG and GIF file";
			echo "<font face='Verdana' size='2' ><BR><BR><BR>
					<a href='../../index.php?page=user'>Back to upform</a><BR>";

		}elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
			echo "WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB";
			echo "<font face='Verdana' size='2' ><BR><BR><BR>
					<a href='../../index.php?page=user'>Back to upform</a><BR>";

		}else{
			$target_path = '../../assets/img/user/';
			$target_path = $target_path . basename( $_FILES['foto']['name']); 
			if (file_exists("$target_path")){ 
				echo "<font face='Verdana' size='2' >Ini Terjadi Karena Telah Masuk Nama File Yang Sama,
				<br> Silahkan Rename File terlebih dahulu<br>";

			echo "<font face='Verdana' size='2' ><BR><BR><BR>
					<a href='../../index.php?page=user'>Back to upform</a><BR>";

				}elseif(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)){
					//post foto lama
				$foto2 = $_POST['foto2'];
				//remove foto di direktori
				unlink('../../assets/img/user/'.$foto2.'');
				//input foto
				$nama = htmlentities($_POST['nama']);
				$nik = htmlentities($_POST['nik']);
				$telp = htmlentities($_POST['telp']);
				$email = htmlentities($_POST['email']);
				$status = htmlentities($_POST['status']);
				$alamat = htmlentities($_POST['alamat']);
				$foto = $_FILES['foto']['name'];
				$username = htmlentities($_POST['username']);
				$password = md5($_POST['password']);

				
				$konek = mysqli_connect("localhost","root","","db_toko");
				$query = mysqli_query($konek, "INSERT INTO member VALUES (NULL, '$nama', '$alamat', '$telp', '$email', '$foto', '$nik')");
				if ($query = true) {
					$get_id_member = mysqli_query($konek, "SELECT id_member FROM member ORDER BY id_member desc");
					$a = mysqli_fetch_array($get_id_member);
					$id_member = $a['id_member'];
					$member = mysqli_query($konek, "INSERT INTO login VALUES(NULL, '$username', '$password', '$id_member', '$status')");
					
					echo '<script>window.location="../../index.php?page=userdata&success=tambah-data"</script>';
				}
				// $data3[] = $nama;
				// $data3[] = $alamat;
				// $data3[] = $telp;
				// $data3[] = $email;
				// $data3[] = $foto;
				// $data3[] = $nik;
				// $sql3 = "INSERT INTO member (nm_member, alamat_member, telepon, email, gambar, NIK) VALUES (?,?,?,?,?,?) ";
				// $row3 = $config -> prepare($sql3);
				// $row3 -> execute($data3);

				// if ($row3 = true) {
				// 	$view = "SELECT id_member FROM member order by id_member desc ";
				// 	$a = mysqli_fetch_array($view);
				// }
				
				// echo '<script>window.location="../../index.php?page=userdata&success=tambah-data"</script>';
				
			}
		}
		

	}
	
}elseif (!empty($_SESSION['kasir'])) {
	require '../../config.php';
	if(!empty($_GET['jual'])){
		$id = $_GET['id'];
		$kasir =  $_GET['id_kasir'];
		$jumlah = '0';
		$total = '0';
		$tgl = date("j F Y, G:i");
		
		$data1[] = $id;
		$data1[] = $kasir;
		$data1[] = $jumlah;
		$data1[] = $total;
		$data1[] = $tgl;
		$sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
		$row1 = $config -> prepare($sql1);
		$row1 -> execute($data1);
 		echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
	}
}