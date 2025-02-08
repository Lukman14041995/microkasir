 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
	  <?php 
	require "konfig.php";
	$id = $_SESSION['admin']['id_cabang'];
	$query_pengeluaran = mysqli_query($koneksi, "SELECT SUM(nominal) as nominal FROM pengeluaran WHERE id_cabang = '$id'");
	$pengeluaran = mysqli_fetch_assoc($query_pengeluaran); 
	?>
      <!-- <section id="main-content">
          <section class="wrapper"> -->
              <div class="card">
				  <div class="card-body">
				  <div class="row">
                  <div class="col-lg-12 main-chart">

						<h5>Data Laporan Penjualan
							<!--<a  style="padding-left:2pc;" href="fungsi/hapus/hapus.php?laporan=jual" onclick="javascript:return confirm('Data Laporan akan di Hapus ?');">
								<button class="btn btn-danger">RESET</button>
							</a>-->
						</h5>
						
						<?php if(!empty($_GET['cari']))
						{
						?>
						<div class="alert alert-success" role="alert">
						Dari Tanggal <?php echo $_POST['datefrom'] ?> Sampai Tanggal <?php echo $_POST['dateto'] ?>
						</div>
						<?php } ?>
						<br/>
						<h5>Cari Laporan Per Tanggal</h5>
						<form method="post" action="index.php?page=laporan&cari=ok">
							<div class="row">
								<div class="col-md-4">
									Dari Tanggal
									<input type="date" name="datefrom" class="form-control" id="">
								</div>
								<div class="col-md-4">
									Sampai Tanggal
									<input type="date" name="dateto" class="form-control" id="">
								</div>
								<div class="col-md-4" style="margin-top: 20px;">
									<input type="hidden" name="periode" value="ya">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Filter
									</button>
									<a href="index.php?page=laporan" class="btn btn-success" style="color: white;">
										<i class="fa fa-refresh" ></i> Refresh</a>
								</div>
							</div>

								
						</form>
						<?php $id = $_SESSION['admin']['id_cabang']; ?>
						<!-- <a href="exceljual.php?id=<?php echo $id ?>" style="margin-top: 10px;" class="btn btn-success btn-md pull-left">
							<i class="fa fa-print"></i> Export Excel</a> -->
						<!-- <div class="clearfix" style="border-top:1px solid #ccc;"></div> -->
						<br/>
						<br/>
						<?php if(!empty($_GET['cari'])){?>
						<!-- view barang -->	
						<div class="table-responsive">
							<table class="table table-bordered" id="example1">
							<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th> No</th>
										<th> No. Invoice </th>
										<th> Nama Barang</th>
										<th> Jumlah</th>
										<!-- <th> Total</th> -->
										<th> Diskon</th>
										<!-- <th>Jenis</th> -->
										<!-- <th> Potongan</th> -->
										<th> Total Semua</th>
										<!-- <th> Bayar</th> -->
										<!-- <th> Kembali</th> -->
										<th> Kasir</th>
										<th> Tanggal Transaksi</th>
										<!-- <th>Status</th> -->
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
										$id = $_SESSION['admin']['id_cabang'];
										$query = mysqli_query($koneksi, 
										"SELECT nota.invoice, SUM(nota.total) as total,
										GROUP_CONCAT(nota.jumlah) as jumlah, GROUP_CONCAT(barang_name.nama_barang) AS nama_barang, barang_name.id_kat,
										nota.tanggal_input, transaksi.diskon,transaksi.status, transaksi.potongan, transaksi.totalsemua,
										transaksi.bayar, transaksi.kembali, transaksi.id_cabang, member.nm_member,kategori_brg.nama_kat
										FROM nota
										INNER JOIN transaksi ON nota.invoice = transaksi.invoice 
										INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang 
										INNER JOIN member ON nota.id_member = member.id_member
										INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
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
										<td><?php echo $isi['jumlah'];?></td>
										<!-- <td>Rp.<?php echo number_format($isi['toto']) ;?>,-</td> -->
										<td><?php 
											if ($isi['diskon'] > 0) {
												echo $isi['diskon']."%";
											}else{
												echo number_format($isi['potongan']);
											}
										 ?></td>
										 <!-- <td><?php echo $isi['nama_kat'] ?></td> -->
										<!-- <td>Rp.<?php echo number_format($isi['potongan']) ;?>,-</td> -->
										<td>Rp.<?php echo number_format($isi['totalsemua']) ; ?>,-</td>
										<!-- <td>Rp.<?php echo number_format($isi['bayar']) ; ?>,-</td> -->
										<!-- <td>Rp.<?php echo $isi['kembali'] ?>,-</td> -->
										<td><?php echo $isi['nm_member'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
										<!-- <td class="text-center"><?php echo $isi['status']?>  <a href="index.php?page=laporan/detail&barang=<?php echo $isi['invoice'];?>"><button class="btn btn-primary btn-xs" title="Details"><i class="mdi mdi-information-variant"></i></button></a></td> -->
										<!-- <td><button type="button" title="Reject" class="btn btn-danger" style="color: white;" data-toggle="modal" data-target="#exampleModal<?php echo $isi['invoice'];?>">
										<i class="mdi mdi-close"></i>
											</button><button type="button" title="Close" class="btn btn-dark" style="color: white;" data-toggle="modal" data-target="#close<?php echo $isi['invoice'];?>">
											<i class="mdi mdi-check"></i>
											</button> </td> -->
									</tr>
									<?php $no++; }?>
									<?php $hasil = $lihat -> jumlah_nota(); ?>
								</tbody>
								<tfoot>
									<?php 

									require "konfig.php";
									$id = $_SESSION['admin']['id_cabang'];
									$date = date('Y-m-d');

									$tanggal1 = $_POST['datefrom'];
									$tanggal2 = $_POST['dateto'];
									$query_pengeluaran = mysqli_query($koneksi, "SELECT SUM(nominal) as nominal FROM pengeluaran WHERE id_cabang = '$id' and periode between '$tanggal1' and '$tanggal2' ");
									$peng = mysqli_fetch_assoc($query_pengeluaran); 
									$transaksi = mysqli_query($koneksi, "SELECT SUM(totalsemua) as totalsemua FROM transaksi WHERE id_cabang = '$id' and periode between '$tanggal1' and '$tanggal2' ");
									$trans = mysqli_fetch_assoc($transaksi); 
									$totsem = $trans['totalsemua'];
									?>
									<tr>
										<td></td>
										<th colspan=""> </th>
										
										<th >Total Bersih</th>
										<?php $bersih = $totsem - $peng['nominal'] ?>
										<th>Rp.<?php echo number_format($bersih) ;?>,-</th>
										<th>Total</th>
										<th>Rp.<?php echo number_format($totsem) ;?>,-</td>
										<!-- <td></td> -->
										<th>Pengeluaran</th>
										<th  style="text-align: center;">Rp.<?php echo number_format($peng['nominal'] )?></th>
										
										<!-- <th colspan="5" style="background:#ddd"></th> -->
									</tr>
								</tfoot>
							</table>
						</div>
						<?php }else{?>
						<!-- view barang -->	
						<div class="table-responsive">
							<table class="table table-bordered" id="example">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th> No</th>
										<th> No. Invoice </th>
										<th> Nama Barang</th>
										<th> Jumlah</th>
										<!-- <th> Total</th> -->
										<th> Diskon</th>
										<!-- <th> Potongan</th> -->
										<!-- <th>Jenis</th> -->
										<th> Total Semua</th>
										<!-- <th> Bayar</th> -->
										<!-- <th> Kembali</th> -->
										<th> Kasir</th>
										<th> Tanggal Transaksi</th>
										<!-- <th>Status</th> -->
									</tr>
								</thead>
								<tbody>
									<?php $no=1; $hasil = $lihat -> jual();?>
									<?php 
										$bayar = 0;
										$jumlah = 0;
									$id = $_SESSION['admin']['id_cabang'];
									require "konfig.php";
									$date = date('Y-m-d');
									$query = mysqli_query($koneksi, 
									"SELECT nota.invoice, SUM(nota.total) as total,
									 GROUP_CONCAT(nota.jumlah) as jumlah, GROUP_CONCAT(barang_name.nama_barang) AS nama_barang, barang_name.id_kat,
									 nota.tanggal_input, transaksi.diskon, transaksi.potongan, transaksi.totalsemua,
									 transaksi.bayar, transaksi.kembali,transaksi.status,transaksi.id_cabang, member.nm_member,kategori_brg.nama_kat
									 FROM nota
									 INNER JOIN transaksi ON nota.invoice = transaksi.invoice 
									 INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang 
									 INNER JOIN member ON nota.id_member = member.id_member
									 INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
									 WHERE transaksi.id_cabang = '$id' and nota.periode like '%" . $date . "%'
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
										<td><?php echo $isi['jumlah'];?></td>
										<!-- <td>Rp.<?php echo number_format($isi['toto']) ;?>,-</td> -->
										<td><?php 
											if ($isi['diskon'] > 0) {
												echo $isi['diskon']."%";
											}else{
												echo number_format($isi['potongan']);
											}
										 ?></td>
										 <!-- <td><?php echo $isi['nama_kat'] ?></td> -->
										<!-- <td>Rp.<?php echo number_format($isi['potongan']) ;?>,-</td> -->
										<td>Rp.<?php echo number_format($isi['totalsemua']) ; ?>,-</td>
										<!-- <td>Rp.<?php echo number_format($isi['bayar']) ; ?>,-</td> -->
										<!-- <td>Rp.<?php echo $isi['kembali'] ?>,-</td> -->
										<td><?php echo $isi['nm_member'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
										<!-- <td class="text-center"><?php echo $isi['status']?> <button class="btn btn-primary btn-xs" title="Details" data-toggle="modal" data-target="#modal2<?php echo $isi['invoice']?>"><i class="mdi mdi-information-variant"></i></button></td> -->
										<!-- <td><button type="button" title="Reject" class="btn btn-danger" style="color: white;" data-toggle="modal" data-target="#exampleModal<?php echo $isi['invoice'];?>">
										<i class="mdi mdi-close"></i>
											</button><button type="button" title="Close" class="btn btn-dark" style="color: white;" data-toggle="modal" data-target="#close<?php echo $isi['invoice'];?>">
											<i class="mdi mdi-check"></i>
											</button> </td> -->
									</tr>

									<!-- modal2 -->
									<!-- Button trigger modal -->
									<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal2">
									Launch demo modal
									</button> -->

									<!-- Modal -->
									<div class="modal fade" id="modal2<?php echo $isi['invoice']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="" method="post">
												<div class="form-group">
												<input type="hidden" value="<?php echo $isi['invoice']?>" name="invoice">
												<label for="">Ganti Status</label>
												<select name="status" class="form-control" id="">
													<option value="open">Open</option>
													<option value="return">Return</option>
												</select>
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" name="save" class="btn btn-primary">Save </button>
											</form>
										</div>
										</div>
									</div>
									</div>
						<!-- Modal -->
							<div class="modal fade" id="exampleModal<?php echo $isi['invoice'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
							<form action="fungsi/edit/edit.php?invo=edit" method="POST">
								<input type="hidden" name="invoice" value="<?php echo $isi['invoice'];?>">
									Anda yakin ingin Reject Transaksi ini?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary">Yes</button>
							</form>
								</div>
								</div>
							</div>
							</div>
							<!-- close -->
							<div class="modal fade" id="close<?php echo $isi['invoice'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
							<form action="" method="post">
									<input type="hidden" name="invoice" value="<?php echo $isi['invoice'];?>">
									Anda yakin Transaksi ini benar?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary">Yes</button>
							</form>	
								</div>
								</div>
							</div>
							</div>

									<?php $no++; }?>
									<?php $hasil = $lihat -> jumlah_nota(); ?>
								</tbody>
								<tfoot>
								<tr>
										<td></td>
										<th colspan=""> </th>
										
										<th >Total Bersih</th>
										<?php $bersih = $totalsemua - $pengeluaran['nominal'] ?>
										<th>Rp.<?php echo number_format($bersih) ;?>,-</th>
										<th>Total</th>
										<th>Rp.<?php echo number_format($totalsemua) ;?>,-</td>
										<!-- <td></td> -->
										<th>Pengeluaran</th>
										<th  style="text-align: center;">Rp.<?php echo number_format($pengeluaran['nominal'] )?></th>
										
										<!-- <th colspan="5" style="background:#ddd"></th> -->
									</tr>
								</tfoot>
							</table>
						</div>
						<?php } ?>
							<div class="clearfix" style="padding-top:5pc;"></div>
					</div>
				  </div>
              </div>
				  </div>
			  </div>
			  
          <!-- </section> -->
      <!-- </section> -->
	

 <!-- <script>
   $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
  </script>
 <script>
   $(document).ready(function() {
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
  </script> -->
  <script>
	  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
			{ extend: 'print',
			  messageTop: 'Laporan Penjualan',
			  footer: true },
			{ extend: 'pdfHtml5',
			  messageTop: 'Laporan Penjualan', 
			  footer: true },
            { extend: 'excelHtml5',
			  messageTop: 'Laporan Penjualan',	
			  footer: true },
        ]
    } );
} );
  </script>
  <script>
	  $(document).ready(function() {
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
			{ extend: 'print',
			  messageTop: 'Laporan Penjualan',
			  footer: true },
			{ extend: 'pdfHtml5',
			  messageTop: 'Laporan Penjualan', 
			  footer: true },
            { extend: 'excelHtml5',
			  messageTop: 'Laporan Penjualan',	
			  footer: true },
        ]
    } );
} );
  </script>
<?php

require "konfig.php";

if (isset($_POST['save'])) {
	$id = $_POST['invoice'];
	$status  =  $_POST['status'];

	$query = mysqli_query($koneksi, "UPDATE transaksi SET status = '$status' WHERE invoice = '$id'");
}

?>