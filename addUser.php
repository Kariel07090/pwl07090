<!DOCTYPE html>
<html>
	<head>
		<title>Sistem Informasi User</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/styleku.css">
		<link rel="stylesheet" href="bootstrap533/css/bootstrap.min.css">
		<script src="bootstrap533/js/bootstrap.js"></script>
		<script src="bootstrap533/jquery/jquery-3.3.1.js"></script>
	</head>
	<style>
		.error{
			color:red;
			font-size: 0.9em;
			display: none;
		}
		#nim{
			width:150px;
		}
		#ajaxRespone{
			margin-top: 15px;
		}
	</style>
	<script>
		$(document).ready(function(){
			//membuat fungsi untuk mengecek NIM pada tabel mhs di database akademik
			function checkNIMExist(nim){
				$.ajax({
					//memanggil file cek_data_kembar.php
					url:'cekDataKembarUser.php',
					type:'POST',
					data:{
						nim: nim
					},
					success: function(response){
						if(response === 'exists'){
							showError("* Data sudah ada, silahkan isikan yang lain");
							$("#username").val("").focus();
							return false;
						}else{
							hideError();
							$("#username").focus();
						}
					}
				});
			}
		function validateUsername(){
			var username = $("#username").val();
			var errorMsg = "";
			//cek apakah username kosong
			if(nim.trim()===""){
				errorMsg = "*username tidak boleh kosong!";
				showError(errorMsg);
				return false;
			}
			return true;
		}
		function showError(message){
			$("#usernameError").text(message).show();
		}
		function hideError(){
			$("#usernameError").hide();
		}
		//event listeners
		$("#username").on("blur",function(){
			if (validateUsername()){
				checkUsernameExist($(this).val());
			}
		}).on("keypress", function(event){
			if(event.which === 13){
				event.preventDefault();
				if(validateUsername()){
					checkUsernameExist($(this).vall());
				}
			}
		}).on("input", function(){
			formatUsername(this);
			hideError();
		});
		//form submission with AJAX
		$("userform").on("submit",function(event){
			//Menghentikan perilaku submit form standar
			//Memungkinkan proses submit data melalui JavaScript event.presentDefault();
			event.preventDefault();
			//Memastikan NIM valid sebelum mengirim data ke server
			if(!validateNIM()){
				return false;
			}
			//Membuat Objek FormData untuk menangkap semua data form
			var formData = new FormData(this);
			$.ajax({
				//memanggil file sv_addMhs.php
				url:'sv_addUser.php',
				type:'POST',
				data:formData,
				//untuk mendukung upload file
				processData: false,
				contentType: false,
				success: function(response){
					$("*#ajaxResponse").html(response);
				},
				error: function(){
					$("#ajaxResponse").html("terjadi kesalahan saat mengirim data.");
				}
			});
			});
		});
	</script>
	<body>
		<?php
			require "head.html";
		?>
		<div class="utama">		
			<br><br><br>		
			<h3>TAMBAH DATA USER</h3>
      <form id="UserForm" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="username">Username:</label>
				<input class="form-control" type="username" name="username" id="username" required>
			</div> 
			<div class="form-group">
				<label for="password">Password:</label>
				<input class="form-control" type="password" name="password" id="password" required>
			</div>
			<div class="form-group">
				<label for="status">Status:</label>
				<select class="form-select" id="status" name="status">
					<option selected>Pilih Status</option>
					<option value="admin">Admin</option>
					<option value="dosen">Dosen</option>
					<option value="mhs">Mahasiswa</option>
				</select>
			</div>
			<div class="form-group">
				<label for="foto">Foto</label>
				<input class="form-control" type="file" name="foto" id="fotoUser">
			</div>
			<br>
			<div>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</form>
    <div id="ajaxResponse"></div>
		</div>
	</body>
</html>