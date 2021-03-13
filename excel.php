 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
<?php 
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> pengeluaran();
	$hsl = $lihat -> pengeluaran();;
?>
<?php 
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Data Pengeluaran.xls");
?>

<section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
						
						<!-- Trigger the modal with a button -->

						
						<?php if(!empty($_GET['cari'])){?>
						<!-- view barang -->	
						<div class="modal-view">
							<table class="table table-bordered" id="example1">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th> No</th>
										<th> No. Pengeluaran</th>
										<th> Guna</th>
										<th> Barang</th>
										<th style="width:10%;"> Kategori</th>
										<th style="width:20%;"> Nominal</th>
										<th> Oleh</th>
										<th> Tanggal Input</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$tanggal = $_POST['datefrom'];
										$no=1; 
										$jumlah = 0;
										$bayar = 0;
										$hasil = $lihat -> pengeluaran_tgl($tanggal1, $tanggal2);
										foreach($hasil as $isi){
											$pay += $isi['nominal'];
											$jumlah += $isi['jumlah'];
									?>
									<tr>
									<td><?php echo $no;?></td>
										<td><?php echo $isi['no_pengeluaran'];?></td>
										<td><?php echo $isi['guna'];?></td>
										<td><?php echo $isi['barang'];?></td>
										<td><?php echo $isi['nama_kategori'];?> </td>
										<td>Rp.<?php echo number_format($isi['nominal']);?>,-</td>
										<td><?php echo $isi['oleh'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
									</tr>
									<?php $no++; }?>
									<?php $hasil = $lihat -> jml_pengeluaran(); ?>
								</tbody>
								<tfoot>
								<tr>
										<th colspan="5">Total Pengeluaran</td>
										<!-- <th></td> -->
										<th>Rp.<?php echo number_format($pay);?>,-</td>
										<th colspan="2" style="background:#ddd"></th>
									</tr>
								</tfoot>
							</table>
						</div>
						<?php }else{?>
						<!-- view barang -->	
						<div class="modal-view">
							<table class="table table-bordered" border="1"  id="example1 data-table">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th> No</th>
										<th> No. Pengeluaran</th>
										<th> Guna</th>
										<th> Barang</th>
										<th style="width:10%;"> Kategori</th>
										<th style="width:20%;"> Nominal</th>
										<th> Oleh</th>
										<th> Tanggal Input</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; $hasil = $lihat -> pengeluaran();?>
									<?php 
										$bayar = 0;
										$jumlah = 0;
										foreach($hasil as $isi){ 
											$pay += $isi['nominal'];
											$jumlah += $isi['jumlah'];
									?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $isi['no_pengeluaran'];?></td>
										<td><?php echo $isi['guna'];?></td>
										<td><?php echo $isi['barang'];?></td>
										<td><?php echo $isi['nama_kategori'];?> </td>
										<td>Rp.<?php echo number_format($isi['nominal']);?>,-</td>
										<td><?php echo $isi['oleh'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
									</tr>
									<?php $no++; }?>
									<?php $hasil = $lihat -> jml_pengeluaran(); ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="5">Total Pengeluaran</td>
										<!-- <th></td> -->
										<th>Rp.<?php echo number_format($pay);?>,-</td>
										<th colspan="2" style="background:#ddd"></th>
									</tr>
								</tfoot>
							</table>
						</div>
						<?php }?>
							<div class="clearfix" style="padding-top:5pc;"></div>
					</div>
				  </div>
              </div>
			  
			</div>

          </section>
      </section>
	

