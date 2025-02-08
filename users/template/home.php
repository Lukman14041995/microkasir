    <!-- <div class="page-breadcrumb"> -->
    <!-- <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Tables</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>
                </div>
            </div>
    </div> -->
    <!-- </div> -->
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <?php 
        require "konfig.php";
        $id = $_SESSION['superuser']['id_cabang'];
        $query_barang = mysqli_query($koneksi, "SELECT * from barang WHERE id_cabang = '$id' ");
        $hasil_barang = mysqli_num_rows($query_barang);
        $query_stok = mysqli_query($koneksi, "SELECT SUM(stok) as jml FROM barang WHERE id_cabang = '$id' ");
        $stok = mysqli_fetch_array($query_stok);
        $query_jumlah = mysqli_query($koneksi, "SELECT SUM(nota.jumlah) AS jumlah, transaksi.id_cabang FROM nota INNER JOIN transaksi ON nota.invoice = transaksi.invoice WHERE transaksi.id_cabang = '$id'");
        $jual = mysqli_fetch_array($query_jumlah);
        $query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
        $hasil_kategori = mysqli_num_rows($query_kategori);	
        $query_transaksi = mysqli_query($koneksi, "SELECT SUM(totalsemua) as total FROM transaksi WHERE id_cabang = '$id' ");
        $nota = mysqli_fetch_assoc($query_transaksi);
        $query_pengeluaran = mysqli_query($koneksi, "SELECT SUM(nominal) as nominal FROM pengeluaran WHERE id_cabang = '$id'");
        $pengeluaran = mysqli_fetch_assoc($query_pengeluaran);
        
    ?>
    <!-- <div class="container-fluid"> -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body b-l calender-sidebar">
                    <?php 
					require "konfig.php";
					$id = $_SESSION['superuser']['id_cabang'];
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
					?>
                        <div class="row">
                            <div class="col-md-6">
                                <h4 >Chart Barang </h4>
                                <canvas id="barang"></canvas>
                            </div>		
                            <div class="col-md-6">
                                <h4 >Chart Pengeluaran </h4>
                                <canvas id="pengeluaran"></canvas>
                            </div>	
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mt-5">Chart Transaksi </h4>
                                <canvas id="transaksi"></canvas>
                            </div>		
                        </div>
                        <div class="row mt-5">
                            <!--STATUS cardS -->
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header text-white bg-dark">
                                        <h5><i class="fa fa-desktop"></i> Nama Barang</h5>
                                    </div>
                                    <div class="card-body">
                                        <center><h1><?php echo $hasil_barang;?></h1></center>
                                    </div>
                                    <div class="card-footer">
                                        <h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=barang'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></h4>
                                    </div>
                                </div><!--/grey-card -->
                            </div><!-- /col-md-3-->
                            <!-- STATUS cardS -->
                            <div class="col-md-3">
                                <div class="card ">
                                    <div class="card-header text-white bg-primary">
                                        <h5><i class="fa fa-desktop"></i> Stok Barang</h5>
                                    </div>
                                    <div class="card-body">
                                        <center><h1><?php echo $stok['jml'];?></h1></center>
                                    </div>
                                    <div class="card-footer">
                                        <h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=barang'>Tabel Barang  <i class='fa fa-angle-double-right'></i></a></h4>
                                    </div>
                                </div><!--/grey-card -->
                            </div><!-- /col-md-3-->
                            <!-- STATUS cardS -->
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header text-white bg-info">
                                        <h5><i class="fa fa-desktop"></i> Telah Terjual</h5>
                                    </div>
                                    <div class="card-body">
                                        <center><h1><?php echo $jual['jumlah'];?></h1></center>
                                    </div>
                                    <div class="card-footer">
                                        <h4 style="font-size:15px;font-weight:700;font-weight:700;"><a href='index.php?page=laporan'>Tabel laporan  <i class='fa fa-angle-double-right'></i></a></h4>
                                    </div>
                                </div><!--/grey-card -->
                            </div><!-- /col-md-3-->
                            <div class="col-md-3">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h5><i class="fa fa-desktop"></i> Kategori Barang</h5>
                                    </div>
                                    <div class="card-body">
                                        <center><h1><?php echo $hasil_kategori;?></h1></center>
                                    </div>
                                    <div class="card-footer">
                                        <h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=kategori'>Tabel Kategori  <i class='fa fa-angle-double-right'></i></a></h4>
                                    </div>
                                </div><!--/grey-card -->
                            </div><!-- /col-md-3-->
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header text-white bg-success">
                                        <h5><i class="fa fa-desktop"></i> Total Penghasilan </h5>
                                    </div>
                                    <div class="card-body">
                                        <center><h3>Rp.<?php echo number_format($nota['total']);?>,-</h3></center>
                                    </div>
                                    <div class="card-footer">
                                        <h4 style="font-size:13px;font-weight:700;"><a href='index.php?page=laporan'>Tabel Penghasilan  <i class='fa fa-angle-double-right'></i></a></h4>
                                    </div>
                                </div><!--/grey-card -->
                            </div><!-- /col-md-3-->
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header text-white bg-warning">
                                        <h5><i class="fa fa-desktop"></i> Akhir Penghasilan </h5>
                                    </div>
                                    <div class="card-body">
                                    <?php 
                                    
                                    $akhir = $nota['total'] - $pengeluaran['nominal'];

                                    ?>
                                        <center><h3>Rp.<?php echo number_format($akhir);?>,-</h3></center>
                                    </div>
                                    <div class="card-footer">
                                        <!-- <h4 style="font-size:13px;font-weight:700;"><a href='index.php?page=pengeluaran'>Tabel Penghasilan  <i class='fa fa-angle-double-right'></i></a></h4> -->
                                    </div>
                                </div><!--/grey-card -->
                            </div><!-- /col-md-3-->
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header text-white bg-danger">
                                        <h5><i class="fa fa-desktop"></i> Total Pengeluaran </h5>
                                    </div>
                                    <div class="card-body">
                                        <center><h3>Rp.<?php echo number_format($pengeluaran['nominal']);?>,-</h3></center>
                                    </div>
                                    <div class="card-footer">
                                        <h4 style="font-size:13px;font-weight:700;"><a href='index.php?page=pengeluaran'>Tabel Pengeluaran  <i class='fa fa-angle-double-right'></i></a></h4>
                                    </div>
                                </div><!--/grey-card -->
                            </div><!-- /col-md-3-->		  
					 </div>
                     <div class="row mt-5">
                            <div class="col-lg-10">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->

        
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>


    <script  type="text/javascript">
