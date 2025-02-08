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
						  <h5>Data Laporan Pejualan Hari Ini, <?php echo date('j F Y, G:i') ?>
						</h5>
						<br/>
						<!-- view barang -->	
						<div class="table-responsive">
							<table class="table table-bordered"  id="table2">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th> No</th>
										<th> Nama Barang</th>
										<th> Banyaknya</th>
                                        <th>Jenis</th>
										<th> Harga Satuan</th>
										<th> Jumlah</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1;
									//  $hasil = $lihat -> pengeluaran();?>
									<?php 
										// foreach($hasil as $isi){ 
                                    require "konfig.php";
                                    $no=1;
									$id = $_SESSION['admin']['id_cabang'];
									require "konfig.php";
									$date =  date('Y-m-d');
                                    $sql =mysqli_query($koneksi, "SELECT nota.id_barang, SUM(nota.jumlah) as jumlah,nota.total, barang_name.id_barang,barang_name.id_kat, barang_name.nama_barang, barang_name.harga_jual,kategori_brg.nama_kat
                                    FROM nota
                                    INNER JOIN barang_name ON nota.id_barang = barang_name.id_barang
                                    INNER JOIN kategori_brg ON barang_name.id_kat = kategori_brg.idbrg
                                    WHERE nota.periode like '%". $date ."%' GROUP BY nota.id_barang");
                                    while ($a = mysqli_fetch_array($sql)) {
                                        $jumlah += $a['jumlah'];
                                        $total = $a['jumlah'] * $a['harga_jual'];
                                        $bigtot += $total;
									?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $a['nama_barang'];?></td>
										<td><?php echo $a['jumlah'];?></td>
                                        <td><?php echo $a['nama_kat']?></td>
										<td>Rp. <?php echo number_format($a['harga_jual'])?>,-</td>
										<td>Rp. <?php echo number_format($total)?>,-</td>
									</tr>
									<?php $no++; }?>
									<?php $hasil = $lihat -> jml_pengeluaran(); ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4" style="background:#ddd"></th>
										<th>Total </td>
										<!-- <th></td> -->
										<th>Rp.<?php echo number_format($bigtot) ;?>,-</td>
									</tr>
								</tfoot>
							</table>
						</div>
							<div class="clearfix" style="padding-top:5pc;"></div>
					</div> 
						 </div>
					  </div>
				  </div>
              </div>
			  <!-- tambah barang MODALS-->
		
			
			</div>

          <!-- </section> -->
      <!-- </div> -->
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
    $('#table2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
			{ extend: 'print',
			  messageTop: 'Laporan Penjualan Hari Ini',
			  footer: true },
			{ extend: 'pdfHtml5',
			  messageTop: 'Laporan Penjualan Hari Ini', 
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

