<?php
//koneksi ke database 
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}
function tambah($data) {
    global $conn;
    //ambil data dari tiap elemen pada form 
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    // $gambar = htmlspecialchars($data["gambar"]);
    
    // upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

    //query insert data
    $query = "INSERT INTO mahasiswa VALUES 
       ('', '$nama', '$nim', '$jurusan', '$gambar') ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    
    //cek apakh tdk ada gambar yg di upload
    if( $error === 4 ) { //angka 4 artinya pesan error kalau tdk ada file yg di upload 
        echo "<script>
            alert('pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    //cek apakah yg d upload gambar atau bukan 
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    //fungsi di bawah akan menghasilkan true jika ada dan akan menghasilkan false jika tidak ada
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) { //in_arrray = mengecek apakah ada string pada sebuah array
        echo "<script>
        alert('bukan gambar!');
    </script>";
    return false;
    }

    //cek jika ukuran terlalu besar 
    if( $ukuranFile > 1000000 ) {
        echo "<script>
        alert('ukuran gambar terlalu besar');
    </script>";
    return false;
    }

    //lolos pengecekan, gambar siap di upload
    //genrate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id) {   
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}
function ubah($data) {
    global $conn;
    //ambil data dari tiap elemen pada form 
    $id = $data["id"]; 
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    
    //query update data
    $query = "UPDATE mahasiswa SET
                nama = '$nama',
                nim = '$nim',
                jurusan = '$jurusan',
                gambar = '$gambar'
               WHERE id = $id ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function cari($keyword) {
    $query = "SELECT * FROM mahasiswa 
              WHERE 
              nama LIKE '%$keyword%' OR
              nim LIKE '%$keyword%' OR
              jurusan LIKE '%$keyword%'
    ";
    return query($query); 
}





?>