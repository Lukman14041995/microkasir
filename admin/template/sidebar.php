   
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
<?php 
  $id = $_SESSION['admin']['id_member'];
  $hasil_profil = $lihat -> member_edit($id);
?>
      <aside class="left-sidebar" data-sidebarbg="skin5" style="position: fixed;">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="pt-4">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span
                                    class="hide-menu">Master </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <!-- <li class="sidebar-item"><a href="index.php?page=cabang" class="sidebar-link"><i
                                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Cabang
                                        </span></a></li> -->
                                <li class="sidebar-item"><a href="index.php?page=input_barang" class="sidebar-link"><i
                                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Input Barang
                                        </span></a></li>
                                <li class="sidebar-item"><a href="index.php?page=barang" class="sidebar-link"><i
                                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Stok Barang
                                        </span></a></li>
                                <li class="sidebar-item"><a href="index.php?page=kategori" class="sidebar-link"><i
                                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Kategori
                                        </span></a></li>
                                <li class="sidebar-item"><a href="index.php?page=user" class="sidebar-link"><i
                                            class="mdi mdi-account-edit"></i><span class="hide-menu"> User
                                        </span></a></li>
                                <li class="sidebar-item"><a href="index.php?page=userdata" class="sidebar-link"><i
                                            class="mdi mdi-note-plus"></i><span class="hide-menu"> User Data
                                        </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart-outline"></i><span
                                    class="hide-menu">Transaksi </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <!-- <li class="sidebar-item"><a href="index.php?page=jual" class="sidebar-link"><i
                                            class="mdi mdi-cart-plus"></i><span class="hide-menu"> Transaksi Jual
                                        </span></a></li> -->
                                <li class="sidebar-item"><a href="index.php?page=pengeluaran" class="sidebar-link"><i
                                            class="mdi mdi-cart-outline"></i><span class="hide-menu"> Pengeluran Toko
                                            </span></a></li>
                                <li class="sidebar-item"><a href="index.php?page=laporan" class="sidebar-link"><i
                                            class="mdi mdi-book"></i><span class="hide-menu"> Laporan Penjualan
                                            </span></a></li>
                                <li class="sidebar-item"><a href="index.php?page=today" class="sidebar-link"><i
                                            class="mdi mdi-book"></i><span class="hide-menu"> Penjualan Hari Ini
                                            </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-database"></i><span class="hide-menu">Database</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="index.php?page=backup" class="sidebar-link"><i class="fas fa-database"></i><span class="hide-menu">Backup Database</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-settings"></i><span
                                    class="hide-menu">Setting</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="index.php?page=pengaturan" class="sidebar-link"><i
                                            class="mdi mdi-settings-box"></i><span class="hide-menu">Pengaturan Toko</span></a>
                                </li>
                                <li class="sidebar-item"><a href="index.php?page=kontak" class="sidebar-link"><i class="fas fa-address-book"></i><span class="hide-menu">Kontak</span></a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
      
