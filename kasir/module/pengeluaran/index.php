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
						<h4>Cari Laporan Per Bulan</h4>
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

						<a href="excel.php" class="btn btn-success btn-md pull-left">
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
										$tanggal1 = $_POST['datefrom'];
										$tanggal2 = $_POST['dateto'];
										$no=1; 
										$jumlah = 0;
										$bayar = 0;
										$hasil = $lihat -> pengeluaran_tgl($tanggal1 ,$tanggal2);
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
							<table class="table table-bordered"  id="example1 data-table">
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
			  <!-- tambah barang MODALS-->
						<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content" style=" border-radius:0px;">
						<div class="modal-header" style="background:#285c64;color:#fff;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Barang</h4>
						</div>										
						<form action="fungsi/tambah/tambah.php?pengeluaran=tambah" method="POST">
							<div class="modal-body">
						
								<table class="table table-striped bordered">
									
									<?php
										$value = $lihat -> pengeluaran_id();
									?>
									<tr>
										<td>No. Pengeluaran</td>
										<td><input type="text" readonly="readonly" required value="<?php echo $value;?>" class="form-control"  name="nopeng"></td>
									</tr>
									<tr>
										<td>Kategori</td>
										<td>
										<select name="kategori" class="form-control" required>
											<option value="#">Pilih Kategori</option>
											<?php  $kat = $lihat -> kategori(); foreach($kat as $isi){ 	?>
											<option value="<?php echo $isi['id_kategori'];?>"><?php echo $isi['nama_kategori'];?></option>
											<?php }?>
										</select>
										</td>
									</tr>
									<tr>
										<td>Guna</td>
										<td><input type="text" placeholder="Guna" required class="form-control" name="guna"></td>
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

	  <script>
	  function exportTableToExcel(example1, filename = ''){
		var downloadLink;
		var dataType = 'application/vnd.ms-excel';
		var tableSelect = document.getElementById(example1);
		var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
		
		// Specify file name
		filename = filename?filename+'.xls':'excel_data.xls';
		
		// Create download link element
		downloadLink = document.createElement("a");
		
		document.body.appendChild(downloadLink);
		
		if(navigator.msSaveOrOpenBlob){
			var blob = new Blob(['\ufeff', tableHTML], {
				type: dataType
			});
			navigator.msSaveOrOpenBlob( blob, filename);
		}else{
			// Create a link to the file
			downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
		
			// Setting the file name
			downloadLink.download = filename;
			
			//triggering the function
			downloadLink.click();
		}
	}
	  </script>
	


