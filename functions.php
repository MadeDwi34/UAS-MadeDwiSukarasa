<?php

$conn = mysqli_connect("localhost", "root", "", "db_mahasiswa");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result)) {
        $rows [] = $row;
    }
    return $rows;
}

function tambahmahasiswa ($data) {
    global $conn;
    
    $nama = htmlspecialchars ($data["nama"]);
    $NIM = htmlspecialchars ($data["NIM"]);
    $Agama = htmlspecialchars ($data["Agama"]);
    $email = htmlspecialchars ($data["email"]);
    $jurusan = htmlspecialchars ($data["jurusan"]);
    $Fakultas = htmlspecialchars ($data["Fakultas"]);
    //upload gambar
    $gambar = upload();
    if( !$gambar) {
        return false;
    }

    $query = "INSERT INTO mahasiswa VALUES('', '$nama', '$NIM', '$Agama', '$email','$Fakultas','$jurusan', '$gambar')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function tambahdosen ($data) {
    global $conn;
    
    $nama = htmlspecialchars ($data["nama"]);
    $NIP = htmlspecialchars ($data["NIP"]);
    $agama = htmlspecialchars ($data["agama"]);
    $fakultas = htmlspecialchars ($data["fakultas"]);
    //upload gambar
    $gambar = upload();
    if( !$gambar) {
        return false;
    }

    $query = "INSERT INTO dosen VALUES('', '$nama', '$NIP', '$agama', '$fakultas', '$gambar')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek ada gambar
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar dahulu');
             </script>";
        return false;
    }

    //cek gambar atau gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('bukan gambar');
             </script>";
        return false;
    }

    //cek jika ukuran terlalu besar
    if ( $ukuranFile > 1000000 ) {
        echo "<script>
        alert('ukuran gambar terlalu besar');
     </script>";
return false;
    }

    //gambar upload
    //generate nama gambar
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar; 

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapusmahasiswa($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}
function hapusdosen($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM dosen WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubahmahasiswa($data) {
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars ($data["nama"]);
    $nim  = htmlspecialchars ($data["nim"]);
    $Agama  = htmlspecialchars ($data["Agama"]);
    $email = htmlspecialchars ($data["email"]);
    $Fakultas = htmlspecialchars ($data["Fakultas"]);
    $jurusan = htmlspecialchars ($data["jurusan"]);
    $gambarLama = htmlspecialchars ($data["gambarLama"]);

    //cek apakah upload gambar baru
    if ( $_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET
            nama = '$nama',
            nim = '$nim',
            Agama = '$Agama',
            email = '$email',
            Fakultas = '$Fakultas',
            jurusan = '$jurusan',
            gambar = '$gambar'
            WHERE id = $id
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function ubahdosen($data) {
    global $conn;

    $id = $data["id"];
    $Nama = htmlspecialchars ($data["Nama"]);
    $nip = htmlspecialchars ($data["nip"]);
    $agama = htmlspecialchars ($data["agama"]);
    $fakultas = htmlspecialchars ($data["fakultas"]);

    $gambarLama = htmlspecialchars ($data["gambarLama"]);

    //cek apakah upload gambar baru
    if ( $_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE dosen SET
            nip = '$nip',
            Nama = '$Nama',
            fakultas = '$fakultas',
            gambar = '$gambar'
            WHERE id = $id
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function carimahasiswa($keyword) {
    $query = "SELECT * FROM mahasiswa WHERE 
        nama LIKE '%$keyword%' OR 
        nim LIKE '%$keyword%' OR
    ";
    return query($query);
}
function caridosen($keyword) {
    $query = "SELECT * FROM dosen WHERE 
        nama LIKE '%$keyword%' OR 
        nip LIKE '%$keyword%' OR
        fakultas LIKE '%$keyword%'
    ";
    return query($query);
}


function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username ada
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if ( mysqli_fetch_assoc($result) ) {
        echo "<script>
            alert('username sudah ada')</script>";
            return false;
    }
    // cek konfirmasi passord
    if ( $password !== $password2 ) {
        echo "<script>
            alert ('password tidak sama');
        </script>";
        return false;
    } 

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
    return mysqli_affected_rows($conn);
}
?>