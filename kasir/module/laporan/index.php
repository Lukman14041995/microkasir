 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Data Laporan Penjualan
							<!--<a  style="padding-left:2pc;" href="fungsi/hapus/hapus.php?laporan=jual" onclick="javascript:return confirm('Data Laporan akan di Hapus ?');">
								<button class="btn btn-danger">RESET</button>
							</a>-->
							<?php if(!empty($_GET['cari'])){
								echo 'Dari Tanggal '.$_POST['datefrom'].' sampai Tanggal '.$_POST['dateto'];
							}
							?>
						</h3>
						<br/>
						<h4>Cari Laporan Per Tanggal</h4>
						<form method="post" action="index.php?page=laporan&cari=ok">
							<table class="table table-striped">
							<tr>
									<th>
										Dari Tanggal
									</th>
									<th>
										Sampai Tanggal
									</th>
									<th>
										Aksi
									</th>
								</tr>
								<tr>
								<td>
								<input type="date" name="datefrom" class="form-control" id="">
								</td>
								<td>
								<input type="date" name="dateto" class="form-control" id="">
								</td>
								<td>
									<input type="hidden" name="periode" value="ya">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Cari
									</button>
									<a href="index.php?page=laporan" class="btn btn-success">
										<i class="fa fa-refresh"></i> Refresh</a>
								</td>
								</tr>
							</table>
						</form>
						<?php $id = $_SESSION['kasir']['id_cabang']; ?>
						<a href="exceljual.php?id=<?php echo $id ?>" style="margin-top: 10px;" class="btn btn-success btn-md pull-left">
							<i class="fa fa-print"></i> Export Excel</a>
						<div class="clearfix" style="border-top:1px solid #ccc;"></div>
						<br/>
						<br/>
						<?php if(!empty($_GET['cari'])){?>
						<!-- view barang -->	
						<div class="modal-view">
							<table class="table table-bordered" id="example1">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
									<th> No</th>
										<th> No. Invoice </th>
										<th> Nama Barang</th>
										<th> Jumlah</th>
										<th> Total</th>
										<th> Diskon</th>
										<th> Total Semua</th>
										<th> Bayar</th>
										<th> Kembali</th>
										<th> Kasir</th>
										<th> Tanggal Input</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$tanggal1 = $_POST['datefrom'];
										$tanggal2 = $_POST['dateto'];
										$no=1; 
										$jumlah = 0;
										$bayar = 0;
										// $hasil = $lihat -> periode_jual($tanggal1 ,$tanggal2);
										// foreach($hasil as $isi){
										require "konfig.php";
										$id = $_SESSION['kasir']['id_cabang'];
										$query = mysqli_query($koneksi, 
										"SELECT nota.invoice, SUM(nota.total) as total,
										GROUP_CONCAT(nota.jumlah) as jumlah, GROUP_CONCAT(barang.nama_barang) AS nama_barang,
										nota.tanggal_input, transaksi.diskon, transaksi.potongan, transaksi.totalsemua,
										transaksi.bayar, transaksi.kembali, transaksi.id_cabang, member.nm_member
										FROM nota INNER JOIN transaksi ON nota.invoice = transaksi.invoice 
										INNER JOIN barang ON nota.id_barang = barang.id_barang 
										INNER JOIN member ON nota.id_member = member.id_member
										WHERE transaksi.id_cabang = '$id' and nota.periode between '$tanggal1' and '$tanggal2' 
										GROUP BY nota.invoice");	
										while ($isi = mysqli_fetch_array($query)) {
											$bayar += $isi['total'];
											$jumlah += $isi['jumlah'];
											$totalsemua += $isi['totalsemua'];
									?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $isi['invoice'];?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo $isi['jumlah'];?> </td>
										<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
										<td><?php echo $isi['diskon'] ?>%</td>
										<td>Rp.<?php echo number_format($isi['totalsemua'])?>,-</td>
										<td>Rp.<?php echo number_format($isi['bayar']) ?></td>
										<td>Rp.<?php echo number_format($isi['kembali']) ?></td>
										<td><?php echo $isi['nm_member'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
									</tr>
									<?php $no++; }?>
									<?php $hasil = $lihat -> jumlah_nota(); ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4">Total Terjual</td>
										<th><?php echo $jumlah;?></td>
										<th>Rp.<?php echo number_format($bayar);?>,-</td>
										<th colspan="2" style="background:#ddd"></th>
									</tr>
								</tfoot>
							</table>
						</div>
						<?php }else{?>
						<!-- view barang -->	
						<div class="modal-view">
							<table class="table table-bordered" id="example1">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th> No</th>
										<th> No. Invoice </th>
										<th> Nama Barang</th>
										<th> Jumlah</th>
										<th> Total</th>
										<th> Diskon</th>
										<th> Potongan</th>
										<th> Total Semua</th>
										<th> Bayar</th>
										<th> Kembali</th>
										<th> Kasir</th>
										<th> Tanggal Input</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; $hasil = $lihat -> jual();?>
									<?php 
										$bayar = 0;
										$jumlah = 0;
									$id = $_SESSION['kasir']['id_cabang'];
									require "konfig.php";
									$query = mysqli_query($koneksi, 
									"SELECT nota.invoice, SUM(nota.total) as total,
									 GROUP_CONCAT(nota.jumlah) as jumlah, GROUP_CONCAT(barang.nama_barang) AS nama_barang,
									 nota.tanggal_input, transaksi.diskon, transaksi.potongan, transaksi.totalsemua,
									 transaksi.bayar, transaksi.kembali, transaksi.id_cabang, member.nm_member
									 FROM nota INNER JOIN transaksi ON nota.invoice = transaksi.invoice 
									 INNER JOIN barang ON nota.id_barang = barang.id_barang 
									 INNER JOIN member ON nota.id_member = member.id_member
									 WHERE transaksi.id_cabang = '$id' 
									 GROUP BY nota.invoice");
									while ($isi = mysqli_fetch_array($query)) {
											$bayar += $isi['total'];
											$jumlah += $isi['jumlah'];
											$totalsemua += $isi['totalsemua'];
									?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $isi['invoice'];?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo $isi['jumlah'];?> </td>
										<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
										<td><?php echo $isi['diskon']."%" ?></td>
										<td>Rp.<?php echo number_format($isi['potongan']);?>,-</td>
										<td>Rp.<?php echo number_format($isi['totalsemua']); ?>,-</td>
										<td>Rp.<?php echo number_format($isi['bayar']); ?>,-</td>
										<td>Rp.<?php echo number_format($isi['kembali']) ?>,-</td>
										<td><?php echo $isi['nm_member'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
									</tr>
									<?php $no++; }?>
									<?php $hasil = $lihat -> jumlah_nota(); ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4">Total Terjual</td>
										<th>Rp.<?php echo number_format($bayar);?>,-</td>
										<th colspan="2" style="background:#ddd"></th>
										<th>Rp.<?php echo number_format($totalsemua);?>,-</td>
										<th colspan="5" style="background:#ddd"></th>
									</tr>
								</tfoot>
							</table>
						</div>
						<?php } ?>
							<div class="clearfix" style="padding-top:5pc;"></div>
					</div>
				  </div>
              </div>
          </section>
      </section>
	