<?php 
require "konfig.php";
$id = $_SESSION['superuser']['id_cabang'];
$query = mysqli_query($koneksi, "SELECT SUM(barang.stok) as stok, barang_name.nama_barang, barang_name.harga_jual, kategori.nama_kategori FROM barang INNER JOIN barang_name ON barang.id_barang = barang_name.id_barang INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori WHERE barang.id_cabang = '$id' GROUP BY barang_name.nama_barang ORDER BY barang_name.id ASC");
// $query = mysqli_query($koneksi, "SELECT nama_barang, SUM(stok) as stok FROM barang WHERE id_cabang = '$id' GROUP BY nama_barang ORDER BY id ASC");
$q = mysqli_query($koneksi, "SELECT SUM(barang.stok) as stok, barang_name.nama_barang, barang_name.harga_jual, kategori.nama_kategori FROM barang INNER JOIN barang_name ON barang.id_barang = barang_name.id_barang INNER JOIN kategori ON barang_name.id_kategori = kategori.id_kategori WHERE barang.id_cabang = '$id' GROUP BY barang_name.nama_barang ORDER BY barang_name.id ASC");
?>
  var ctx = document.getElementById("barang").getContext("2d");
  var data = {
            labels: [<?php while ($bn = mysqli_fetch_array($query)) {
               echo '"' . $bn['nama_barang'] . '",';
               }?>],
            datasets: [
            {
              label: "Stok",
              data: [<?php while ($bs = mysqli_fetch_array($q)) { echo '"' . $bs['stok'] . '",';}?>],
              backgroundColor: ' rgb(0, 162, 255)',
              borderColor: ' rgb(0, 162, 255)',
            }
            ],
			
            };

  var myBarChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
            legend: {
              display: false
            },
            barValueSpacing: 20,
            scales: {
              yAxes: [{
                  ticks: {
                      min: 0,
                  }
              }],
              xAxes: [{
                          gridLines: {
                              color: "rgba(0, 0, 0, 0)",
                          }
                      }]
              }
          }
        });
