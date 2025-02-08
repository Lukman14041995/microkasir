<html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
</html>
<?php
	session_start();
	session_destroy();
	echo "<script>Swal.fire(
		'Anda Telah Logout',
		'',
		'success'
	);window.setTimeout(function(){ 
		window.location.href='login.php';
	   } ,900); 
	</script>";
?>
