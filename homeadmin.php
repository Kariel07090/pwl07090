<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Home Admin</title>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/styleku.css">
		<link rel="stylesheet" href="bootstrap533/css/bootstrap.min.css">
		<script src="bootstrap533/js/bootstrap.js"></script>
		<script src="bootstrap533/jquery/jquery-3.3.1.js"></script>

</head>
<body>
<?php
//memanggil file berisi fungsi2 yang sering dipakai
require "fungsi.php";
require "head.html";

//cek logout
if (!isset($_SESSION['username'])){
	header("location:index.php");
	exit;
}
?>
<div class="utama">
	<br><br>
	<h1 class="text-center">Selamat Datang di Halaman Administrator saudara <?php echo strtoupper($_SESSION['username'])?></h1>
</div>
</body>
</html>	