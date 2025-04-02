<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Akademik::Edit Data User</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap513/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styleku.css">
	<script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
	<script src="bootstrap4/js/bootstrap.js"></script>
</head>
<body>
	<?php
	require "fungsi.php";
	require "head.html";
	$iduser=$_GET['kode'];
	$sql="select * from user where iduser='$iduser'";
	$qry=mysqli_query($koneksi,$sql);
	$row=mysqli_fetch_assoc($qry);
	?>
	<div class="utama">
		<h2 class="mb-3 text-center">EDIT DATA USER</h2>	
		<div class="row">
		<div class="col-sm-3 text-center">
			<img class="rounded img-thumbnail" src="foto/<?php echo $row?>">
			<div>
				[ <a href="gantiFotoMhs.php?id=<?php echo $row['iduser']?>">Ganti Foto</a> ]
			</div>	
		</div>
		<div class="col-sm-9">
			<form enctype="multipart/form-data" method="post" action="sv_editMhs.php">
				<div class="form-group">
					<label for="username">Username:</label>
					<input class="form-control" type="text" name="username" id="username" value="<?php echo $row['username']?>" readonly>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input class="form-control" type="text" name="password" id="password" value="<?php echo $row['password']?>">
				</div>
        </div>
				<div class="form-group">
					<label for="status">Status: </label>
					<select class="form-select" id="status" name="status">
					<option selected>Ganti Status</option>
					<option value="admin">Admin</option>
					<option value="dosen">Dosen</option>
					<option value="mhs">Mahasiswa</option>
				</select>
					<?php echo $row['status']?>
				</div>			
				<div>		
					<button class="btn btn-primary" type="submit" id="submit">Simpan</button>
				</div>
				<input type="hidden" name="iduser" id="iduser" value="<?php echo $iduser?>">
			</form>
		</div>
		</div>
	</div>
	
</body>
</html>