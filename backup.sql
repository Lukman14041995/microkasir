DROP TABLE barang;

CREATE TABLE `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `merk` varchar(255) NOT NULL,
  `harga_beli` varchar(255) NOT NULL,
  `harga_jual` varchar(255) NOT NULL,
  `satuan_barang` varchar(255) NOT NULL,
  `stok` text NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `tgl_update` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO barang VALUES("1","BR001","1","Pensil","Fabel Castel","1500","3000","PCS","91","6 October 2020, 0:41","");
INSERT INTO barang VALUES("2","BR002","5","Sabun","Lifeboy","1800","3000","PCS","8","6 October 2020, 0:41","6 October 2020, 0:54");
INSERT INTO barang VALUES("3","BR003","1","Pulpen","Standard","1500","2000","PCS","61","6 October 2020, 1:34","");



DROP TABLE kategori;

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO kategori VALUES("1","ATK","7 May 2017, 10:23");
INSERT INTO kategori VALUES("5","Sabun","7 May 2017, 10:28");
INSERT INTO kategori VALUES("6","Snack","6 October 2020, 0:19");
INSERT INTO kategori VALUES("7","Minuman","6 October 2020, 0:20");



DROP TABLE login;

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `id_member` int(11) NOT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO login VALUES("1","admin","202cb962ac59075b964b07152d234b70","1");



DROP TABLE member;

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `nm_member` varchar(255) NOT NULL,
  `alamat_member` text NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `NIK` text NOT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO member VALUES("1","Fauzan Falah","uj harapan","089618173609","fauzanfalah21@gmail.com","mata.png","12314121");



DROP TABLE nota;

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) NOT NULL,
  `id_member` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL,
  `periode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_nota`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO nota VALUES("1","BR002","1","RTQ00001","5","15000","9 March 2021, 11:10","2021-03-09");



DROP TABLE pengeluaran;

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_pengeluaran` varchar(200) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `guna` text NOT NULL,
  `barang` varchar(100) NOT NULL,
  `nominal` varchar(100) NOT NULL,
  `oleh` varchar(100) NOT NULL,
  `tanggal_input` text NOT NULL,
  `periode` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori` (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO pengeluaran VALUES("1","PEN00001","5","Untuk Cuci Piring","Sunlike","10000","Zaky","8 March 2021, 14:41","2021-03-08");
INSERT INTO pengeluaran VALUES("2","PEN00001","7","Untuk Minum","AQUA","10000","Zaky","8 March 2021, 15:04","2021-03-08");
INSERT INTO pengeluaran VALUES("3","PEN00002","5","untuk mandi","Giv","10000","Zaky","8 March 2021, 15:58","2021-03-08");
INSERT INTO pengeluaran VALUES("4","PEN00003","6","Untuk cemilan","Kripik","10000","Zaky","9 March 2021, 9:27","2021-03-09");



DROP TABLE penjualan;

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) NOT NULL,
  `id_member` int(11) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;




DROP TABLE toko;

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(255) NOT NULL,
  `alamat_toko` text NOT NULL,
  `tlp` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO toko VALUES("1","RotiQu","Jl. Raya Barat Lebaksiu - Slawi (Sebelah Barat Pasar Lebaksiu)","089618173609","Fauzan Falah");



DROP TABLE transaksi;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(255) NOT NULL,
  `diskon` varchar(255) NOT NULL,
  `totalsemua` varchar(255) NOT NULL,
  `bayar` varchar(100) NOT NULL,
  `kembali` varchar(100) NOT NULL,
  `periode` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice` (`invoice`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO transaksi VALUES("1","RTQ00001","50","7500","10000","2500","2021-03-09");



