<?php
session_start();
if(!isset($_SESSION["login"])){
header("Location: login.php");
exit;
}

require 'functions.php';
 $pegawai = query("SELECT * FROM pegawai");
if(isset($_POST["cari"])){
    $pegawai = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Halaman Admin</title>
</head>
<body>
<a href="logout.php">Log out</a>
<h1>Data Pegawai</h1>

<a href="tambah.php">Tambah data pegawai</a>
<br><br>
<form action="" method="post">

    <input type="text" name="keyword" autofocus placeholder="Masukan keyword.." autocomplete="off">
    <button type="submit" name="cari">Cari</button>
</form>
<br>
<table border="1" celpadding="10" cellspacing="0">

<tr>
    <th>No.</th>
    <th>Aksi</th>
    <th>ID Pegawai</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Nomor Telepon</th>
    <th>Jabatan</th>
 
</tr>

<?php $i = 1; ?>
<?php foreach($pegawai as $row) : ?>
<tr>
<td><?= $i; ?></td>
<td>
<a href="edit.php?id=<?= $row["id_pegawai"]; ?>">Edit</a> |
<a href="hapus.php?id=<?= $row["id_pegawai"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
</td>
<td><?= $row["id_pegawai"]; ?></td>
<td><?= $row["nama_pegawai"]; ?></td>
<td><?= $row["alamat_pegawai"]; ?></td>
<td><?= $row["notelp_pegawai"]; ?></td>
<td><?= $row["jabatan"]; ?></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>

</body>
</html>