</script>

<script  type="text/javascript">

<?php 
require "konfig.php";
$id = $_SESSION['superuser']['id_cabang'];
$query = mysqli_query($koneksi, "SELECT periode, SUM(nominal) AS nominal FROM pengeluaran WHERE id_cabang = '$id' GROUP BY periode ORDER BY id ASC");
$q = mysqli_query($koneksi, "SELECT periode, SUM(nominal) AS nominal FROM pengeluaran WHERE id_cabang = '$id' GROUP BY periode ORDER BY id ASC");
?>

  var ctx = document.getElementById("pengeluaran").getContext("2d");
  var data = {
            labels: [<?php while ($bn = mysqli_fetch_array($query)) {
               echo '"' . $bn['periode'] . '",';
               }?>],
            datasets: [
            {
              label: "Pengeluaran",
              data: [<?php while ($bs = mysqli_fetch_array($q)) { echo '"' . $bs['nominal'] . '",';}?>],
			  backgroundColor: 'rgb(255, 0, 0)',
              borderColor: 'rgb(255, 0, 0)',
            }
            ],
			
            };

  var myBarChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
            legend: {
              display: false
            },
            barValueSpacing: 20,
            scales: {
              yAxes: [{
                  ticks: {
                      min: 0,
                  }
              }],
              xAxes: [{
                          gridLines: {
                              color: "rgba(0, 0, 0, 0)",
                          }
                      }]
              }
          }
        });
</script>

<script  type="text/javascript">
<?php 
require "konfig.php";
$id = $_SESSION['superuser']['id_cabang'];
$query = mysqli_query($koneksi, "SELECT bulan, SUM(totalsemua) AS totalsemua FROM transaksi WHERE id_cabang = '$id' GROUP BY bulan ORDER BY id asc");
$q = mysqli_query($koneksi, "SELECT transaksi.bulan, SUM(transaksi.totalsemua) AS totalsemua, bulan.nama_bulan, bulan.id FROM transaksi INNER JOIN bulan ON transaksi.bulan = bulan.nama_bulan WHERE transaksi.id_cabang = '1' GROUP BY transaksi.bulan ORDER BY bulan.id asc");


?>
  var ctx = document.getElementById("transaksi").getContext("2d");
  var data = {
            labels: [<?php while ($bn = mysqli_fetch_array($q)) {
               echo '"' . $bn['bulan'] . '",';
               }?>],
            datasets: [
            {
              label: "Total Transaksi",
              data: [<?php while ($bs = mysqli_fetch_array($query)) { 
				  
				  echo '"' . $bs['totalsemua'] . '",';}?>],
			  backgroundColor: 'rgb(4, 236, 4)',
              borderColor: 'rgb(4, 236, 4)',
            }
            ],
			
            };

  var myBarChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
            legend: {
              display: false
            },
            barValueSpacing: 20,
            scales: {
              yAxes: [{
                  ticks: {
                      min: 0,
                  }
              }],
              xAxes: [{
                          gridLines: {
                              color: "rgba(0, 0, 0, 0)",
                          }
                      }]
              }
          }
        });
</script>