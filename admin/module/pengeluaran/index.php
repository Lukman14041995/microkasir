 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->

      <!-- <div class="container-fluid"> -->
          <!-- <section class="wrappe/r"> -->

              <div class="row">
                  <div class="col-lg-12 main-chart">
					  <div class="card">
 						 <div class="card-body">
						  <h5>Data Laporan Pengeluaran
							<!--<a  style="padding-left:2pc;" href="fungsi/hapus/hapus.php?laporan=jual" onclick="javascript:return confirm('Data Laporan akan di Hapus ?');">
								<button class="btn btn-danger">RESET</button>
							</a>-->
							
						</h5>
						<?php if(!empty($_GET['cari'])){
							?>
							<div class="alert alert-success" role="alert">
							Dari Tanggal <?php echo $_POST['datefrom'] ?> sampai <?php echo $_POST['dateto'] ?>
							</div>
						<?php } ?>	
						<br/>
						<h5>Cari Laporan Per Tanggal</h5>
						<form method="post" action="index.php?page=pengeluaran&cari=ok">
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
									<a href="index.php?page=pengeluaran" style="color: white;" class="btn btn-success">
										<i class="fa fa-refresh"></i> Refresh</a>
								</div>
							</div>
						</form>
			

						<!-- Trigger the modal with a button -->
						<?php 
						$id = $_SESSION['admin']['id_cabang'];
						?>
						<!-- <a href="excel.php?id=<?php echo $id ?>" class="btn btn-success btn-md pull-left">
							<i class="fa fa-print"></i> Export Excel</a> -->
						<button type="button" class="btn btn-primary btn-md pull-right mt-5" data-toggle="modal" data-target="#exampleModal">
							<i class="fa fa-plus"></i> Insert Data</button>
						<div class="clearfix"></div>
						<br/>
						<!-- view barang -->	
						<div class="clearfix" style="border-top:1px solid #ccc;"></div>
						<br/>
						<br/>
						<?php if(!empty($_GET['cari'])){?>
						<!-- view barang -->	
						<div class="table-responsive">
							<table class="table table-bordered" id="table1">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th> No</th>
										<th> No. Pengeluaran</th>
										<th> Guna</th>
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
										$id = $_SESSION['admin']['id_cabang'];
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
										<td>Rp.<?php echo number_format($isi['nominal']) ;?>,-</td>
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
										<th>Rp.<?php echo number_format($pay) ;?>,-</td>
										<th colspan="3" style="background:#ddd"></th>
									</tr>
								</tfoot>
							</table>
						</div>
						<?php }else{?>
						<!-- view barang -->	
						<div class="table-responsive">
							<table class="table table-bordered"  id="table2">
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
									$id = $_SESSION['admin']['id_cabang'];
									require "konfig.php";
									$query = mysqli_query($koneksi, "SELECT *
													      from pengeluaran 
														  WHERE id_cabang = '$id'
														  ORDER BY no_pengeluaran DESC");
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
										<td>Rp.<?php echo number_format($isi['nominal']) ;?>,-</td>
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
										<th>Rp.<?php echo number_format($pay) ;?>,-</td>
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
				  </div>
              </div>
			  <!-- tambah barang MODALS-->
		
				<!-- new modal -->
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
							<div class="modal-body">
						<form action="index.php?page=pengeluaran" method="POST">
								<?php
									$id = $_SESSION['admin']['id_cabang'];
									$value = $lihat -> pengeluaran_id();
								?>
								<input type="hidden" value="<?php echo $id ?>" name="id_cabang">
								<div class="form-group">
									<label for="">No. Pengeluaran</label>
									<input type="text" readonly="readonly" required value="<?php echo $value;?>" class="form-control"  name="nopeng">
								</div>
								<div class="form-group">
									<label for="">Keperluan</label>
									<input type="text" placeholder="Keperluan" required class="form-control" name="guna">
								</div>
								<div class="form-group">
									<label for="">Barang</label>
									<input type="text" placeholder="Barang" required class="form-control"  name="barang">
								</div>
								<div class="form-group">
									<label for="">Nominal Pengeluaran</label>
									<input type="number" placeholder="Nominal Pengeluaran" id="rupiah" required class="form-control"  name="nominal">
								</div>
								<div class="form-group">
									<label for="">Oleh</label>
									<input type="text" required Placeholder="Oleh" class="form-control"  name="oleh">
								</div>
								<div class="form-group">
									<label for="">Tanggal Input</label>
									<input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>

          <!-- </section> -->
      <!-- </div> -->
	  <?php 
 if (isset($_POST['simpan'])) {
	 $id_cabang = $_POST['id_cabang'];
	 $nopeng = $_POST['nopeng'];
	 $guna = $_POST['guna'];
	 $barang = $_POST['barang'];
	 $nominal = $_POST['nominal'];
	 $oleh = $_POST['oleh'];
	 $tgl = $_POST['tgl'];
	 $periode = date("Y-m-d");
	 require "konfig.php";
	 $sql = mysqli_query($koneksi, "INSERT INTO pengeluaran VALUES(null, '$nopeng','','$guna','$barang','$nominal','$oleh','$tgl','$periode','$id_cabang')");
	 if ($sql) {
		echo "<script>window.location='index.php?page=pengeluaran&success=tambah-data'</script>";
	 }else{
		echo "GAGAL DISIMPAN";
	 }
 }
 
 ?>
	  <!-- <script>
   $(document).ready(function() {
    $('#table2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
	} );
	</script>
	<script>
	$(document).ready(function() {
		$('#table1').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
		} );
	} );
  </script> -->
<script>
	  $(document).ready(function() {
    $('#table1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
			{ extend: 'print',
			  messageTop: 'Laporan Pengeluaran',
			  footer: true },
			{ extend: 'pdfHtml5',
			  messageTop: 'Laporan Pengeluaran', 
			  footer: true }
			// { extend: 'excelHtml5', footer: true },
        ]
    } );
} );
  </script>
  <script>
	  $(document).ready(function() {
    $('#table2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
			{ extend: 'print',
			  messageTop: 'Laporan Pengeluaran',
			  footer: true },
			{ extend: 'pdfHtml5',
			  messageTop: 'Laporan Pengeluaran', 
			  footer: true }
			// { extend: 'excelHtml5', footer: true },
        ]
    } );
} );
  </script>
	<!-- <script>
	var rupiah = document.getElementById("rupiah");
rupiah.addEventListener("keyup", function(e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  rupiah.value = formatRupiah(this.value);
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? + rupiah : "";
}

</script> -->

