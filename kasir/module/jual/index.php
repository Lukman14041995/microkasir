 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php 
		  $id = $_SESSION['kasir']['id_member'];
		  $hasil = $lihat -> member_edit($id);
      ?>
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12 main-chart">
				<h3>Keranjang Penjualan</h3>
				<br>
				<?php if(isset($_GET['success'])){?>
				<div class="alert alert-success">
					<p>Edit Data Berhasil !</p>
				</div>
				<?php }?>
				<?php if(isset($_GET['remove'])){?>
				<div class="alert alert-danger">
					<p>Hapus Data Berhasil !</p>
				</div>
				<?php }?>
				<div class="col-sm-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4><i class="fa fa-search"></i> Cari Barang</h4>
						</div>
						<div class="panel-body">
							<input type="text" id="cari" class="form-control" autofocus name="cari" placeholder="Masukan : Kode / Nama Barang  [ENTER]">
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4><i class="fa fa-list"></i> Hasil Pencarian</h4>
						</div>
						<div class="panel-body">
							<div id="hasil_cari"></div>
							<div id="tunggu"></div>				
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4><i class="fa fa-shopping-cart"></i> KASIR
							<a class="btn btn-danger pull-right" style="margin-top:-0.5pc;" href="fungsi/hapus/hapus.php?penjualan=jual">
								<b>RESET KERANJANG</b></a>
							</h4>
						</div>
						<div class="panel-body">
							<div id="keranjang">
								<table class="table table-bordered">
									<?php
										$format = $lihat -> jual_id();
										$invoice = $lihat -> invoice_id();
									?>
									<tr>
										<td>No. Invoice</td>
										<td><input type="text" readonly="readonly" required value="<?php echo $invoice; ?>" class="form-control"  name="invoice[]"></td>
									</tr>
									<tr>
										<td><b>Tanggal</b></td>
										<td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
									</tr>
								</table>
								<table class="table table-bordered" id="example1">
									<thead>
										<tr>
											<td> No</td>
											<td> Nama Barang</td>
											<td style="width:20%;"> Harga</td>
											<td style="width:10%;"> Jumlah</td>
											<td style="width:20%;"> Total</td>
											<!-- <td> Kasir</td> -->
											<td> Aksi</td>
										</tr>
									</thead>
									<tbody>
										<?php $total_bayar=0; $no=1; 
										$hasil_penjualan = $lihat -> penjualan();?>
										<?php foreach($hasil_penjualan  as $isi){;?>
										<tr>
											<td><?php echo $no;?></td>
											<td><?php echo $isi['nama_barang'];?></td>
											<td>Rp.<?php echo number_format ($isi['harga_jual']);?>,-</td>
											<td>
												<form method="POST" action="fungsi/edit/edit.php?jual=jual">
													<input type="number" name="jumlah" value="<?php echo $isi['jumlah'];?>" class="form-control">
													<input type="hidden" name="id" value="<?php echo $isi['id_penjualan'];?>" class="form-control">
													<input type="hidden" name="id_barang" value="<?php echo $isi['id_barang'];?>" class="form-control">
											</td>
											<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
											<!-- <td><?php echo $isi['nm_member'];?></td> -->
											<td>
													<!-- <button type="submit" class="btn btn-warning">Update</button> -->
												</form>
												<a href="fungsi/hapus/hapus.php?jual=jual&id=<?php echo $isi['id_penjualan'];?>&brg=<?php echo $isi['id_barang'];?>
												&jml=<?php echo $isi['jumlah']; ?>"  class="btn btn-danger"><i class="fa fa-times"></i>
												</a>
											</td>
										</tr>
										<?php $no++; $total_bayar += $isi['total'];
											$disc = $_POST['diskon'];
											$diskon = $isi['total'] * $disc/100;
											$totalakhir = $isi['total'] - $diskon;
										}
										?>
									</tbody>
									<tfoot>
									<tr>
										<th colspan="3">Total</td>
										<th></td>
										<th>Rp.<?php echo number_format ($total_bayar);?>,-</td>
										<th colspan="2" style="background:#ddd"></th>
									</tr>
						</tfoot>
							</table>
							<br/>
							<?php $hasil = $lihat -> jumlah(); ?>
							<div id="kasirnya">
								<table class="table table-stripped">
									<?php
										// proses bayar dan ke nota
									
									if(!empty($_GET['nota'] == 'yes')) {
										$bayar = $_POST['pay'];
										$kembali = $_POST['kembali'];
										$id_barang = $_POST['id_barang'];
										$id_member = $_POST['id_member'];
										$invoice = $_POST['invoice'];
										$jumlah = $_POST['jumlah'];
										$total = $_POST['total'];
										$tgl_input = $_POST['tgl_input'];
										$periode = $_POST['periode'];
										$jumlah_dipilih = count($id_barang);
										
										for($x=0;$x<$jumlah_dipilih;$x++){

											$d = array($id_barang[$x],$id_member[$x],$invoice[$x],$jumlah[$x],$total[$x],$tgl_input[$x],$periode[$x]);
											$sql = "INSERT INTO nota (id_barang,id_member,invoice,jumlah,total,tanggal_input,periode) VALUES(?,?,?,?,?,?,?)";
											$row = $config->prepare($sql);
											$row->execute($d);

											// ubah stok barang
											$sql_barang = "SELECT * FROM barang WHERE id_barang = ?";
											$row_barang = $config->prepare($sql_barang);
											$row_barang->execute(array($id_barang[$x]));
											$hsl = $row_barang->fetch();
											
											$stok = $hsl['stok'];
											$idb  = $hsl['id_barang'];

											$total_stok = $stok - $jumlah[$x];
											echo $total_stok;
											$sql_stok = "UPDATE barang SET stok = ? WHERE id_barang = ?";
											$row_stok = $config->prepare($sql_stok);
											$row_stok->execute(array($total_stok, $idb));
											
										}
										echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
											// }else{
											// 	echo '<script>alert("Uang Kurang ! Rp.'.$hitung.'");</script>';
											// }
										// }
									}
									
									?>
									<form method="POST" action="index.php?page=jual&nota=yes#kasirnya">
									
										<?php foreach($hasil_penjualan as $isi){;?>
											<input type="hidden" name="id_barang[]" value="<?php echo $isi['id_barang'];?>">
											<input type="hidden" name="id_member[]" value="<?php echo $isi['id_member'];?>">
											<input type="hidden"  value="<?php echo $invoice; ?>" class="form-control"  name="invoice[]">
											<input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah'];?>">
											<input type="hidden" name="total[]" value="<?php echo $isi['total'];?>">
											<input type="hidden" name="tgl_input[]" value="<?php echo $isi['tanggal_input'];?>">
											<input type="hidden" name="periode[]" value="<?php echo  date("Y-m-d"); ?>">
											<input type="hidden" name="id[]" value="<?php echo $isi['id_penjualan'];?>" class="form-control">
										<?php } ?>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><button type="submit" class="btn btn-success" ><i class="fa fa-shopping-cart"></i> Bayar</button></td>
										<tr>
									</form>
									<form action="print.php" method="get" target="_blank">
										<td>Diskon %</td>
										<td width='10%'><input type="text" class="form-control" id='txtdisc' onkeyup="diskon();" name="disc"></td>
										<td>Total Semua  </td>
										<td><input type="text"  readonly="readonly" class="form-control"  id="txttotakhir" name="totalakhir"></td>
										<td>Bayar  </td>
										<td><input type="text"  required class="form-control" id="txtbayar" onkeyup="bayar();"  name="pay"></td>
										<td>
										<?php  if(!empty($_GET['nota'] == 'yes')) {?>
											<a class="btn btn-danger" href="fungsi/hapus/hapus.php?penjualan=jual">
											<b>RESET</b></a></td><?php }?></td>
										</tr>
									
									<tr>
										<td>Diskon Rp.</td>
										<td width='10%'><input type="text" class="form-control" onkeyup="potongan()" id='txtrp'  name="potongan"></td>
										<td>Kembali</td>
										<td><input type="text" class="form-control" readonly name="kembali"  id="txtkembali"></td>
										<?php $invoice = $lihat -> invoice_id(); ?>
										<input type="hidden" name="totalbayar"  value="<?php echo $total_bayar ?>" id="">
										<input type="hidden" name="member" value="<?php echo $_SESSION['kasir']['nm_member'];?>" id="">
										<input type="hidden"  value="<?php echo $invoice; ?>" class="form-control"  name="invoice">
										<td></td>
										<td>
											<button class="btn btn-default" type="submit" name="print">
												<i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
											</button>
										</td>
									</form>
									</tr>
								</table>
								<br/>
								<br/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
	

