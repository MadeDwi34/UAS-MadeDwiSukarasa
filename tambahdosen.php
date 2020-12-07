<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
include 'functions.php';
if ( isset($_POST["submit"]) ) {


    //cek imk
    if ( tambahdosen($_POST) > 0 ) {
        echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href = 'datadosen.php';
        </script>";
    } else {
        echo "
        <script>
            alert('data Gagal ditambahkan');
            document.location.href = 'datadosen.php';
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
    <h1 style="color: white;"align="center">Tambah Data Dosen</h1>
    <a class="button alert drop-shadow cell-4  offset-4" href="datadosen.php"><span class="mif-arrow-left"></span>Kembali</a>
    <br><br>
    <form action="" method="post" enctype="multipart/form-data">
    <table>
        <div class="form-group cell-6  offset-3">
            <label for="nama">Nama :</label>
            <input type="text" id="Nama" name="nama" placeholder="Nama Lengkap" required>
        </div>

        <div class="form-group cell-6  offset-3">
            <label for="NIP">NIP :</label>
            <input type="text" id="NIP" name="NIP" placeholder="NIP" required>
        </div>
        
        <div class="form-group cell-6  offset-3">
            <label for="agama">Agama :</label>
            <input type="text" id="agama" name="agama" placeholder="agama" required>
        </div>

        <div class="form-group cell-6  offset-3">
            <label for="fakultas">Fakultas    :</label>
            <input type="text" id="fakultas" name="fakultas" placeholder="Fakultas" required>
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