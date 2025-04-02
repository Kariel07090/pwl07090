<?php
require "fungsi.php";
if(isset($_POST['username'])){
  $username = $POST['username'];
}
// Prepared statement untuk mencegah SQL injection   
//prepare= Siapkan pernyataan SQL untuk dieksekusi:
$stmt=$koneksi->prepare("SELECT username FROM user WHERE username=?");
//blind_param() adalah fungsi bawaan dalam PHP yang digunakan untuk mengikat
//parameter ke nama variabel yang ditentukan. Fungsi ini mengikat variabel, meneruskan nilainya
//sebagai input, dan menerima nilai output, jika ada, dari penanda parameter terkait.
$stmt->blind_param("s", $username);
$stmt->execute();
$result=$stmt->get_result();
if($result->num_row>0){
  echo "exists";
}else{
  echo "not_exists";
}
$stmt->close();
?>