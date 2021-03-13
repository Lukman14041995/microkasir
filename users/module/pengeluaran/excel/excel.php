 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->

<?php 
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Data Pegawai.xls");
?>

      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
						
						<br/>
						<!-- view barang -->	
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
										<th> No. Pengeluaran</th>
										<th> Guna</th>
										<th style="width:10%;"> Jumlah</th>
										<th style="width:20%;"> Total</th>
										<th> Oleh</th>
										<th> Tanggal Input</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$periode = $_POST['bln'].'-'.$_POST['thn'];
										$no=1; 
										$jumlah = 0;
										$bayar = 0;
										$hasil = $lihat -> periode_jual($periode);
										foreach($hasil as $isi){
											$bayar += $isi['total'];
											$jumlah += $isi['jumlah'];
									?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $isi['id_barang'];?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo $isi['jumlah'];?> </td>
										<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
										<td><?php echo $isi['nm_member'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
									</tr>
									<?php $no++; }?>
									<?php $hasil = $lihat -> jumlah_nota(); ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4">Total Terjual</td>
										<!-- <th><?php echo $jumlah;?></td> -->
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
										<th> No. Pengeluaran</th>
										<th> Guna</th>
										<th style="width:10%;"> Jumlah</th>
										<th style="width:20%;"> Total</th>
										<th> Oleh</th>
										<th> Tanggal Input</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; $hasil = $lihat -> jual();?>
									<?php 
										$bayar = 0;
										$jumlah = 0;
										foreach($hasil as $isi){ 
											$bayar += $isi['total'];
											$jumlah += $isi['jumlah'];
									?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $isi['id_barang'];?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo $isi['jumlah'];?> </td>
										<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
										<td><?php echo $isi['nm_member'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
									</tr>
									<?php $no++; }?>
									<?php $hasil = $lihat -> jumlah_nota(); ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4">Total Terjual</td>
										<!-- <th><?php echo $jumlah;?></td> -->
										<th>Rp.<?php echo number_format($bayar);?>,-</td>
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
			  <!-- tambah barang MODALS-->
						<!-- Modal -->
					
					</div>

          </section>
      </section>
	

