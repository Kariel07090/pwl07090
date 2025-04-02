<!DOCTYPE html>
<html>
	<head>
		<title>Sistem Informasi Akademik::Daftar User</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="bootstrap513/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styleku.css">
	</head>
	<body>
		<?php
			//memanggil file berisi fungsi2 yang sering dipakai
			require "fungsi.php";
			require "head.html";
			/*	---- cetak data per halaman ---------	*/
			$jmlDataPerHal = 5;
			//pencarian data
			if (isset($_POST['cari'])){
				$cari=$_POST['cari'];
				$sql="select * from user where iduser like'%$cari%' or
									nama like '%$cari%' or
									email like '%$cari%'";
			}else{
				$sql="select * from user";		
			}

			$qry = mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
			$jmlData = mysqli_num_rows($qry);

			// CEIL() digunakan untuk mengembalikan nilai integer terkecil yang lebih besar dari 
			//atau sama dengan angka.
			$jmlHal = ceil($jmlData / $jmlDataPerHal);
			if (isset($_GET['hal'])){
				$halAktif=$_GET['hal'];
			}else{
				$halAktif=1;
			}

			$awalData=($jmlDataPerHal * $halAktif)-$jmlDataPerHal;
			//Jika tabel data kosong
			$kosong=false;
			if (!$jmlData){
				$kosong=true;
			}
			//Klausa LIMIT digunakan untuk membatasi jumlah baris yang dikembalikan oleh pernyataan SELECT
			//data berdasar pencarian atau tidak
			if (isset($_POST['cari'])){
				$cari=$_POST['cari'];
				$sql="select * from user where iduser like'%$cari%' or
									username like '%$cari%' or
									status like '%$cari%'
									limit $awalData,$jmlDataPerHal";
			}else{
				$sql="select * from user limit $awalData,$jmlDataPerHal";		
			}
			//Ambil data untuk ditampilkan
			$hasil=mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
		?>
		<div class="utama">
			<h2 class="text-center">Daftar User</h2>
			<div class="text-center"><a href="prnMhsPdf.php"><span class="fas fa-print">&nbsp;Print</span></a></div>
			<span class="float-left">
				<a class="btn btn-success" href="addUser.php">Tambah Data</a>
			</span>
			<!-- pencarian dapat mengcopy dari bootstrap ambil dari navbar di modifikasi -->
			<form class="d-flex" action="" method="POST" style="float:right;">
        		<button class="btn btn-outline-success" style="background-color:green" type="submit">pencarian</button>
				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari">
      		</form>

			<br><br>
			<ul class="pagination">
				<?php
					//navigasi pagination
					//cetak navigasi back
					if ($halAktif>1){
						$back=$halAktif-1;
						//$back=$halAktif;
						echo "<li class='page-item'><a class='page-link' href=?hal=$back>&laquo;</a></li>";
					}
					//cetak angka halaman
					for($i=1;$i<=$jmlHal;$i++){
						if ($i==$halAktif){
							echo "<li class='page-item'><a class='page-link' href=?hal=$i style='font-weight:bold;color:red;'>$i</a></li>";
						}else{
							
							echo "<li class='page-item'><a class='page-link' href=?hal=$i>$i</a></li>";
						}	
					}
					//cetak navigasi forward
					if ($halAktif<$jmlHal){
						$forward=$halAktif+1;
						echo "<li class='page-item'><a class='page-link' href=?hal=$forward>&raquo;</a></li>";
					}
				?>
			</ul>	

			<!-- Cetak data dengan tampilan tabel -->
			<table class="table table-hover">
				<thead class="thead-light">
					<tr>
						<th>No.</th>
						<th>ID</th>
						<th>Username</th>
						<th>Status</th>
						<th>Foto</th>
						<th>Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						//jika data tidak ada
					if ($kosong){
					?>
						<tr><th colspan="6">
							<div class="alert alert-info alert-dismissible fade show text-center">
							Data tidak ada
							</div>
						</th></tr>
						<?php
							}else{	
								// $awalData==0, data kalau tampail di page pertama, maka 
								if($awalData==0){
									$no=$awalData+1;
								}else{
									//$no=$awalData;
									$no=$awalData+1;
								}
								while($row=mysqli_fetch_assoc($hasil)){
						?>	
						<tr>
							<td><?php echo $no?></td>
							<td><?php echo $row["iduser"]?></td>
							<td><?php echo $row["username"]?></td>
							<td><?php echo $row["status"]?></td>
							<td><img src="<?php echo "foto/".$row["foto"]?>" height="50"></td>
							<td>
								<a class="btn btn-outline-primary btn-sm" href="editUser.php?kode=<?php echo $row['id']?>">Koreksi</a>
								<a class="btn btn-outline-danger btn-sm" href="hpsUser.php?kode=<?php echo $row["id"]?>" id="linkHps" onclick="return confirm('Yakin dihapus nih?')">Hapus</a>
							</td>
						</tr>
						<?php 
							$no++;
						}
					}
						?>
				</tbody>
			</table>
		</div>
	</body>
</html>	
