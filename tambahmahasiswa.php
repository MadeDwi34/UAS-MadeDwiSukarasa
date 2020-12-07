<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
include 'functions.php';
if ( isset($_POST["submit"]) ) {


    //cek imk
    if ( tambahmahasiswa($_POST) > 0 ) {
        echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('data Gagal ditambahkan');
            document.location.href = 'index.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro.min.css">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-colors.min.css">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-rtl.min.css">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-icons.min.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <title>Tambah Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body class="h-vh-100 bg-brandColor2">
    <br>
    <h1 style="color: white;"align="center">Tambah Data Mahasiswa</h1>
    <a class="button alert drop-shadow cell-4  offset-4" href="index.php"><span class="mif-arrow-left"></span>Kembali</a>
    <br><br>
    <form action="" method="post" enctype="multipart/form-data">
    <table>
        <div class="form-group cell-6  offset-3">
            <label for="nama">Nama :</label>
            <input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required>
        </div>

        <div class="form-group cell-6  offset-3">
            <label for="NIM">NIM :</label>
            <input type="text" id="NIM" name="NIM" placeholder="Nomer Induk Mahasiswa" required>
        </div>

        <div class="form-group cell-6  offset-3">
            <label for="Agama">Agama    :</label>
            <input type="text" id="Agama" name="Agama" placeholder="Agama" required>
        </div>
        
        <div class="form-group cell-6  offset-3">
            <label for="email">Email    :</label>
            <input type="text" id="email" name="email" placeholder="Alamat Email" required>
        </div>

        <div class="form-group cell-6  offset-3">
            <label for="Fakultas">Fakultas  :</label>
            <input type="text" id="Fakultas" name="Fakultas" placeholder="Fakultas" required>
        </div>

        <div class="form-group cell-6  offset-3">
            <label for="jurusan">Jurusan :</label>
            <input type="text" id="jurusan" name="jurusan" placeholder="jurusan" required>
        </div>
        <div class="form-group cell-6  offset-3">
            <label for="gambar">Gambar :</label>
            <input type="file" id="gambar" name="gambar" placeholder="Foto Profil">
        </div>
        <div class="form-group cell-6  offset-3">
        <button class="button success" type="submit" name="submit"><span class="mif-floppy-disk"></span> Simpan</button>
        <button class="button" type="reset" name="reset"><span class="mif-loop2 fg-red"></span> Reset</button>
        </table>
   
    </div>
    </ul>
    <script type="text/javascript">
	$(document).ready(function(){
		$(".button succes").click(function(){
			var data = $('.form data').serialize();
			$.ajax({
				type: 'POST',
				url: "tambah.php",
				data: data,
				success: function() {
					$('.tambahdata').load("tambah.php");
				}
			});
		});
	});
	</script>
    </form>

        <!-- SCRIPT -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
</body>
</html>