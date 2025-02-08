 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->

      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Data Laporan Pengeluaran
							<!--<a  style="padding-left:2pc;" href="fungsi/hapus/hapus.php?laporan=jual" onclick="javascript:return confirm('Data Laporan akan di Hapus ?');">
								<button class="btn btn-danger">RESET</button>
							</a>-->
							<?php if(!empty($_GET['cari'])){
								echo 'dari tanggal - '.$_POST['datefrom'].' sampai '.$_POST['dateto'];
							}
							?>
						</h3>
						<br/>
						<h4>Cari Laporan Per Tanggal</h4>
						<form method="post" action="index.php?page=pengeluaran&cari=ok">
							<table class="table table-striped">
								<tr>
									<th>
										Dari Tanggal
									</th>
									<th>
										Sampai Tanggal
									</th>
									<!-- <th>
										Pilih Tanggal
									</th> -->
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
								<!-- <td><p>s/d</p></td> -->
								<!-- <td>
								<input type="date" name="dateto" class="form-control" id="">
								</td> -->
								<td>
									<input type="hidden" name="periode" value="ya">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Cari
									</button>
									<a href="index.php?page=pengeluaran" class="btn btn-success">
										<i class="fa fa-refresh"></i> Refresh</a>
								</td>
								</tr>
							</table>
						</form>
			

						<!-- Trigger the modal with a button -->
						<?php 
						$id = $_SESSION['kasir']['id_cabang'];
						?>
						<a href="excel.php?id=<?php echo $id ?>" class="btn btn-success btn-md pull-left">
							<i class="fa fa-print"></i> Export Excel</a>
						<button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-plus"></i> Insert Data</button>
						<div class="clearfix"></div>
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
										<th> Keperluan</th>
										<th> Barang</th>
										<!-- <th style="width:10%;"> Kategori</th> -->
										<th style="width:20%;"> Nominal</th>
										<th> Oleh</th>
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
										require "konfig.php";
										$id = $_SESSION['kasir']['id_cabang'];
										$query = mysqli_query($koneksi,"SELECT *
										from pengeluaran 
										WHERE id_cabang = '$id' and periode BETWEEN '$tanggal1' and '$tanggal2'");
										while ($isi = mysqli_fetch_array($query)) {
										// $hasil = $lihat -> pengeluaran_tgl($tanggal1 ,$tanggal2);
										// foreach($hasil as $isi){
											$pay += $isi['nominal'];
											$jumlah += $isi['jumlah'];
									?>
									<tr>
									<td><?php echo $no;?></td>
										<td><?php echo $isi['no_pengeluaran'];?></td>
										<td><?php echo $isi['guna'];?></td>
										<td><?php echo $isi['barang'];?></td>
										<!-- <td><?php echo $isi['nama_kategori'];?> </td> -->
										<td>Rp.<?php echo number_format($isi['nominal']);?>,-</td>
										<td><?php echo $isi['oleh'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
									</tr>
									<?php $no++; }?>
									<?php $hasil = $lihat -> jml_pengeluaran(); ?>
								</tbody>
								<tfoot>
								<tr>
										<th colspan="4">Total Pengeluaran</td>
										<!-- <th></td> -->
										<th>Rp.<?php echo number_format($pay);?>,-</td>
										<th colspan="3" style="background:#ddd"></th>
									</tr>
								</tfoot>
							</table>
						</div>
						<?php }else{?>
						<!-- view barang -->	
						<div class="modal-view">
							<table class="table table-bordered"  id="example1 data-table">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th> No</th>
										<th> No. Pengeluaran</th>
										<th> Keperluan</th>
										<th> Barang</th>
										<!-- <th style="width:10%;"> Kategori</th> -->
										<th style="width:20%;"> Nominal</th>
										<th> Oleh</th>
										<th> Tanggal Input</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1;
									//  $hasil = $lihat -> pengeluaran();?>
									<?php 
										// foreach($hasil as $isi){ 
									$id = $_SESSION['kasir']['id_cabang'];
									require "konfig.php";
									$query = mysqli_query($koneksi, "SELECT *
													      from pengeluaran
														  WHERE id_cabang = '$id'");
									while ($isi = mysqli_fetch_array($query)) {
										
											$pay += $isi['nominal'];
											$jumlah += $isi['jumlah'];
									?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $isi['no_pengeluaran'];?></td>
										<td><?php echo $isi['guna'];?></td>
										<td><?php echo $isi['barang'];?></td>
										<!-- <td><?php echo $isi['nama_kategori'];?> </td> -->
										<td>Rp.<?php echo number_format($isi['nominal']);?>,-</td>
										<td><?php echo $isi['oleh'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
									</tr>
									<?php $no++; }?>
									<?php $hasil = $lihat -> jml_pengeluaran(); ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4">Total Pengeluaran</td>
										<!-- <th></td> -->
										<th>Rp.<?php echo number_format($pay);?>,-</td>
										<th colspan="3" style="background:#ddd"></th>
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
				<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content" style=" border-radius:0px;">
						<div class="modal-header" style="background:#285c64;color:#fff;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Data</h4>
						</div>										
						<form action="fungsi/tambah/tambah.php?pengeluaran=tambah" method="POST">
							<div class="modal-body">
						
								<table class="table table-striped bordered">
									
									<?php
										$id = $_SESSION['kasir']['id_cabang'];
										$value = $lihat -> pengeluaran_id();
									?>
									<tr>
											<input type="hidden" value="<?php echo $id ?>" name="id_cabang">
										<td>No. Pengeluaran</td>
										<td><input type="text" readonly="readonly" required value="<?php echo $value;?>" class="form-control"  name="nopeng"></td>
									</tr>
									<!-- <tr>
										<td>Kategori</td>
										<td> -->
										<input type="hidden" name="kategori">
										<!-- <select name="kategori" class="form-control" required>
											<option value="#">Pilih Kategori</option>
											<?php  $kat = $lihat -> kategori(); foreach($kat as $isi){ 	?>
											<option value="<?php echo $isi['id_kategori'];?>"><?php echo $isi['nama_kategori'];?></option>
											<?php }?>
										</select> -->
										<!-- </td>
									</tr> -->
									<tr>
										<td>Keperluan</td>
										<td><input type="text" placeholder="Keperluan" required class="form-control" name="guna"></td>
									</tr>
									<tr>
										<td>Barang</td>
										<td><input type="text" placeholder="Barang" required class="form-control"  name="barang"></td>
									</tr>
									<tr>
										<td>Nominal Pengeluaran</td>
										<td><input type="number" placeholder="Nominal Pengeluaran" required class="form-control"  name="nominal"></td>
									</tr>
									<tr>
										<td>Oleh</td>
										<td><input type="text" required Placeholder="Oleh" class="form-control"  name="oleh"></td>
									</tr>
									<tr>
										<td>Tanggal Input</td>
										<td><input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
									</tr>
								</table>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-plus"></i> Insert Data</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>

          </section>
      </section>

	  
	


