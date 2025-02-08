
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--===== CSS =====-->
        <link rel="stylesheet" href="assets/css/login.css">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
        <title>Login</title>
    </head>
    <body>
        <div class="l-form">
            <form action="" method="POST" class="form">
                <!-- <img src="logo.png" alt="" style="width: 70px; margin-left: 40%;"> -->
                <h2 class="form__title">Point of Sales</h2>
                <p style="margin-top: -38px; color: grey;">Gunakan akun anda</p>
                <div class="form__div">
                    <input type="text" class="form__input" placeholder=" " name="user" autofocus>
                    <label for="" class="form__label">Username</label>
                </div>
                <div class="form__div">
                    <input type="password" class="form__input" placeholder=" " name="pass">
                    <label for="" class="form__label">Password</label>
                </div>
                <button type="submit" class="form__button" name="proses">Login</button>
            </form>
        </div>
    </body>

</html>

<?php
	@ob_start();
	session_start();
	if(isset($_POST['proses'])){
		require 'config.php';
			
		$user = strip_tags($_POST['user']);
		$pass = strip_tags($_POST['pass']);

		$sql = 'select member.*, login.user, login.pass, login.role, login.id_cabang 
				from member inner join login on member.id_member = login.id_member
				where user =? and pass = md5(?)';
		
		$row = $config->prepare($sql);
		$row -> execute(array($user,$pass));
		if ($row-> rowCount()>0) {
			$data = $row->fetch();
			if ($data['role'] == "admin") {
				$_SESSION['admin'] = $data;
				$id_cabang = $data['id_cabang'];
				// echo "<script>alert('Login Sukses');
				// 			  window.location.href='index.php';
	 			// 	  </script>";
				echo "<script>Swal.fire(
                    'Login Berhasil!',
                    '',
                    'success'
                );window.setTimeout(function(){ 
                    window.location.href='index.php';
                   } ,900); 
                </script>";
			}elseif ($data['role'] == "kasir") {
				$_SESSION['kasir'] = $data; 
				echo "<script>Swal.fire(
                    'Login Berhasil!',
                    '',
                    'success'
                );window.setTimeout(function(){ 
                    window.location.href='index.php';
                   } ,900); 
                </script>";
			}elseif ($data['role'] == "superuser") {
				$_SESSION['superuser'] = $data;
				echo "<script>Swal.fire(
                    'Login Berhasil!',
                    '',
                    'success'
                );window.setTimeout(function(){ 
                    window.location.href='index.php';
                   } ,900); 
                </script>";
			}
		}

	}
?>