<script>
// AJAX call for autocomplete 
$(document).ready(function(){
	$("#cari").change(function(){
		$.ajax({
		type: "POST",
		url: "fungsi/edit/edit.php?cari_barang=yes",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
            $("#hasil_cari").hide();
			$("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
		},
          success: function(html){
			$("#tunggu").html('');
            $("#hasil_cari").show();
            $("#hasil_cari").html(html);
		}
	});
	});
});
//To select country name
</script>

<script>
	function diskon(){
		var txtdisc = document.getElementById('txtdisc').value;
		var txtbayar = document.getElementById('txtbayar').value;
		var diskon = <?php echo $total_bayar ?> * txtdisc/100;
		var totalakhir = <?php echo $total_bayar ?> - diskon;
		 if (!isNaN(totalakhir)) {
			document.getElementById('txttotakhir').value = totalakhir ;
		}
	}
	function potongan(){
		var disrp = document.getElementById('txtrp').value;
		var totakhir = <?php echo $total_bayar ?> - disrp;
		if(!isNaN(totakhir)){
			document.getElementById('txttotakhir').value = totakhir ;
		}
	}
	function bayar(){
		var bayar = document.getElementById('txtbayar').value;
		var akhir = document.getElementById('txttotakhir').value;
		var kembali = bayar - akhir;	
		if (!isNaN(kembali)) {
			document.getElementById('txtkembali').value = kembali;
		}
	}
</script>




