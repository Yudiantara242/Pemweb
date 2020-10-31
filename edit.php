<?php
session_start();
if(!isset($_SESSION["login"])){
header("Location: login.php");
exit;
}
require 'functions.php';

$id = $_GET["id"];


$pgw = query("SELECT * FROM pegawai WHERE id_pegawai = '$id'")[0];


$conn = mysqli_connect("localhost", "root", "", "toko_online");


if(isset($_POST["submit"])){

if(ubah($_POST) > 0){
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
<title>Edit data pegawai</title>
</head>
<body>
<h1>Edit data pegawai</h1>


<form actions="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id_pegawai" value="<?= $pgw["id_pegawai"]; ?>">
<input type="hidden" name="gambarlama" value="<?= $pgw["gambar"]; ?>">
<ul>
<li>
<label for="nama_pegawai">Nama : </label>
    <input type="text" name="nama_pegawai" id="nama_pegawai" required value="<?= $pgw["nama_pegawai"]; ?>">
</li>
<li>
<label for="alamat_pegawai">Alamat : </label>
    <input type="text" name="alamat_pegawai" id="alamat_pegawai" required value="<?= $pgw["alamat_pegawai"]; ?>">
</li>
<li>
<label for="notelp_pegawai">Nomor Telepon : </label>
    <input type="text" name="notelp_pegawai" id="notelp_pegawai" required value="<?= $pgw["notelp_pegawai"]; ?>">
</li>
<li>
<label for="jabatan">Jabatan : </label>
    <input type="text" name="jabatan" id="jabatan" required value="<?= $pgw["jabatan"]; ?>">
</li>
<li>
<label for="jabatan">Gambar : </label>
    <img src="img/<?= $pgw['gambar']; ?>">
    <input type="file" name="gambar" id="gambar">
</li>
<li>
<button type="submit" name="submit">ubah</button>
</li>
</ul>

</form>

