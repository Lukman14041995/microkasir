<?php 
	@ob_start();
	session_start();

		 if(!empty($_SESSION['admin'])){
			require 'config.php';
			include $view;
			$lihat = new view($config);
			$toko = $lihat -> toko();
			//  admin
				include 'admin/template/header.php';
				include 'admin/template/sidebar.php';
					if(!empty($_GET['page'])){
						include 'admin/module/'.$_GET['page'].'/index.php';
					}
					else{
						include 'admin/template/home.php';
					}
				include 'admin/template/footer.php';
			// end admin
		}elseif (!empty($_SESSION['kasir'])) {
			require 'config.php';
			include $view;
			$lihat = new view($config);
			$toko = $lihat -> toko();
			// kasir
				include 'kasir/template/header.php';
				include 'kasir/template/sidebar.php';
					if (!empty($_GET['page'])) {
						include 'kasir/module/'.$_GET['page'].'/index.php';
					}else {
						include 'kasir/template/home.php';
					}
				include 'kasir/template/footer.php';
			// end kasir
		}elseif (!empty($_SESSION['superuser'])) {
			require 'config.php';
			include $view;
			$lihat = new view($config);
			$toko = $lihat -> toko();
			// superuser
				include 'users/template/header.php';
				include 'users/template/sidebar.php';
					if (!empty($_GET['page'])) {
						include 'users/module/'.$_GET['page'].'/index.php';
					}else {
						include 'users/template/home.php';
					}
					include 'users/template/footer.php';
			// end superuser
		}else{
			echo "<script>
			alert('User ID dan Password tidak cocok');
			window.location='login.php';</script>";
		}
?>

