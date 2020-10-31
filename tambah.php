<?php
session_start();
if(!isset($_SESSION["login"])){
header("Location: login.php");
exit;
}
require 'functions.php';
$conn = mysqli_connect("localhost", "root", "", "toko_online");


if(isset($_POST["submit"])){

if(tambah($_POST) > 0){
    echo "
    <script>
        alert('berhasil');
        document.location.href = 'index.php';
    </script>
    ";
}else{
    echo "
    <script>
    alert('gagal');
    document.location.href = 'index.php';
   </script>
   ";
}

}

?>




<!DOCTYPE html>
<html>
<head>
<title>Tambah data pegawai</title>
</head>
<body>
<h1>Tambah data pegawai</h1>


<form actions="" method="post" enctype="multipart/form-data">
<ul>
<li>
<label for="id_pegawai">ID Pegawai : </label>
    <input type="text" name="id_pegawai" id="id_pegawai" required>
</li>
<li>
<label for="nama_pegawai">Nama : </label>
    <input type="text" name="nama_pegawai" id="nama_pegawai" required>
</li>
<li>
<label for="alamat_pegawai">Alamat : </label>
    <input type="text" name="alamat_pegawai" id="alamat_pegawai" required>
</li>
<li>
<label for="notelp_pegawai">Nomor Telepon : </label>
    <input type="text" name="notelp_pegawai" id="notelp_pegawai" required>
</li>
<li>
<label for="jabatan">Jabatan : </label>
    <input type="text" name="jabatan" id="jabatan" required>
</li>
<li>
<label for="jabatan">Gambar : </label>
    <input type="file" name="gambar" id="gambar">
</li>
<li>
<button type="submit" name="submit">Tambah</button>
</li>
</ul>

</form>

