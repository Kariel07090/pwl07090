<?php
    //memanggil file pustaka fungsi
    require "fungsi.php";

    //memindahkan data kiriman dari form ke var biasa
    $iduser=$_GET["kode"];

    $sql=$koneksi->query("select * from user where iduser='$iduser'");
    $data=$sql->fetch_assoc();
    $foto=$data['foto'];
  
    if (file_exists("foto/$foto")){
    unlink("foto/$foto");
    }
    $sql=$koneksi->query("select * from user where iduser='$iduser'");
    //membuat query hapus data
    $sql="delete from user where iduser=$iduser";
    mysqli_query($koneksi,$sql);
    header("location:updateUser.php");
?>