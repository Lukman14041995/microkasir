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
						ORDER BY id_barang DESC";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function barang_edit($id){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori
						where id_barang=?";
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
				$sql = 'SELECT * FROM barang ORDER BY id_barang DESC';
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

			function pengeluaran_id(){
				$konek = mysqli_connect("localhost","root","","db_toko");
				$num = "";
				$perfik = "PEN";
				$query = "SELECT MAX(no_pengeluaran) as kode FROM pengeluaran";
				$run = mysqli_query($konek, $query);
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
				$konek = mysqli_connect("localhost","root","","db_toko");
				$num = "";
				$perfik = "RTQ";
				// $date = date("Ymd");
				$query = "SELECT MAX(invoice) as kode FROM nota";
				$run = mysqli_query($konek, $query);
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
				$sql = "SELECT nota.*, barang.id_barang, barang.nama_barang, member.nm_member, transaksi.totalsemua, 
						transaksi.bayar, transaksi.kembali, transaksi.diskon from nota
						inner join barang on nota.id_barang = barang.id_barang
						inner join member on nota.id_member = member.id_member
						inner join transaksi on nota.invoice = transaksi.invoice
						ORDER BY id_nota DESC";
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
				$sql ="SELECT penjualan.* , barang.id_barang, barang.nama_barang, barang.id_barang, barang.harga_jual, member.id_member,
						member.nm_member from penjualan 
					   left join barang on barang.id_barang=penjualan.id_barang 
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
				$sql ="SELECT SUM(total) as bayar FROM nota";
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
				$sql = "SELECT * FROM member";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
	 }
