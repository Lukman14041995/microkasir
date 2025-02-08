 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php 
		  $id = $_SESSION['admin']['id_member'];
		  $hasil = $lihat -> member_edit($id);
      ?>
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-12 main-chart">
						<div class="row">
                            <div class="col-md-6">
                                <div class="white-box" style="padding : 5px; border: 1px solid black">
                                <h3>Backup Database</h3>
                                <a href="export.php" class="btn btn-primary">Download File Database</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>File Database (*.sql)</h3>
                                <form action="" method="post">
                                <div class="form-group">
                                <input type="file" class="form-control" name="database">
                            </div>
                            <button type="submit" class="btn btn-danger" style="margin-top: 10px">Restore Database</button>
                                </form>
                            </div>
                        </div>
					</div>
					<div class="clearfix"></div>
				  </div>
              </div>
          </section>
      </section>
   
