<?php
require 'functions.php';
//cek apakah tombol submit sudah di tekan atau belum 
if (isset($_POST["submit"])) {
    // var_dump($_POST); 
    // var_dump($_FILES);
    // die;
    //cek apakah data berhasil di tambahkan atau tidak
    if( tambah($_POST) > 0 ) {
        echo "
        <script>
            alert('data berhasil di tambah');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "<script>
        alert('data gagal di tambah');
        document.location.href = 'index.php';
    </script>
    ";
        echo "<br>";
        echo mysqli_error($conn);
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    <h1 align="center">Tambah Data Mahasiswa</h1>
    <hr>
    <form action="" method="POST" enctype="multipart/form-data" align="center">
        <table border="1" cellpadding="10" cellspacing="0" align="center">
            <tr align="center">
                <td colspan="2">Tambah Data</td>
            </tr>
            <tr align="center">
                <td>
                    <label for="nama">Nama : </label>
                </td>
                <td>
                    <input type="text" name="nama" id="nama">
                </td>
            </tr>
            <tr align="center">
                <td>
                    <label for="nim">NIM : </label>
                </td>
                <td>
                    <input type="text" name="nim" id="nim">
                </td>
            </tr>
            <tr align="center">
                <td>
                    <label for="jurusan">Jurusan : </label>
                </td>
                <td>
                    <input type="text" name="jurusan" id="jurusan">
                </td>
            </tr>
            <tr align="center">
                <td>
                    <label for="gambar">Gambar : </label>
                </td>
                <td>
                    <input type="file" name="gambar" id="gambar">
                </td>
            </tr>
            <tr align="center">
                <td colspan="2">
                    <button type="submit" name="submit">Tambah</button>
                </td>
            </tr>
        </table>
        <hr width="50%">
    </form>
</body>

</html>