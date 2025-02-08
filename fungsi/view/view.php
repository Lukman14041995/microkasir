<?php
	/*
	 * PROSES TAMPIL  
	 */ 
	 class view {
		protected $db;
		function __construct($db){
			$this->db = $db;
		}

			function member(){
				$sql = "select member.*, login.*
						from member inner join login on member.id_member = login.id_member";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				// dd($sql);
				return $hasil;
			}

			function member_edit($id){
				$sql = "select member.*, login.*
						from member inner join login on member.id_member = login.id_member
						where member.id_member= ?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}
			
			function toko(){
				$sql = "select*from toko where id_toko='1'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function kategori(){
				$sql = "select*from kategori";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function barang(){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori 
						ORDER BY id_barang asc";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function barang_edit($id){
				$sql = "SELECT barang.*, barang_name.nama_barang, barang_name.harga_jual, kategori.nama_kategori FROM barang INNER JOIN barang_name ON barang.id_barang = barang_name.id_barang INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori
						where id_barang=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function input_barang_edit($id){
				$sql = "SELECT barang_name.*,kategori.nama_kategori
						from barang_name inner join kategori on barang_name.id_kategori = kategori.id_kategori
						where barang_name.id_barang=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function barang_cari($cari){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori
						where id_barang like '%$cari%' or nama_barang like '%$cari%' or merk like '%$cari%'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function barang_id(){
				$sql = 'SELECT * FROM barang_name ORDER BY id_barang DESC';
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				
				$urut = substr($hasil['id_barang'], 2, 3);
				$tambah = (int) $urut + 1;
				if(strlen($tambah) == 1){
					 $format = 'BR00'.$tambah.'';
				}else if(strlen($tambah) == 2){
					 $format = 'BR0'.$tambah.'';
				}else{
					 $format = 'BR'.$tambah.'';
				}
				return $format;
			}		

			function jual_id(){
				$sql = 'SELECT * FROM penjualan ORDER BY id_jual DESC';
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				$urut = substr($hasil['id_jual'], 2, 3);
				$tambah = (int) $urut + 1;
				if(strlen($tambah) == 1){
					 $format = 'BR00'.$tambah.'';
				}else if(strlen($tambah) == 2){
					 $format = 'BR0'.$tambah.'';
				}else{
					 $format = 'BR'.$tambah.'';
				}
				return $format;
			}

			function order_id(){
				require "konfig.php";
				$num = "";
				$perfik = "ORD";
				$query = "SELECT MAX(id_order) as kode FROM orderan";
				$run = mysqli_query($koneksi, $query);
				$data = mysqli_fetch_array($run);
				$row = mysqli_num_rows($run);
				$num = $data["kode"];
				$number = (int)substr($num, 4,5);
				$number++;

				if ($row > 0) {
					$value = $perfik.sprintf("%05s", $number);
				}else{
				}
				return $value;
			}

			function paket_id(){
				require "konfig.php";
				$num = "";
				$perfik = "PKT";
				$query = "SELECT MAX(id_barang) as kode FROM paket";
				$run = mysqli_query($koneksi, $query);
				$data = mysqli_fetch_array($run);
				$row = mysqli_num_rows($run);
				$num = $data["kode"];
				$number = (int)substr($num, 4,5);
				$number++;

				if ($row > 0) {
					$value = $perfik.sprintf("%05s", $number);
				}else{
				}
				return $value;	
			}

			function pengeluaran_id(){
				require "konfig.php";
				$num = "";
				$cabang = $_SESSION['admin']['id_cabang']||$_SESSION['superuser']['id_cabang'];
				$perfik = "PEN";
				$query = "SELECT MAX(no_pengeluaran) as kode FROM pengeluaran";
				$run = mysqli_query($koneksi, $query);
				$data = mysqli_fetch_array($run);
				$row = mysqli_num_rows($run);
				$num = $data["kode"];
				$number = (int)substr($num, 4,5);
				$number++;

				if ($row > 0) {
					$value = $perfik.sprintf("%05s", $number);
				}else{
				}
				return $value;	
			}

			function invoice_id(){
				require "konfig.php";
				$num = "";
				// $date = date("ymd");
				// $cabang = $_SESSION['admin']['id_cabang'] || $_SESSION['kasir']['id_ca']
				$cabang = $_SESSION['kasir']['id_cabang'];	
				$perfik = "NSN";
				$query = "SELECT MAX(invoice) as kode FROM nota";
				$run = mysqli_query($koneksi, $query);
				$data = mysqli_fetch_array($run);
				$row = mysqli_num_rows($run);
				$num = $data["kode"];
				$number = (int)substr($num, 4,6);
				
				if ($row > 0) {
					$number++;
					$value = $perfik.sprintf("%06s", $number);
				}else{
				}
				return $value;	
			}


			function kategori_edit($id){
				$sql = "select*from kategori where id_kategori=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function kategori_row(){
				$sql = "select*from kategori";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function barang_row(){
				$sql = "select*from barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function barang_stok_row(){
				$sql ="SELECT SUM(stok) as jml FROM barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function barang_beli_row(){
				$sql ="SELECT SUM(harga_beli) as beli FROM barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jual_row(){
				$sql ="SELECT SUM(jumlah) as stok FROM nota";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function total_row(){
				$sql ="SELECT SUM total FROM nota";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jual(){
				$sql = "SELECT nota.invoice, SUM(nota.total) as total, GROUP_CONCAT(nota.jumlah) as jumlah, GROUP_CONCAT(barang.nama_barang) AS nama_barang, nota.tanggal_input, transaksi.diskon, transaksi.potongan, transaksi.totalsemua, transaksi.bayar, transaksi.kembali, member.nm_member FROM nota INNER JOIN transaksi ON nota.invoice = transaksi.invoice INNER JOIN barang ON nota.id_barang = barang.id_barang INNER JOIN member ON nota.id_member = member.id_member GROUP BY nota.invoice";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			
			function periode_jual($tanggal1 , $tanggal2){
				$sql ="SELECT nota.* , barang.id_barang, barang.nama_barang, member.id_member,
						member.nm_member, transaksi.totalsemua, transaksi.bayar, transaksi.kembali, transaksi.diskon from nota 
					   inner join barang on barang.id_barang=nota.id_barang 
					   inner join member on member.id_member=nota.id_member 
					   inner join transaksi on nota.invoice = transaksi.invoice 
					   WHERE nota.periode between '$tanggal1' and '$tanggal2'";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($tanggal1 , $tanggal2));
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function penjualan(){
				
				$sql ="SELECT penjualan.*, barang.id_barang, barang_name.nama_barang, barang_name.harga_jual, member.id_member,
						member.nm_member from penjualan 
					   left join barang on barang.id_barang=penjualan.id_barang
					   left join barang_name on barang_name.id_barang = barang.id_barang 
					   left join member on member.id_member=penjualan.id_member
					   ORDER BY id_penjualan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function jumlah(){
				$sql ="SELECT SUM(total) as bayar FROM penjualan";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jumlah_nota(){
				$sql ="SELECT SUM(totalsemua) as bayar FROM transaksi";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jml(){
				$sql ="SELECT SUM(harga_beli*stok) as byr FROM barang";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function pengeluaran(){
				$sql = "select pengeluaran.*, kategori.id_kategori, kategori.nama_kategori
						from pengeluaran inner join kategori on pengeluaran.id_kategori = kategori.id_kategori
						";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function pengeluaran_tgl($tanggal1 , $tanggal2){
				$sql = "select pengeluaran.*, kategori.id_kategori, kategori.nama_kategori
						from pengeluaran inner join kategori on pengeluaran.id_kategori = kategori.id_kategori where pengeluaran.periode BETWEEN '$tanggal1' and '$tanggal2' ";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($tanggal1, $tanggal2));
				$hasil = $row -> fetchAll();
				return $hasil;
				echo '<script>window.location="../../index.php?page=pengeluaran"</script>';
			}

			function jml_pengeluaran(){
				$sql ="SELECT SUM(nominal) as pay FROM pengeluaran";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;	
			}

			function user(){
				$id = $_SESSION['admin']['id_cabang'];
				require "konfig.php";
				$sql = mysqli_query($koneksi, "SELECT member.*, login.role, cabang.id_cabang, cabang.nama_cabang FROM member 
				INNER JOIN login ON member.id_member = login.id_member
				INNER JOIN cabang ON login.id_cabang = cabang.id_cabang WHERE login.id_cabang = '$id' ");
				return $sql;
				// $hasil = mysqli_fetch_array($sql);
				// return $hasil;
				// $sql = "SELECT member.*, login.role, cabang.id_cabang, cabang.nama_cabang FROM member 
				// 		INNER JOIN login ON member.id_member = login.id_member
				// 		INNER JOIN cabang ON login.id_cabang = cabang.id_cabang WHERE login.id_cabang =?";
				// $row = $this-> db -> prepare($sql);
				// $row -> execute(array($id));
				// $hasil = $row -> fetchAll();
				// return $hasil;
				
			}

			function barang_stok(){
				$sql = "SELECT stok FROM barang ORDER BY id_barang asc";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function barang_nama(){
				$sql = "SELECT nama_barang FROM barang ORDER BY id_barang asc";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function pengeluaran_nominal(){
				$sql = "SELECT periode, SUM(nominal) AS nominal FROM pengeluaran GROUP BY periode ORDER BY id ASC";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function pengeluaran_tanggal(){
				$sql = "SELECT tanggal_input FROM pengeluaran ORDER BY id asc";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function transaksi_totsemua(){
				$sql = "SELECT bulan, SUM(totalsemua) AS totalsemua FROM transaksi GROUP BY bulan ORDER BY id asc";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function expired(){
				$sql = "SELECT * FROM barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function cabang(){
				$sql = "SELECT * FROM cabang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function cabang_edit($id){
				$sql = "SELECT * FROM cabang WHERE id_cabang=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}
	 }
