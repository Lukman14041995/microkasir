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
		$id = $_POST['idbarang'];
		// $kategori = $_POST['kategori'];
		// $nama = $_POST['nama'];
		// $beli = $_POST['beli'];
		// $jual = $_POST['jual'];
		$satuan = $_POST['satuan'];
		$stok = $_POST['stok'];
		$tgl = $_POST['tgl'];
		$tgl_inp = date('Y-m-d');
		// $tgl_exp = $_POST['tgl_expired'];
		$id_cabang = $_POST['id_cabang'];
		// $barcode = "$id-$tgl_exp";
		
		$data[] = $id;
		// $data[] = $kategori;
		// $data[] = $nama;
		// $data[] = $merk;
		// $data[] = $beli;
		// $data[] = $jual;
		$data[] = $satuan;
		$data[] = $stok;
		$data[] = $tgl;
		$data[] = $tgl_inp;
		// $data[] = $tgl_exp;
		$data[] = $id_cabang;
		// $data[] = $barcode;
		
		$sql = 'INSERT INTO barang (id_barang,satuan_barang,stok,tgl_input,input_tgl,id_cabang) 
			    VALUES (?,?,?,?,?,?) ';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
		
	}
	if (!empty($_GET['barang_name'])) {
		$id_cabang = $_POST['id_cabang'];
		$id = $_POST['id'];
		$harga = $_POST['harga'];
		$tgl = $_POST['tgl'];
		$nama = $_POST['nama'];
		$kategori = $_POST['kategori'];
		$idkat = $_POST['jenisbrg'];

		$data[] = $id;
		$data[] = $nama;
		$data[] = $kategori;
		$data[] = $harga;
		$data[] = $tgl;
		$data[] = $id_cabang;
		$data[] = $idkat;
		$sql = "INSERT INTO barang_name (id_barang, nama_barang, id_kategori, harga_jual, tgl_input, id_cabang, id_kat) VALUES (?,?,?,?,?,?,?)";
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=input_barang&success=tambah-data"</script>';
	}
	if (!empty($_GET['cabang'])) {
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$tgl = $_POST['tgl'];

		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $tgl;
		$sql = "INSERT INTO cabang (nama_cabang, alamat, tgl_input) VALUES (?,?,?)";
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo "<script>window.location='../../index.php?page=cabang&success=tambah-data'</script>";
	}
	if(!empty($_GET['jual'])){
		$id = $_GET['id'];
		$kasir =  $_GET['id_kasir'];
		$id_cabang = $_GET['id_cabang'];
		$jumlah = '0';
		$total = '0';
		$tgl = date("j F Y, G:i");
		
		$data1[] = $id;
		$data1[] = $kasir;
		$data1[] = $jumlah;
		$data1[] = $total;
		$data1[] = $tgl;
		$data1[] = $id_cabang;
		$sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input,id_cabang) VALUES (?,?,?,?,?,?)';
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
		$id_cabang = $_POST['id_cabang'];

		$data2[] = $nopengeluaran;
		$data2[] = $kategori;
		$data2[] = $guna;
		$data2[] = $barang;
		$data2[] = $nominal;
		$data2[] = $oleh;
		$data2[] = $tgl;
		$data2[] = $periode;
		$data2[] = $id_cabang;
		$sql2 = "INSERT INTO pengeluaran (no_pengeluaran, id_kategori, guna, barang, nominal, oleh, tanggal_input, periode, id_cabang) 
				 VALUES (?,?,?,?,?,?,?,?,?) ";
		$row2 = $config -> prepare($sql2);
		$row2 -> execute($data2);
		echo '<script>window.location="../../index.php?page=pengeluaran&success=tambah-data"</script>';
	}

	if (!empty($_GET['member'])) {
		$id = $_POST['id'];
		
		//input foto
		$nama = $_POST['nama'];
		$nik = $_POST['nik'];
		$telp = $_POST['telp'];
		$email = $_POST['email'];
		$status = $_POST['role'];
		$alamat = $_POST['alamat'];
		// $foto = $_FILES['foto']['name'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		// $cabang = $_POST['cabang'];
		
		require "konfig.php";
		$query = mysqli_query($koneksi, "INSERT INTO member VALUES (NULL, '$nama', '$alamat', '$telp', '$email', '', '$nik')");
		if ($query = true) {
			$get_id_member = mysqli_query($koneksi, "SELECT id_member FROM member ORDER BY id_member desc");
			$a = mysqli_fetch_array($get_id_member);
			$id_member = $a['id_member'];
			$member = mysqli_query($koneksi, "INSERT INTO login VALUES(NULL, '$username', '$password', '$id_member', '$status', '')");
			
			echo '<script>window.location="../../index.php?page=userdata&success=tambah-data"</script>';
		}		
	}

	if (!empty($_GET['order'])) {
		$id = $_POST['idan'];
		$nama = $_POST['nama'];
		$nohp = $_POST['nohp'];
		$tgl = $_POST['tgl'];
		$ambil = $_POST['ambil'];
		$alamat = $_POST['alamat'];
		$deskripsi = $_POST['deskripsi'];
		$id_cabang = $_POST['id_cabang'];
		$id_barang = "BR007";

		$data5[] = $id;
		$data5[] = $nama;
		$data5[] = $nohp;
		$data5[] = $tgl;
		$data5[] = $ambil;
		$data5[] = $alamat;
		$data5[] = $deskripsi;
		$data5[] = $id_cabang;
		$data5[] = $id_barang;
		$sql5 = "INSERT INTO orderan (id_order,nama_pemesan,no_hp,tgl_pesan,tgl_ambil,alamat,deskripsi,id_cabang,id_barang) VALUES (?,?,?,?,?,?,?,?,?)";
		$row5 = $config -> prepare($sql5);
		$row5 -> execute($data5);
		echo "<script>window.location = '../../index.php?page=order&success=tambah-data'</script>";
	}
	
}elseif (!empty($_SESSION['kasir'])) {
	require '../../config.php';
	if(!empty($_GET['jual'])){
		$id = $_GET['id'];
		$kasir =  $_GET['id_kasir'];
		$id_cabang = $_GET['id_cabang'];
		$jumlah = '0';
		$total = '0';
		$tgl = date("j F Y, G:i");
		
		$data1[] = $id;
		$data1[] = $kasir;
		$data1[] = $jumlah;
		$data1[] = $total;
		$data1[] = $tgl;
		$data1[] = $id_cabang;
		$sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input,id_cabang) VALUES (?,?,?,?,?,?)';
		$row1 = $config -> prepare($sql1);
		$row1 -> execute($data1);
 		echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
	}
	if (!empty($_GET['barang_name'])) {
		$id_cabang = $_POST['id_cabang'];
		$id = $_POST['id'];
		$harga = $_POST['harga'];
		$tgl = $_POST['tgl'];
		$nama = $_POST['nama'];
		$kategori = $_POST['kategori'];

		$data[] = $id;
		$data[] = $nama;
		$data[] = $kategori;
		$data[] = $harga;
		$data[] = $tgl;
		$data[] = $id_cabang;
		$sql = "INSERT INTO barang_name (id_barang, nama_barang, id_kategori, harga_jual, tgl_input, id_cabang) VALUES (?,?,?,?,?,?)";
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=input_barang&success=tambah-data"</script>';
	}

	if(!empty($_GET['barang'])){
		$id = $_POST['idbarang'];
		// $kategori = $_POST['kategori'];
		// $nama = $_POST['nama'];
		// $beli = $_POST['beli'];
		// $jual = $_POST['jual'];
		$satuan = $_POST['satuan'];
		$stok = $_POST['stok'];
		$tgl = $_POST['tgl'];
		$tgl_inp = date('Y-m-d');
		// $tgl_exp = $_POST['tgl_expired'];
		$id_cabang = $_POST['id_cabang'];
		// $barcode = "$id-$tgl_exp";
		
		$data[] = $id;
		// $data[] = $kategori;
		// $data[] = $nama;
		// $data[] = $merk;
		// $data[] = $beli;
		// $data[] = $jual;
		$data[] = $satuan;
		$data[] = $stok;
		$data[] = $tgl;
		$data[] = $tgl_inp;
		// $data[] = $tgl_exp;
		$data[] = $id_cabang;
		// $data[] = $barcode;
		
		$sql = 'INSERT INTO barang (id_barang,satuan_barang,stok,tgl_input,input_tgl,id_cabang) 
			    VALUES (?,?,?,?,?,?) ';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
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
		$id_cabang = $_POST['id_cabang'];

		$data2[] = $nopengeluaran;
		$data2[] = $kategori;
		$data2[] = $guna;
		$data2[] = $barang;
		$data2[] = $nominal;
		$data2[] = $oleh;
		$data2[] = $tgl;
		$data2[] = $periode;
		$data2[] = $id_cabang;
		$sql2 = "INSERT INTO pengeluaran (no_pengeluaran, id_kategori, guna, barang, nominal, oleh, tanggal_input, periode, id_cabang) 
				 VALUES (?,?,?,?,?,?,?,?,?) ";
		$row2 = $config -> prepare($sql2);
		$row2 -> execute($data2);
		echo '<script>window.location="../../index.php?page=pengeluaran&success=tambah-data"</script>';
	}
}elseif (!empty($_SESSION['superuser'])) {
	require "../../config.php";
	if (!empty($_GET['pengeluaran'])) {
		$nopengeluaran = $_POST['nopeng'];
		$kategori = $_POST['kategori'];
		$guna = $_POST['guna'];
		$barang = $_POST['barang'];
		$nominal = $_POST['nominal'];
		$oleh = $_POST['oleh'];
		$tgl = date("j F Y, G:i");
		$periode = date("Y-m-d");

		$data[] = $nopengeluaran;
		$data[] = $kategori;
		$data[] = $guna;
		$data[] = $barang;
		$data[] = $nominal;
		$data[] = $oleh;
		$data[] = $tgl;
		$data[] = $periode;
		$sql = "INSERT INTO pengeluaran (no_pengeluaran,id_kategori, guna, barang, nominal, oleh, tanggal_input, periode) VALUES (?,?,?,?,?,?,?,?)";
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo "<script>window.location='../../index.php?page=pengeluaran&success=tambah-data'</script>";
	}
}