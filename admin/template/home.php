 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-9">
					<div class="row" style="margin-left:1pc;margin-right:1pc;">
				  <h1>DASHBOARD</h1>
				  <hr>
				   
				  <?php 
						$sql = "select * from barang where stok <= 3";
						$row = $config -> prepare($sql);
						$row -> execute();
						$r = $row -> fetchAll();
						foreach($r as $q){
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
				  <?php 
						$sql = "SELECT * FROM barang WHERE tgl_expired <= now()";
						$row = $config -> prepare($sql);
						$row -> execute();
						$r = $row -> fetchAll();
						foreach($r as $q){
					?>	
					<?php
							echo "
							<div class='alert alert-warning'>
								<span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $q['nama_barang']."</a>  / <span style='color:red'> ID ". $q['id_barang']."</span> Kadaluarsa .  !! Pada tanggal <a style='color:red'>". $q['tgl_expired'] ."</a>, Sisa Stok <a style='color:red'>". $q['stok'] ."</a>
								<span class='pull-right'><a href='fungsi/hapus/hapus.php?barang=hapus&id=". $q['id_barang'] . "'>OK</a></span>
							</div>
							";	
						}
					?>
	<?php 
	// lihat
	$hasil_barang = $lihat -> barang_row();
	$hasil_kategori = $lihat -> kategori_row();
	$stok = $lihat -> barang_stok_row();
	$jual = $lihat -> jual_row();
	$total = $lihat -> total_row();
	$nota = $lihat -> jumlah_nota(); 
	$pengeluaran = $lihat -> jml_pengeluaran(); 
	$barang_stok = $lihat -> barang_stok();
	$barang_nama = $lihat -> barang_nama();
	$pengeluaran_nominal = $lihat -> pengeluaran_nominal();
	$pengeluaran_tanggal = $lihat -> pengeluaran_tanggal();
	$transaksi_totsemua = $lihat -> transaksi_totsemua();
	$barang = $lihat -> barang();
	
	$tgl_input = $barang['tgl_input'];
	$tgl_expired = $barang['']

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
							<h4 >Chart Transaksi </h4>
							<canvas id="transaksi"></canvas>
						</div>		
					</div>

                    <div class="row">
                      <!--STATUS PANELS -->
                      	<div class="col-md-3">
                      		<div class="panel panel-primary">
                      			<div class="panel-heading">
						  			<h5><i class="fa fa-desktop"></i> Nama Barang</h5>
                      			</div>
                      			<div class="panel-body">
									<center><h1><?php echo $hasil_barang;?></h1></center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=barang'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></h4>
								</div>
	                      	</div><!--/grey-panel -->
                      	</div><!-- /col-md-3-->
                      <!-- STATUS PANELS -->
                      	<div class="col-md-3">
                      		<div class="panel panel-success">
                      			<div class="panel-heading">
						  			<h5><i class="fa fa-desktop"></i> Stok Barang</h5>
                      			</div>
                      			<div class="panel-body">
									<center><h1><?php echo $stok['jml'];?></h1></center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=barang'>Tabel Barang  <i class='fa fa-angle-double-right'></i></a></h4>
								</div>
	                      	</div><!--/grey-panel -->
                      	</div><!-- /col-md-3-->
                      <!-- STATUS PANELS -->
                      	<div class="col-md-3">
                      		<div class="panel panel-info">
                      			<div class="panel-heading">
						  			<h5><i class="fa fa-desktop"></i> Telah Terjual</h5>
                      			</div>
                      			<div class="panel-body">
									<center><h1><?php echo $jual['stok'];?></h1></center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:15px;font-weight:700;font-weight:700;"><a href='index.php?page=laporan'>Tabel laporan  <i class='fa fa-angle-double-right'></i></a></h4>
								</div>
	                      	</div><!--/grey-panel -->
                      	</div><!-- /col-md-3-->
                      	<div class="col-md-3">
                      		<div class="panel panel-danger">
                      			<div class="panel-heading">
						  			<h5><i class="fa fa-desktop"></i> Kategori Barang</h5>
                      			</div>
                      			<div class="panel-body">
									<center><h1><?php echo $hasil_kategori;?></h1></center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=kategori'>Tabel Kategori  <i class='fa fa-angle-double-right'></i></a></h4>
								</div>
	                      	</div><!--/grey-panel -->
                      	</div><!-- /col-md-3-->
                      	<div class="col-md-3">
                      		<div class="panel panel-success">
                      			<div class="panel-heading">
						  			<h5><i class="fa fa-desktop"></i> Total Penghasilan </h5>
                      			</div>
                      			<div class="panel-body">
									<center><h3>Rp.<?php echo number_format($nota['bayar']);?>,-</h3></center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:13px;font-weight:700;"><a href='index.php?page=laporan'>Tabel Penghasilan  <i class='fa fa-angle-double-right'></i></a></h4>
								</div>
	                      	</div><!--/grey-panel -->
                      	</div><!-- /col-md-3-->
                      	<div class="col-md-3">
                      		<div class="panel panel-danger">
                      			<div class="panel-heading">
						  			<h5><i class="fa fa-desktop"></i> Akhir Penghasilan </h5>
                      			</div>
                      			<div class="panel-body">
								  <?php 
								  
								 $akhir = $nota['bayar'] - $pengeluaran['pay'];

								  ?>
									<center><h3>Rp.<?php echo number_format($akhir);?>,-</h3></center>
								</div>
								<div class="panel-footer">
									<!-- <h4 style="font-size:13px;font-weight:700;"><a href='index.php?page=pengeluaran'>Tabel Penghasilan  <i class='fa fa-angle-double-right'></i></a></h4> -->
								</div>
	                      	</div><!--/grey-panel -->
                       	</div><!-- /col-md-3-->
                      	<div class="col-md-3">
                      		<div class="panel panel-info">
                      			<div class="panel-heading">
						  			<h5><i class="fa fa-desktop"></i> Total Pengeluaran </h5>
                      			</div>
                      			<div class="panel-body">
									<center><h3>Rp.<?php echo number_format($pengeluaran['pay']);?>,-</h3></center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:13px;font-weight:700;"><a href='index.php?page=pengeluaran'>Tabel Pengeluaran  <i class='fa fa-angle-double-right'></i></a></h4>
								</div>
	                      	</div><!--/grey-panel -->
                       	</div><!-- /col-md-3-->
						  
					</div>
				</div>
           </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
			<div class="col-lg-3 ds">
				<div id="calendar" class="mb">
					<div class="panel green-panel no-margin">
						<div class="panel-body">
							<div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
								<div class="arrow"></div>
								<h3 class="popover-title" style="disadding: none;"></h3>
								<div id="date-popover-content" class="popover-content"></div>
							</div>
							<div id="my-calendar"></div>
						</div>
					</div>
				</div>	<!-- / calendar -->
			</div>
		  </div><! --/row -->
		 <div class="clearfix" style="padding-top:18%;"></div>
	  </section>
  </section>

<script  type="text/javascript">
  var ctx = document.getElementById("barang").getContext("2d");
  var data = {
            labels: [<?php foreach ($barang_nama as $bn) {
               echo '"' . $bn['nama_barang'] . '",';
               }?>],
            datasets: [
            {
              label: "Stok Barang",
              data: [<?php foreach ($barang_stok as $bs) { echo '"' . $bs['stok'] . '",';}?>],
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
  var ctx = document.getElementById("pengeluaran").getContext("2d");
  var data = {
            labels: [<?php foreach ($pengeluaran_nominal as $bn) {
               echo '"' . $bn['periode'] . '",';
               }?>],
            datasets: [
            {
              label: "Pengeluaran Barang",
              data: [<?php foreach ($pengeluaran_nominal as $bs) { echo '"' . $bs['nominal'] . '",';}?>],
			//   borderColor : ['orange'],
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
  var ctx = document.getElementById("transaksi").getContext("2d");
  var data = {
            labels: [<?php foreach ($transaksi_totsemua as $bn) {
               echo '"' . $bn['bulan'] . '",';
               }?>],
            datasets: [
            {
              label: "Total Transaksi",
              data: [<?php foreach ($transaksi_totsemua as $bs) { 
				  
				  echo '"' . $bs['totalsemua'] . '",';}?>],
			//   borderColor : ['orange'],
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