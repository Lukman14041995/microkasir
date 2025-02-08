 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <div id="main-content">
          <!-- <section class="wrapper"> -->

              <div class="row">
                  <div class="col-lg-12 main-chart">
					<div class="card">
 						<div class="card-body">
						 <h3>Data Barang</h3>
						<br/>
						<?php if(isset($_GET['success-stok'])){?>
						<div class="alert alert-success">
							<p>Tambah Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Tambah Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['edit'])){?>
						<div class="alert alert-success">
							<p>Update Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>

						<!-- <?php 
						require "konfig.php";
						$id = $_SESSION['admin']['id_cabang'];
						$query = mysqli_query($koneksi, "SELECT * from barang where stok <= 3 and id = '$id'");
								
								while($q = mysqli_fetch_array($query)){
							?>	
						<?php
							echo "
							<div class='alert alert-warning'>
								<span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $q['nama_barang']."</a>  / <span style='color:red'> ID ". $q['id_barang']."</span> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!
								<span class='pull-right'><a href='index.php?page=barang'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
							</div>
							";	
						}
						?> -->
						
						<!-- Trigger the modal with a button -->
						<button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#exampleModal">
							<i class="fa fa-plus"></i> Insert Data</button>
						<div class="clearfix"></div>
						<br/>
						<!-- view barang -->	
						<div class="table-responsive">
							<table id="example" class="table table-bordered">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th>No.</th>
										<th>ID Barang</th>
										<th>Nama Barang</th>
										<th>Kategori</th>
										<th>Jenis</th>
										<th>Harga Jual</th>
										<th>Diskon</th>
										<th>Total</th>
										<!-- <th>Tanggal Input</th> -->
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>

								<?php 
									$id = $_SESSION['admin']['id_cabang'];
									require "konfig.php";
									$query = mysqli_query($koneksi, "SELECT barang_name.*,kategori.nama_kategori, kategori_brg.nama_kat
									FROM barang_name 
									INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori
									INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
									WHERE barang_name.id_cabang = '$id' ORDER BY barang_name.id_barang asc ");
									$no= 0;
									while ($isi = mysqli_fetch_array($query)) {
										$no++;
								?>
									<tr>
										<td><?php echo $no ;?></td>
										<td><?php echo $isi['id_barang'];?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo $isi['nama_kategori'];?></td>
										<td><?php echo $isi['nama_kat']?></td>
										<td><?php echo "Rp " . number_format($isi['harga_jual']);?> ,-</td>
										<td><?php echo $isi['disc'] ?>%</td>
										<?php 
										$rumus = $isi['harga_jual'] * $isi['disc']/100;
										$diskon = $isi['harga_jual'] - $rumus;
										?>
										<td>Rp.<?php echo number_format($diskon) ?> ,-</td>
										<!-- <td> <?php echo $isi['tgl_input'];?></td> -->
										<td>
											<a href="index.php?page=input_barang/edit&barang=<?php echo $isi['id_barang'];?>"><button class="btn btn-warning btn-xs" title="Edit"><i class="mdi mdi-lead-pencil"></i></button></a>
											<a href="fungsi/hapus/hapus.php?input_barang=hapus&id=<?php echo $isi['id_barang'];?>" onclick="javascript:return confirm('Hapus Data barang ?');"><button class="btn btn-danger btn-xs" title="Hapus"><i style="color: white;" class="mdi mdi-delete"></i></button></a>
											<button class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#modal2">%</button>
										</td>
									</tr>

									<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edit Diskon</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="" method="post">
												<div class="form-group">
												<input type="hidden" value="" name="invoice">
												<label for="">Ganti Diskon</label>
												<select name="status" class="form-control" id="">
													<option value="0">0%</option>
													<option value="20">20%</option>
													<option value="50">50%</option>
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
								<?php 
									}
								?>
								</tbody>
							</table>
						</div>
						<div class="clearfix" style="margin-top:7pc;"></div>
						<!-- end view barang -->
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
								<form action="fungsi/tambah/tambah.php?barang_name=tambah" method="POST">
									<div class="modal-body">
								
										<table class="table table-striped bordered">
											
											<?php
												$id = $_SESSION['admin']['id_cabang'];
												$format = $lihat -> barang_id();
											?>
											<tr>
											<input type="hidden" value="<?php echo $id; ?>" name="id_cabang">
												<td>ID Barang</td>
												<td><input type="text" readonly="readonly" required value="<?php echo $format;?>" class="form-control"  name="id"></td>
											</tr>
											<tr>
												<td>Nama Barang</td>
												<td><input type="text" placeholder="Nama Barang" required class="form-control" name="nama"></td>
											</tr>
											<tr>
												<td>Kategori</td>
												<td>
													<select name="kategori" class="form-control" id="">
														<option value="">--pilih--</option>
														<?php 
														require "konfig.php";
														$sql = mysqli_query($koneksi, "SELECT * FROM kategori");
														while ($a = mysqli_fetch_array($sql)) {
														?>
														<option value="<?php echo $a['id_kategori'] ?>"><?php echo $a['nama_kategori'] ?></option>
														<?php } ?>
													</select>
												</td>
											</tr>
											
											<tr>
												<td>Harga Jual</td>
												<td><input type="text" placeholder="Harga Jual" required class="form-control" name="harga" id="rupiah"></td>
											</tr>
											<tr>
												<td>Tanggal Input</td>
												<td><input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
											</tr>
										</table>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert Data</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
							</div>
						</div>

						<!-- new modal -->
						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="fungsi/tambah/tambah.php?barang_name=tambah" method="post">
								<?php
									$id = $_SESSION['admin']['id_cabang'];
									$format = $lihat -> barang_id();
								?>
								<div class="modal-body">
									<input type="hidden" value="<?php echo $id; ?>" name="id_cabang">
									<div class="form-group">
										<label for="">ID Barang</label>
										<input type="text" readonly="readonly" required value="<?php echo $format;?>" class="form-control"  name="id">						
									</div>
									<div class="form-group">
										<label for="">Nama Barang</label>
										<input type="text" placeholder="Nama Barang" required class="form-control" name="nama">						
									</div>
									<div class="form-group">
										<label for="">Kategori</label>
										<select name="kategori" class="form-control" id="">
											<option value="">--pilih--</option>
											<?php 
											require "konfig.php";
											$sql = mysqli_query($koneksi, "SELECT * FROM kategori");
											while ($a = mysqli_fetch_array($sql)) {
											?>
											<option value="<?php echo $a['id_kategori'] ?>"><?php echo $a['nama_kategori'] ?></option>
											<?php } ?>
										</select>					
									</div>
									<div class="form-group">
										<label for="">Jenis Produk</label>
										<select name="jenisbrg" class="form-control" id="">
											<option value="">--pilih--</option>
											<?php 
											require "konfig.php";
											$sql = mysqli_query($koneksi, "SELECT * FROM kategori_brg");
											while ($a = mysqli_fetch_array($sql)) {
											?>
											<option value="<?php echo $a['idbrg'] ?>"><?php echo $a['nama_kat'] ?></option>
											<?php } ?>
										</select>					
									</div>
									<div class="form-group">
										<label for="">Harga Jual</label>
										<input type="text" placeholder="Harga Jual" required class="form-control" name="harga" id="rupiah">					
									</div>
									<div class="form-group">
										<label for="">Tanggal Input</label>
										<input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl">					
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Simpan</button>
								</div>
							</form>
							</div>
						</div>
						</div>
					</div>
			      </div>
              	</div>
          	<!-- </section> -->
      	</div>
		  <script>
	  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            // { extend: 'print', footer: true }
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

<?php 

require "konfig.php";
if (isset($_POST['save'])) {
	$status = $_POST['status'];
	$qu = mysqli_query($koneksi, "UPDATE barang_name SET disc = '$status' WHERE id_kategori = '11'");
	if ($qu) {
		echo "<script>window.location.href='index.php?page=input_barang'</script>";
	}
	# code...
}

?>