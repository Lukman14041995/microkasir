<?php 
session_start();
if(!empty($_SESSION['admin'])){
	require '../../config.php';
	if(!empty($_GET['pengaturan'])){
		// $nama= htmlentities($_POST['namatoko']);
		// $alamat = htmlentities($_POST['alamat']);
		$alamat = htmlentities($_POST['alamat']);
		// $pemilik = htmlentities($_POST['pemilik']);
		$id = '1';
		
		// $data[] = $nama;
		// $data[] = $alamat;
		$data[] = $alamat;
		// $data[] = $pemilik;
		$data[] = $id;
		$sql = 'UPDATE cabang SET alamat=? WHERE id_cabang = ?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=pengaturan&success=edit-data"</script>';
	}

	if(!empty($_GET['kategori'])){
		$nama= htmlentities($_POST['nama']);
		$id= htmlentities($_POST['id']);
		$tgl = htmlentities($_POST['tgl']);

		$data[] = $nama;
		$data[] = $tgl;
		$data[] = $id;
		$sql = 'UPDATE kategori SET  nama_kategori=?,tgl_update=? WHERE id_kategori=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=kategori&uid='.$id.'&success-edit=edit-data"</script>';
	}

	if(!empty($_GET['stok'])){
		$restok = htmlentities($_POST['restok']);
		$id = htmlentities($_POST['id']);
		$dataS[] = $id;
		$sqlS = 'select*from barang WHERE id_barang=?';
		$rowS = $config -> prepare($sqlS);
		$rowS -> execute($dataS);
		$hasil = $rowS -> fetch();
		$stok = $restok + $hasil['stok'];
		
		$data[] = $stok;
		$data[] = $id;
		$sql = 'UPDATE barang SET stok=? WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang&success-stok=stok-data"</script>';
	}
	if (!empty($_GET['invo'])) {
		$invoice = htmlentities($_POST['id']);
		$status = "Reject";
		
		$data[] = $status;
		$data[] = $invoice;
		$sql = "UPDATE transaksi SET status =? WHERE invoice =?";
	}
	if(!empty($_GET['barang'])){
		$id = htmlentities($_POST['id']);
		// $kategori = htmlentities($_POST['kategori']);
		// $nama = htmlentities($_POST['nama']);
		// $merk = htmlentities($_POST['merk']);
		// $beli = htmlentities($_POST['beli']);
		// $jual = htmlentities($_POST['jual']);
		$satuan = htmlentities($_POST['satuan']);
		$stok = htmlentities($_POST['stok']);
		$tgl = htmlentities($_POST['tgl']);
		
		// $data[] = $kategori;
		// $data[] = $nama;
		// $data[] = $merk;
		// $data[] = $beli;
		// $data[] = $jual;
		$data[] = $satuan;
		$data[] = $stok;
		$data[] = $tgl;
		$data[] = $id;
		$sql = 'UPDATE barang SET satuan_barang=?, stok=?, tgl_update=?  WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang&success=edit-data"</script>';
	}

	if(!empty($_GET['input_barang'])){
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$kategori = htmlentities($_POST['kategori']);
		$idkat = htmlentities($_POST['jenisbrg']);
		// $beli = htmlentities($_POST['beli']);
		$jual = htmlentities($_POST['jual']);
		$tgl = htmlentities($_POST['tgl']);
		
		$data[] = $nama;
		$data[] = $kategori;
		// $data[] = $beli;
		$data[] = $jual;
		$data[] = $tgl;
		$data[] = $idkat;
		$data[] = $id;
		$sql = 'UPDATE barang_name SET nama_barang=?, id_kategori=?,
				harga_jual=?, tgl_update=?, id_kat=?  WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=input_barang&edit=edit-data"</script>';
	}

	if(!empty($_GET['gambar'])){
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
				$id = $_POST['id'];
				$data[] = $_FILES['foto']['name'];
				$data[] = $id;
				$sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
				$row = $config -> prepare($sql);
				$row -> execute($data);
				echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
			}
		}
	}

	if(!empty($_GET['profil'])){
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$tlp = htmlentities($_POST['tlp']);
		$email = htmlentities($_POST['email']);
		$nik = htmlentities($_POST['nik']);
		
		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $tlp;
		$data[] = $email;
		$data[] = $nik;
		$data[] = $id;
		$sql = 'UPDATE member SET nm_member=?,alamat_member=?,telepon=?,email=?,NIK=? WHERE id_member=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
	}
	if(!empty($_GET['pass'])){
		$id = htmlentities($_POST['id']);
		$user = htmlentities($_POST['user']);
		$pass = htmlentities($_POST['pass']);
		
		$data[] = $user;
		$data[] = $pass;
		$data[] = $id;
		$sql = 'UPDATE login SET user=?,pass=md5(?) WHERE id_member=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
	}

	if(!empty($_GET['jual'])){
		$id = htmlentities($_POST['id']);
		$id_barang = htmlentities($_POST['id_barang']);
		$jumlah = htmlentities($_POST['jumlah']);
		
		$sql_tampil = "select * from barang where barang.id_barang=?";
		$row_tampil = $config -> prepare($sql_tampil);
		$row_tampil -> execute(array($id_barang));
		$hasil = $row_tampil -> fetch();

		if($hasil['stok'] > $jumlah)
		{
			$jual = $hasil['harga_jual'];
			$total = $jual * $jumlah;
			$data1[] = $jumlah;
			$data1[] = $total;
			$data1[] = $id;
			$sql1 = 'UPDATE penjualan SET jumlah=?,total=? WHERE id_penjualan=?';
			$row1 = $config -> prepare($sql1);
			$row1 -> execute($data1);
			echo '<script>window.location="../../index.php?page=jual#keranjang"</script>';
		}else{
			echo '<script>alert("Keranjang Melebihi Stok Barang Anda !");
					window.location="../../index.php?page=jual#keranjang"</script>';
		}
		
	}

	if(!empty($_GET['cari_barang'])){
		$cari = trim(strip_tags($_POST['keyword']));
		if($cari == ''){

		}else{
			$id = $_SESSION['admin']['id_cabang'];
			$sql = "SELECT barang.*, barang_name.nama_barang, barang_name.harga_jual, kategori.nama_kategori 
			FROM barang INNER JOIN barang_name ON barang.id_barang = barang_name.id_barang 
			INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori
			where barang.id_barang like '%$cari%' or barang_name.nama_barang like '%$cari%' and barang_name.id_cabang = '$id'";
			$row = $config -> prepare($sql);
			$row -> execute();
			$hasil1= $row -> fetchAll();
		
	?>
		<table class="table table-stripped" width="100%" id="example2">
			<tr>
				<th>ID Barang</th>
				<th>Nama Barang</th>
				<!-- <th>Merk</th> -->
				<th>Harga Jual</th>
				<th>Aksi</th>
			</tr>
		<?php foreach($hasil1 as $hasil){?>
			<tr>
				<td><?php echo $hasil['id_barang'];?></td>
				<td><?php echo $hasil['nama_barang'];?></td>
				<!-- <td><?php echo $hasil['merk'];?></td> -->
				<td>Rp.<?php echo number_format($hasil['harga_jual']);?></td>
				<td>
				<a href="fungsi/tambah/tambah.php?jual=jual&id=<?php echo $hasil['id_barang'];?>&id_kasir=<?php echo $_SESSION['admin']['id_member'];?>&id_cabang=<?php echo $_SESSION['admin']['id_cabang'] ?>" 
					class="btn btn-success">
					<i class="fas fa-cart-plus" style="color: white;"></i></a></td>
			</tr>
		<?php }?>
		</table>
		<?php  
		}
	}

	if (!empty($_GET['cabang'])) {
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$tgl = htmlentities($_POST['tgl']);

		$data3[] = $nama;
		$data3[] = $alamat;
		$data3[] = $tgl;
		$data3[] = $id;
		$sql3 = 'UPDATE cabang SET nama_cabang=?, alamat=?, tgl_update=? WHERE id_cabang=?';
		$row3 = $config -> prepare($sql3);
		$row3 -> execute($data3);
		echo "<script>window.location='../../index.php?page=cabang&edit=edit-data'</script>";
	}
	
}elseif (!empty($_SESSION['kasir'])) {
	require '../../config.php';

	if (!empty($_GET['gambar'])) {
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
		}else {
			$target_path = '../../assets/img/user/';
			$target_path = $target_path . basename($_FILES['foto']['name']);
			if (file_exists("$target_path")) {
				echo "<font face = 'Verdana' size = '2'>Ini Terjadi Karena Telah Masuk Nama File Yang Sama,<br> Silahkan Rename File terlebih dahulu<br>";

				echo "<font face='Verdana' size='2' ><BR><BR><BR>
						<a href='../../index.php?page=user'>Back to upform</a><BR>";
			}elseif (move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)) {
				$foto2 = $_POST['foto2'];
				unlink('../../assets/img/user/'.$foto2.'');
				$id = $_POST['id'];
				$data[] = $_FILES['foto']['name'];
				$data[] = $id;
				$sql = 'UPDATE member SET gambar =? WHERE member.id_member =? ';
				$row = $config -> prepare($sql);
				$row -> execute($data);
				echo "<script>window.location='../../index.php?page=user&success=edit-data'</script>";
			}
		}
	}
	if (!empty($_GET['profil'])) {
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$tlp = htmlentities($_POST['tlp']);
		$email = htmlentities($_POST['email']);
		$nik = htmlentities($_POST['nik']);


		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $tlp;
		$data[] = $email;
		$data[] = $nik;
		$data[] = $id;
		$sql = 'UPDATE member SET nm_member =?,alamat_member=?,telepon=?,email=?,NIK=? WHERE id_member=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo "<script>window.location='../../index.php?page=user&success=edit-data'</script>";
	}
	if (!empty($_GET['pass'])) {
		$id = htmlentities($_POST['id']);
		$user = htmlentities($_POST['user']);
		$pass = htmlentities($_POST['pass']);

		$data[] = $user;
		$data[] = $pass;
		$data[] = $id;
		$sql = 'UPDATE login SET user=?, pass=md5(?) WHERE id_member=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo "<script>window.location='../../index.php?page=user&success=edit-data'</script>";
	}
	if(!empty($_GET['cari_barang'])){
		$cari = trim(strip_tags($_POST['keyword']));
		if($cari == ''){

		}else{
			$id = $_SESSION['kasir']['id_cabang'];
			$sql = "SELECT barang.*, barang_name.nama_barang, barang_name.harga_jual, kategori.nama_kategori 
			FROM barang INNER JOIN barang_name ON barang.id_barang = barang_name.id_barang 
			INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori
			where barang.id_barang like '%$cari%' or barang_name.nama_barang like '%$cari%' and barang_name.id_cabang = '$id' ";
			$row = $config -> prepare($sql);
			$row -> execute();
			$hasil1= $row -> fetchAll();
		
	 ?>
		<table class="table table-stripped" width="100%" id="example2">
			<tr>
				<th>ID Barang</th>
				<th>Nama Barang</th>
				<!-- <th>Merk</th> -->
				<th>Harga Jual</th>
				<th>Aksi</th>
			</tr>
		<?php foreach($hasil1 as $hasil){?>
			<tr>
				<td><?php echo $hasil['id_barang'];?></td>
				<td><?php echo $hasil['nama_barang'];?></td>
				<!-- <td><?php echo $hasil['merk'];?></td> -->
				<td>Rp.<?php echo number_format($hasil['harga_jual']);?></td>
				<td>
				<a href="fungsi/tambah/tambah.php?jual=jual&id=<?php echo $hasil['id_barang'];?>&id_kasir=<?php echo $_SESSION['kasir']['id_member'];?>&id_cabang=<?php echo $_SESSION['kasir']['id_cabang'] ?>" 
					class="btn btn-success">
					<i class="fas fa-cart-plus" style="color: white;"></i></a></td>
			</tr>
		<?php }?>
		</table>
		<?php  
		}
	}
	if(!empty($_GET['jual'])){
		$id = htmlentities($_POST['id']);
		$id_barang = htmlentities($_POST['id_barang']);
		$jumlah = htmlentities($_POST['jumlahtotal']);

		// $data[] = $id_barang;
		// $sql_tampil = "SELECT barang_name.*, barang.stok FROM barang_name INNER JOIN barang ON barang_name.id_barang = barang.id_barang WHERE barang_name.id_barang = ?";
		// $row_tampil = $config -> prepare($sql_tampil);
		// $row_tampil -> execute(array($id_barang));
		// $hasil = $row_tampil -> fetch();

		require "konfig.php";
		$q = mysqli_query($koneksi, "SELECT barang_name.harga_jual, barang.stok FROM barang_name INNER JOIN barang ON barang_name.id_barang = barang.id_barang WHERE barang_name.id_barang = '$id_barang'");
		$hasil = mysqli_fetch_array($q);
		if ($hasil['stok'] > $jumlah) {
			$total = $hasil['harga_jual'] * $jumlah;
			 
			$data1[] = $jumlah;
			$data1[] = $total;
			$data1[] = $id;
			$sql1 = "UPDATE penjualan SET jumlah=?, total=? WHERE id_penjualan=?";
			$row1 = $config -> prepare($sql1);
			$row1 -> execute($data1);
			echo "<script>window.location='../../index.php?page=jual#keranjang'</script>";
		}else {
			echo "<script>alert('Keranjang Melebihi Stok Barang Anda!');
			window.location='../../index.php?page=jual#keranjang'</script>";
		}
	}
	if(!empty($_GET['input_barang'])){
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$kategori = htmlentities($_POST['kategori']);
		// $beli = htmlentities($_POST['beli']);
		$jual = htmlentities($_POST['jual']);
		$tgl = htmlentities($_POST['tgl']);
		
		$data[] = $nama;
		$data[] = $kategori;
		// $data[] = $beli;
		$data[] = $jual;
		$data[] = $tgl;
		$data[] = $id;
		$sql = 'UPDATE barang_name SET nama_barang=?, id_kategori=?,
				harga_jual=?, tgl_update=?  WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=input_barang&edit=edit-data"</script>';
	}
	if(!empty($_GET['barang'])){
		$id = htmlentities($_POST['id']);
		// $kategori = htmlentities($_POST['kategori']);
		// $nama = htmlentities($_POST['nama']);
		// $merk = htmlentities($_POST['merk']);
		// $beli = htmlentities($_POST['beli']);
		// $jual = htmlentities($_POST['jual']);
		$satuan = htmlentities($_POST['satuan']);
		$stok = htmlentities($_POST['stok']);
		$tgl = htmlentities($_POST['tgl']);
		
		// $data[] = $kategori;
		// $data[] = $nama;
		// $data[] = $merk;
		// $data[] = $beli;
		// $data[] = $jual;
		$data[] = $satuan;
		$data[] = $stok;
		$data[] = $tgl;
		$data[] = $id;
		$sql = 'UPDATE barang SET satuan_barang=?, stok=?, tgl_update=?  WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang&success=edit-data"</script>';
	}
	if(!empty($_GET['stok'])){
		$restok = htmlentities($_POST['restok']);
		$id = htmlentities($_POST['id']);
		$dataS[] = $id;
		$sqlS = 'select*from barang WHERE id_barang=?';
		$rowS = $config -> prepare($sqlS);
		$rowS -> execute($dataS);
		$hasil = $rowS -> fetch();
		$stok = $restok + $hasil['stok'];
		
		$data[] = $stok;
		$data[] = $id;
		$sql = 'UPDATE barang SET stok=? WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang&success-stok=stok-data"</script>';
	}


}elseif (!empty($_SESSION['superuser'])) {
	require '../../config.php';
	if(!empty($_GET['pengaturan'])){
		// $nama= htmlentities($_POST['namatoko']);
		// $alamat = htmlentities($_POST['alamat']);
		$alamat = htmlentities($_POST['alamat']);
		// $pemilik = htmlentities($_POST['pemilik']);
		$id = '1';
		
		// $data[] = $nama;
		// $data[] = $alamat;
		$data[] = $alamat;
		// $data[] = $pemilik;
		$data[] = $id;
		$sql = 'UPDATE cabang SET alamat=? WHERE id_cabang = ?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=pengaturan&success=edit-data"</script>';
	}

	if(!empty($_GET['kategori'])){
		$nama= htmlentities($_POST['nama']);
		$id= htmlentities($_POST['id']);
		$tgl = htmlentities($_POST['tgl']);

		$data[] = $nama;
		$data[] = $tgl;
		$data[] = $id;
		$sql = 'UPDATE kategori SET  nama_kategori=?,tgl_update=? WHERE id_kategori=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=kategori&uid='.$id.'&success-edit=edit-data"</script>';
	}

	if(!empty($_GET['stok'])){
		$restok = htmlentities($_POST['restok']);
		$id = htmlentities($_POST['id']);
		$dataS[] = $id;
		$sqlS = 'select*from barang WHERE id_barang=?';
		$rowS = $config -> prepare($sqlS);
		$rowS -> execute($dataS);
		$hasil = $rowS -> fetch();
		$stok = $restok + $hasil['stok'];
		
		$data[] = $stok;
		$data[] = $id;
		$sql = 'UPDATE barang SET stok=? WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang&success-stok=stok-data"</script>';
	}
	if (!empty($_GET['invo'])) {
		$invoice = htmlentities($_POST['id']);
		$status = "Reject";
		
		$data[] = $status;
		$data[] = $invoice;
		$sql = "UPDATE transaksi SET status =? WHERE invoice =?";
	}
	if(!empty($_GET['barang'])){
		$id = htmlentities($_POST['id']);
		// $kategori = htmlentities($_POST['kategori']);
		// $nama = htmlentities($_POST['nama']);
		// $merk = htmlentities($_POST['merk']);
		// $beli = htmlentities($_POST['beli']);
		// $jual = htmlentities($_POST['jual']);
		$satuan = htmlentities($_POST['satuan']);
		$stok = htmlentities($_POST['stok']);
		$tgl = htmlentities($_POST['tgl']);
		
		// $data[] = $kategori;
		// $data[] = $nama;
		// $data[] = $merk;
		// $data[] = $beli;
		// $data[] = $jual;
		$data[] = $satuan;
		$data[] = $stok;
		$data[] = $tgl;
		$data[] = $id;
		$sql = 'UPDATE barang SET satuan_barang=?, stok=?, tgl_update=?  WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang&success=edit-data"</script>';
	}

	if(!empty($_GET['input_barang'])){
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$kategori = htmlentities($_POST['kategori']);
		$idkat = htmlentities($_POST['jenisbrg']);
		// $beli = htmlentities($_POST['beli']);
		$jual = htmlentities($_POST['jual']);
		// $dis = htmlentities($_POST['diskon']);
		$tgl = htmlentities($_POST['tgl']);
		
		$data[] = $nama;
		$data[] = $kategori;
		// $data[] = $beli;
		$data[] = $jual;
		// $data[] = $dis;
		$data[] = $tgl;
		$data[] = $idkat;
		$data[] = $id;
		$sql = 'UPDATE barang_name SET nama_barang=?, id_kategori=?,
				harga_jual=?, tgl_update=?, id_kat=?  WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=input_barang&edit=edit-data"</script>';
	}

	if(!empty($_GET['gambar'])){
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
				$id = $_POST['id'];
				$data[] = $_FILES['foto']['name'];
				$data[] = $id;
				$sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
				$row = $config -> prepare($sql);
				$row -> execute($data);
				echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
			}
		}
	}

	if(!empty($_GET['profil'])){
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$tlp = htmlentities($_POST['tlp']);
		$email = htmlentities($_POST['email']);
		$nik = htmlentities($_POST['nik']);
		
		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $tlp;
		$data[] = $email;
		$data[] = $nik;
		$data[] = $id;
		$sql = 'UPDATE member SET nm_member=?,alamat_member=?,telepon=?,email=?,NIK=? WHERE id_member=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
	}
	if(!empty($_GET['pass'])){
		$id = htmlentities($_POST['id']);
		$user = htmlentities($_POST['user']);
		$pass = htmlentities($_POST['pass']);
		
		$data[] = $user;
		$data[] = $pass;
		$data[] = $id;
		$sql = 'UPDATE login SET user=?,pass=md5(?) WHERE id_member=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
	}

	if(!empty($_GET['jual'])){
		$id = htmlentities($_POST['id']);
		$id_barang = htmlentities($_POST['id_barang']);
		$jumlah = htmlentities($_POST['jumlah']);
		
		$sql_tampil = "select * from barang where barang.id_barang=?";
		$row_tampil = $config -> prepare($sql_tampil);
		$row_tampil -> execute(array($id_barang));
		$hasil = $row_tampil -> fetch();

		if($hasil['stok'] > $jumlah)
		{
			$jual = $hasil['harga_jual'];
			$total = $jual * $jumlah;
			$data1[] = $jumlah;
			$data1[] = $total;
			$data1[] = $id;
			$sql1 = 'UPDATE penjualan SET jumlah=?,total=? WHERE id_penjualan=?';
			$row1 = $config -> prepare($sql1);
			$row1 -> execute($data1);
			echo '<script>window.location="../../index.php?page=jual#keranjang"</script>';
		}else{
			echo '<script>alert("Keranjang Melebihi Stok Barang Anda !");
					window.location="../../index.php?page=jual#keranjang"</script>';
		}
		
	}

	if(!empty($_GET['cari_barang'])){
		$cari = trim(strip_tags($_POST['keyword']));
		if($cari == ''){

		}else{
			$id = $_SESSION['superuser']['id_cabang'];
			$sql = "SELECT barang.*, barang_name.nama_barang, barang_name.harga_jual, kategori.nama_kategori 
			FROM barang INNER JOIN barang_name ON barang.id_barang = barang_name.id_barang 
			INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori
			where barang.id_barang like '%$cari%' or barang_name.nama_barang like '%$cari%' and barang_name.id_cabang = '$id'";
			$row = $config -> prepare($sql);
			$row -> execute();
			$hasil1= $row -> fetchAll();
		
	?>
		<table class="table table-stripped" width="100%" id="example2">
			<tr>
				<th>ID Barang</th>
				<th>Nama Barang</th>
				<!-- <th>Merk</th> -->
				<th>Harga Jual</th>
				<th>Aksi</th>
			</tr>
		<?php foreach($hasil1 as $hasil){?>
			<tr>
				<td><?php echo $hasil['id_barang'];?></td>
				<td><?php echo $hasil['nama_barang'];?></td>
				<!-- <td><?php echo $hasil['merk'];?></td> -->
				<td>Rp.<?php echo number_format($hasil['harga_jual']);?></td>
				<td>
				<a href="fungsi/tambah/tambah.php?jual=jual&id=<?php echo $hasil['id_barang'];?>&id_kasir=<?php echo $_SESSION['superuser']['id_member'];?>&id_cabang=<?php echo $_SESSION['superuser']['id_cabang'] ?>" 
					class="btn btn-success">
					<i class="fas fa-cart-plus" style="color: white;"></i></a></td>
			</tr>
		<?php }?>
		</table>
		<?php  
		}
	}

	if (!empty($_GET['cabang'])) {
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$tgl = htmlentities($_POST['tgl']);

		$data3[] = $nama;
		$data3[] = $alamat;
		$data3[] = $tgl;
		$data3[] = $id;
		$sql3 = 'UPDATE cabang SET nama_cabang=?, alamat=?, tgl_update=? WHERE id_cabang=?';
		$row3 = $config -> prepare($sql3);
		$row3 -> execute($data3);
		echo "<script>window.location='../../index.php?page=cabang&edit=edit-data'</script>";
	}
	
}
