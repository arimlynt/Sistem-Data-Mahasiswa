<?php
require 'functions.php';
//ambil data di url
$id = $_GET["id"];
//ambil data dari query
$row = query("SELECT *FROM mahasiswa WHERE id = $id")[0]; //[0] function query di panggil, begitu masuk ke array rows, maka akan langsung ke indeks 0 atau elemen pertamanya 

//cek apakah tombol submit sudah di tekan atau belum 
if (isset($_POST["submit"])) {
    //cek apakah data berhasil di ubah atau tidak
    if( ubah($_POST) > 0 ) {
        echo "
        <script>
            alert('data berhasil di ubah');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "<script>
        alert('data gagal di ubah');
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
    <h1 align="center">Ubah Data Mahasiswa</h1>
    <hr>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $row["gambar"]; ?>">
        <table border="1" cellpadding="10" cellspacing="0" align="center">
            <tr align="center">
                <td colspan="2">Ubah Data</td>
            </tr>
            <tr>
                <td>
                    <label for="nama">Nama : </label>
                </td>
                <td>
                    <input type="text" name="nama" id="nama" required value="<?= $row["nama"]; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nim">NIM : </label>
                </td>
                <td>
                    <input type="text" name="nim" id="nim" required value="<?= $row["nim"]; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="jurusan">Jurusan : </label>
                </td>
                <td>
                    <input type="text" name="jurusan" id="jurusan" required value="<?= $row["jurusan"]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label for="gambar">Gambar : </label>
                </td>
                <td>
                    <img src="img/<?= $row["gambar"]; ?>" width="50"> <br>
                    <input type="file" name="gambar" id="gambar"> 
                </td>
            </tr>
            <tr align="center">
                <td colspan="2">
                    <button type="submit" name="submit">Ubah</button>
                </td>
            </tr>
        </table>
        <hr width="50%">
    </form>
</body>

</html>