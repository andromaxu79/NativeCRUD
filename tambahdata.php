<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'koneksi.php';
if( isset($_POST["tambah"]) ) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( tambah($_POST) > 0 ) {
          echo "<script>
              alert('data berhasil ditambahkan!');
              document.location.href = 'index.php';
            </script>
          ";
  	} else {
           echo "
              <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'index.php';
              </script>
            ";
	}


}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Tambah Data</title>
  </head>
  <body>
    <div class="container">
        <h2>Tambah Data</h2>
        <div class="row">
            <div class="col-12">
              <!-- tambahkan enctype untuk mengurus upload $_FILE -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" name="nik" placeholder="Masukan NIK..." required>
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama..." required>
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Masukan alamat..." required>
                        <label for="profil">profil</label>
                        <input type="file" class="form-control" name="profil" id="profil">
                    </div>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>