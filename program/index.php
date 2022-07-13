<?php
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");
//ketika tombol cari di tekan
if( isset($_POST["cari"]) ) {
    $mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <h1 align="center">Data Mahasiswa</h1>
    <hr><br>
    <form action="" method="post" align="center">
        <input type="text" name="keyword" size="35" autofocus placeholder="masukkan keyword pencarian...." autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form><br>
    <table border="1" cellpadding="10" cellspacing="0" align="center">
        <tr>
            <td colspan="6" border="0">
            <a href="tambah.php">Tambah Data Mahasiswa</a>
            </td>
        </tr>
        <tr>
            <th>Id</th>
            <th>Aksi</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <tr>
                <td> <?= $i; ?> </td>
                <td> <a href="ubah.php?id=<?= $mhs["id"]; ?>"> Edit </a>
                     |
                     <a href="hapus.php?id=<?= $mhs["id"];?>" onclick="return confirm('yakin?')"> Hapus </a> 
                </td>
                <td> <img src="img/<?= $mhs["gambar"] ?>" alt="foto" width="50"> </td>
                <td> <?= $mhs["nama"]; ?> </td>
                <td> <?= $mhs["nim"]; ?></td>
                <td> <?= $mhs["jurusan"]; ?> </td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
    </table>
    <hr width="60%">
</body>

</html>