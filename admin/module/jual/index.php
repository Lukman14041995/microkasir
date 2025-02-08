 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php
	$id = $_SESSION['admin']['id_member'];
	$hasil = $lihat->member_edit($id);
	?>

 <?php

	require "konfig.php";

	$jumlah = $_POST['jumlahtotal'];
	$id = $_POST['id'];
	$idbarang = $_POST['id_barang'];

	$query = mysqli_query($koneksi, "SELECT barang_name.harga_jual, barang.stok FROM barang_name INNER JOIN barang ON barang_name.id_barang = barang.id_barang WHERE barang_name.id_barang = '$idbarang' ");
	$a = mysqli_fetch_array($query);
	$harga_jual = $a['harga_jual'];
	// if ($a['stok'] > $jumlah) {
	$total = $harga_jual * $jumlah;
	$update = mysqli_query($koneksi, "UPDATE penjualan SET jumlah = '$jumlah', total = '$total' WHERE id_penjualan = '$id'");
	// }



	?>

 <?php
	// include "konfig.php";

	// error_reporting(0);
	// $id = $_GET['id'];
	// $queryRowProduct = $connect->query("SELECT * FROM barang where id = '".$id."'");
	// $rowProduct = mysqli_fetch_array($queryRowProduct);
	/*
    if (isset($_POST['ubah']) {  
    
      if (!empty($_FILES) && $_FILES['product_images']['size'] >0 && $_FILES['user_foto']['error'] == 0){  
            //$random = substr(number_format(time() * rand(),0,'',''),0,10);
            $images = $_FILES['product_images']['name'];
            $move = move_uploaded_file($_FILES['product_images']['tmp_name'],'assets/images/product/'.$images);  

            if ($move) {  
              $queryUpdate  = mysql_query("UPDATE product SET 
                                    product_name      = '".$_POST['product_name']."',
                                    product_price     = '".str_replace(".", "", $_POST['product_price'])."',
                                    product_desc      = '".$_POST['product_desc']."',
                                    product_images    = '".$images."',
                                    product_stock     = '".str_replace(".", "", $_POST['product_stock'])."',
                                    category_id       = '".$_POST['product_category']."'
                                    WHERE product_id     = '".$id."'
                                     ");
                $file = "assets/images/product/".$rowProduct['product_images'];
                unlink($file);
                                             
            }

      }else{  
        */


	//           if(isset($_POST['ubah'])){  
	//                 $queryUpdate=$connect->query("UPDATE barang SET
	//                                                     nmbrg = '".$_POST['product_name']."',
	//                                                     harga = '".str_replace(".", "", $_POST['product_price'])."',
	//                                                     stock = '".str_replace(".", "", $_POST['product_stock'])."',
	//                                                     category_id       = '".$_POST['product_category']."' ,
	//                                                     nmsatuan = '".$_POST['satuan']."'  
	//                                                     WHERE id    = '".$id."' "); 
	//          if($queryUpdate === TRUE){

	// echo "<script> alert('Data Berhasil Diubah'); location.href='index.php?hal=master/barang/list' </script>";exit;
	//            }else{
	//             echo "ERROR UBAH DATA =" .$sql->connect_error;
	//            }
	//             }                        

	// if ($queryUpdate) {
	//  echo "<script> alert('Data Berhasil Diubah'); location.href='index.php?hal=master/barang/list' </script>";exit;
	//}
	//}
	?>

 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
 <style>
 	tr {
 		border-color: 1px solid rgb(196, 196, 196);
 	}
 </style>
 <div class="card">
 	<div class="card-body">
 		<div class="row">
 			<div class="col-md-6">
 				<!-- <a href="index.php?page=barang" class="btn btn-success text-white">+ Tambah Stok</a> -->
 				<h3 class="mt-3">Keranjang Penjualan <i class="mdi mdi-cart"></i></h3>
 			</div>
 			<div class="col-md-6 text-right">
 				<?php $invoice = $lihat->invoice_id(); ?>
 				<h3>Invoice <?php echo $invoice ?> </h3>
 				<div class="row">
 					<div class="col-md-12 text-right">
 						<?php
							$id_cabang = $_SESSION['admin']['id_cabang'];
							$query = "SELECT keranjang.*, barang_name.nama_barang,	 barang_name.harga_jual FROM keranjang INNER JOIN barang_name ON keranjang.id_barang = barang_name.id_barang
				WHERE keranjang.id_cabang = '$id_cabang'";
							?>
 						<a href="index.php?page=jual/hapus&id_cabang=<?= $id_cabang ?>" class="btn btn-danger" style="width: 200px; color: white;">Reset Keranjang</a>
 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="row mt-3">
 			<div class="col-md-6">
 				<div class="row">
 					<div class="col-md-12">
 						<h5 class="text-right">Cari Barang <i class="fa fa-search"></i> </h5>
 					</div>
 				</div>
 				<div class="table-responsive">
 					<table class="table" id="editable-sample">
 						<thead>
 							<tr class="bg-dark">
 								<!--<th width="5%">No</th>-->
 								<th style="color: white;" width="20%">Id Barang</th>
 								<th style="color: white;" width="20%">Product</th>
 								<th style="color: white;" width="15%">Price</th>
 								<th style="color: white;" width="15%">Stock</th>
 								<!--<th>Deskripsi</th>-->
 								<th style="color: white;" width="10%">Action</th>
 							</tr>
 						</thead>
 						<tbody>
 							<?php
								$id = $_SESSION['admin']['id_cabang'];
								$no = 1;
								$queryProduct = mysqli_query($koneksi, "SELECT barang.*, barang_name.nama_barang, barang_name.harga_jual, kategori.nama_kategori FROM barang INNER JOIN barang_name ON barang.id_barang = barang_name.id_barang INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori WHERE barang.id_cabang = '$id'
					ORDER BY id_barang asc ");
								while ($rowProduct = mysqli_fetch_array($queryProduct)) {
								?>
 								<tr class="">
 									<!-- <td><?php echo $no++ ?></td>-->
 									<td><?php echo $rowProduct['id_barang'] ?></td>
 									<td><?php echo $rowProduct['nama_barang'] ?></td>
 									<td>Rp. <?php echo number_format($rowProduct['harga_jual'], 0, ',', '.'); ?></td>
 									<td><?php if ($rowProduct['stok'] == '0') { ?>
 											<span class="badge badge-danger"> Habis</span>
 										<?php } else { ?>
 											<?php echo $rowProduct['stok']; ?>
 										<?php } ?>
 									</td>
 									<!-- <td><?php echo $rowProduct[''] ?></td>-->
 									<td>
 										<a href="index.php?page=jual/cart&input=add&id_barang=<?= $rowProduct['id_barang'] ?>">
 											<button class="btn btn-primary" type="submit">
 												Select
 											</button>
 										</a>
 										<!-- <a href="?hal=master/barang/list&hapus=<?php echo $rowProduct['id']; ?>">
								<button class="btn btn-danger" type="submit" name="hapus"><i
												class="fa fa-trash-o"></i> Delete
									</button>
								</a> -->
 									</td>
 								</tr>
 								<!--
						<tr class="">
							<td><img src="assets/images/product/<?php echo $rowProduct['product_images']; ?>"
									width="100%"></td>
							<td><?php echo $rowProduct['product_name'] ?></td>
							<td>Rp. <?php echo number_format($rowProduct['product_price'], 0, ',', '.'); ?></td>
							<td><?php echo $rowProduct['product_stock'] ?></td>
							<td><?php echo $rowProduct['product_desc'] ?></td>
							<td>
								<a href="?hal=master/product/edit&id=<?php echo $rowProduct['product_id']; ?>">
									<button class="btn btn-primary" type="submit"><i class="fa fa-edit"
																					aria-hidden="true"></i>
										Edit
									</button>
								</a>
								<a href="?hal=master/product/list&hapus=<?php echo $rowProduct['product_id']; ?>">
								<button class="btn btn-danger" type="submit" name="hapus"><i
												class="fa fa-trash-o"></i> Delete
									</button>
								</a>
							</td>
						</tr>-->
 							<?php } ?>
 						</tbody>
 					</table>
 				</div>
 			</div>
 			<div class="col-md-6">
 				<div class="table-responsive">
 					<table id="editable-sample" class="table">
 						<thead>
 							<tr class="bg-dark">
 								<td></td>
 								<th style="color: white;">Item</th>
 								<th style="color: white;">Price</th>
 								<th style="color: white;">Qty</th>
 								<th style="color: white;">Total</th>
 							</tr>
 						</thead>
 						<tbody>
 							<?php
								$id_cabang = $_SESSION['admin']['id_cabang'];
								$query = "SELECT keranjang.*, barang_name.nama_barang,	 barang_name.harga_jual FROM keranjang INNER JOIN barang_name ON keranjang.id_barang = barang_name.id_barang
				WHERE keranjang.id_cabang = '$id_cabang'";

								$result = mysqli_query($koneksi, $query);
								$no = 1;
								$total = 0;

								while ($data = mysqli_fetch_array($result)) {
									$sub_total = +$data['harga_jual'] * $data['stok'];
									$total += $sub_total;
								?>
 								<tr>
 									<td>
 										<a href="index.php?page=jual/hapus_keranjang&hapus=<?= $data['id_keranjang'] ?>&id_cabang=<?= $id_cabang ?>"><i
 												class="fa fa-times" style="color: red"></i></a>
 									</td>
 									<td>
 										<?php echo $data['nama_barang'] ?></td>
 									<td><?php echo number_format($data['harga_jual'], 0, ',', '.'); ?></td>
 									<td><?php echo $data['stok'] ?></td>
 									<td>Rp. <?php echo number_format($sub_total, 0, ',', '.'); ?></td>
 								</tr>
 							<?php } ?>
 							<tr>
 								<form action="print.php" method="GET" target="_blank">
 									<td colspan="4">
 										Sub Total
 									</td>
 									<td>
 										Rp. <?php echo number_format($total, 0, ',', '.'); ?>
 										<?php
											require "konfig.php";
											$idmember = $_SESSION['admin']['id_member'];
											$idcabang = $_SESSION['admin']['id_cabang'];
											$nm_member = $_SESSION['admin']['nm_member'];
											$scl = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_member = '$idmember' and id_cabang = '$idcabang'");
											while ($q = mysqli_fetch_array($scl)) {
												$id_barang = $q['id_barang'];
												$stok = $q['stok'];
											?>
 											<input type="hidden" name="idbarang[]" value="<?php echo $id_barang ?>">
 											<input type="hidden" name="stok[]" value="<?php echo $stok ?>">
 											<input type="hidden" name="subtot[]" value="<?php echo $sub_total ?>">
 											<input type="hidden" name="tgl_input[]" value="<?php echo date("j F Y, G:i") ?>">
 											<input type="hidden" name="periode[]" value="<?php echo date('Y-m-d') ?>">
 											<input type="hidden" name="idmember[]" value="<?php echo $idmember ?>">
 											<input type="hidden" value="<?php echo $invoice ?>" name="invoice[]">
 											<input type="hidden" name="hapuskeranjang" value="<?php echo $q['id_keranjang'] ?>">
 										<?php }
											?>
 										<input type="hidden" name="cabang" value="<?php echo $idcabang ?>">

 										<input type="hidden" name="nmmember" value="<?php echo $nm_member ?>">
 										<input type="hidden" value="<?php echo $invoice ?>" name="invo">
 									</td>
 							</tr>
 							<tr>
 								<td colspan="2"><input type="text" class="form-control" placeholder="Diskon(%)" onkeyup="diskon()" name="disc" id="txtdisc"></td>
 								<td colspan="3"><input type="text" class="form-control" placeholder="Potongan(Rp.)" name="pot" onkeyup="diskon()" id="potongan"></td>
 							</tr>
 							<tr>
 								<td>Total</td>
 								<td></td>
 								<td></td>
 								<td></td>
 								<td><input type="text" onKeyUp="kalkulatorTambah(getElementById('type1').value,this.value);" value="<?php echo $total ?>" readonly class="form-control" name="bigtotal" id="type1"></td>
 							</tr>
 							<tr>
 								<td>Bayars</td>
 								<td></td>
 								<td></td>
 								<td></td>
 								<td><input type="text" class="form-control input-lg" placeholder="input payment"
 										id="type2" name="cash" autofocus required oninvalid="this.setCustomValidity('Bayarnya Belum :D')"
 										onKeyUp="kalkulatorTambah(getElementById('type1').value,this.value);" />
 								</td>
 							</tr>
 							<tr>
 								<td>Kembalian</td>
 								<td></td>
 								<td></td>
 								<td></td>
 								<td>
 									<input type="hidden" name="kembalian" id="kembalian">
 									<input type="text" id="result" style="border: none; color: white; background-color: orangered; padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">
 									<!-- <input type="text" name="" id="result" class="form-control"> -->
 									<!-- <p>
						<span class="bg-danger text-white p-3 p-md-3" id="result">
						</span></p> -->
 							</tr>
 							<tr>
 								<td colspan="6" align="reight">

 									<button class="btn btn-danger btn-lg btn-block" type="submit" name="bayar" style="color: white;">Payment
 									</button>
 								</td>
 								</form>

 								<!-- <div class="modal fade rounded" id="myModal" tabindex="-1" role="dialog"
						aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog p-3 p-md-3">
							<div class="modal-content bg-dark text-white p-3 p-md-3">
							<h3 class="text-center text-white p-3 p-md-5">TRANSACTION</h3>
								<div class="modal-header bg-dark text-white">
								<
									<h2 class="modal-title text-white">TOTAL :
										Rp. <?php echo number_format($total, 0, ',', '.'); ?></h2>
								</div>

								<div class="modal-body row">
									<div class="col-sm-12 p-3 p-md-3"> -->
 								<!--<form method="POST" action="?hal=cetak">-->
 								<!-- <form method="POST" action="cetak.php">
											<div class="form-group">
												<label><h3 class="text-white"> PAYMENT</h3></label>

											</div>


											<div class="form-group"> -->
 								<!-- <input type="hidden" id="type1" name="grand_total"
													onKeyUp="kalkulatorTambah(getElementById('type1').value,this.value);"
													value="<?php echo number_format($total, 0, ',', '.'); ?>"/> -->

 								<!-- <input type="text" class="form-control input-lg" placeholder="input payment"
													id="type2" name="cash"
													onKeyUp="kalkulatorTambah(getElementById('type1').value,this.value);"
													/> -->

 								<!-- 
											</div>

											<div class="form-group">

												<label><h3 class="text-white">CHANGE</h3></label> -->
 								<!-- <input type="hidden" name="kembalian"
													id="kembalian">
												<h1>

											<span class="bg-danger text-white p-3 p-md-3" id="result">
											</span></h1> -->
 								<!-- </div>

											<div class="pull-right">

												<button class="btn btn-info btn-sm"
														type="submit">SAVE / PRINT
												</button>
												<button class="btn btn-danger btn-sm"
														data-dismiss="modal" aria-hidden="true"
														type="button">
													Cancel
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div> -->
 								<!-- end modal -->
 							</tr>
 						</tbody>
 					</table>
 				</div>
 			</div>





 		</div>
 	</div>
 </div>



 <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
 <script>
 	// AJAX call for autocomplete 
 	$(document).ready(function() {
 		$("#cari").change(function() {
 			$.ajax({
 				type: "POST",
 				url: "fungsi/edit/edit.php?cari_barang=yes",
 				data: 'keyword=' + $(this).val(),
 				beforeSend: function() {
 					$("#hasil_cari").hide();
 					$("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
 				},
 				success: function(html) {
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
 	function diskon() {
 		var txtdisc = document.getElementById('txtdisc').value;
 		var disrp = document.getElementById('potongan').value;
 		var diskon = <?php echo $total ?> * txtdisc / 100;
 		var totalakhir = <?php echo $total ?> - diskon - disrp;
 		if (!isNaN(totalakhir)) {
 			document.getElementById('type1').value = totalakhir;
 		}
 	}

 	function bayar() {
 		var bayar = document.getElementById('txtbayar').value;
 		var akhir = document.getElementById('txttotakhir').value;
 		var kembali = bayar - akhir;
 		if (!isNaN(kembali)) {
 			document.getElementById('txtkembali').value = kembali;
 		}
 	}

 	function bayar() {
 		var bayar = document.getElementById('txtbayar').value;
 		var akhir = document.getElementById('txttotakhir').value;
 		var kembali = bayar - akhir;
 		// if (akhir == null || txtdisc == null || disrp == null) {
 		//     document.getElementById('txtkembali').value = '';
 		// }else
 		if (!isNaN(kembali)) {
 			document.getElementById('txtkembali').value = kembali;
 		}
 	}
 </script>
 <script>
 	$('#editable-sample').DataTable();
 </script>
 <script>
 	function searchFilter(page_num) {
 		// page_num = page_num?page_num:0;
 		var keywords = $('#keywords').val();
 		// var sortBy = $('#sortBy').val();
 		$.ajax({
 			type: 'GET',
 			url: 'getProduct.php',
 			data: '?hal=post&keywords=' + keywords,
 			beforeSend: function() {
 				$('.loading-overlay').show();
 			},
 			success: function(html) {
 				$('#show_product').html(html);
 				$('.loading-overlay').fadeOut("slow");
 			}
 		});
 	}

 	function formatRupiah(angka, prefix) {
 		var number_string = angka.replace(/[^,\d]/g, '').toString(),
 			split = number_string.split(','),
 			sisa = split[0].length % 3,
 			rupiah = split[0].substr(0, sisa),
 			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

 		if (ribuan) {
 			separator = sisa ? '.' : '';
 			rupiah += separator + ribuan.join('.');
 		}

 		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
 		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
 	}

 	function convertToRupiah(angka) {
 		var rupiah = '';
 		var angkarev = angka.toString().split('').reverse().join('');
 		for (var i = 0; i < angkarev.length; i++)
 			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
 		return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
 	}

 	function kalkulatorTambah(type1, type2) {

 		var a = parseInt(type1.replace(/,.*|[^0-9]/g, ''), 10); //eval(type1);
 		var b = parseInt(type2.replace(/,.*|[^0-9]/g, ''), 10);
 		var hasil = b - a;

 		var jumlah = 'Rp. ' + hasil.toFixed(0).replace(/(d)(?=(ddd)+(?!d))/g, "$1.");
 		//var total = NilaiRupiah(hasil);
 		// console.info('hahah')
 		document.getElementById('result').value = convertToRupiah(hasil);

 		document.getElementById("kembalian").value = hasil; //document.getElementById("type2").value;

 	}

 	/* Tanpa Rupiah */
 	var tanpa_rupiah = document.getElementById('type1');
 	tanpa_rupiah.addEventListener('keyup', function(e) {
 		tanpa_rupiah.value = formatRupiah(this.value);
 	});

 	// var puser = document.getElementById('type2');
 	// puser.addEventListener('keyup', function (e) {
 	//     puser.value = formatRupiah(this.value);
 	// });
 </script>