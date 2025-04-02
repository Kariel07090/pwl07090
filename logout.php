<?php
	// Mulai session
	session_start();

	// Menghilangkan semua variabel yang telah dimasukkan
	session_unset();

	// Mengakhiri session
	session_destroy();
	header("location:index.php");
	exit();
?>