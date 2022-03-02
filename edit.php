<?php

session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'koneksi.php';

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$ktp = query("SELECT * FROM ktp WHERE id = $id")[0];

if( isset($_POST["edit"]) ) {
	
	// cek apakah data berhasil diubah atau tidak
	if( edit($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'index.php';
			</script>
		";
	}


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!--My CSS-->
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
   
<div class="container">
        <h2>Edit Data</h2>
        <div class="row">
            <div class="col-12">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">

                        <input type="hidden" name="id" value="<?php echo $ktp["id"]; ?>">

                        <!-- menampilkan foto lama yang mau di upload -->
                        <input type="hidden" name="profillama" value="<?php echo $ktp["profil"]; ?>">

                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" name="nik" value="<?php echo $ktp["nik"]; ?>" placeholder="Masukan NIK..." required>
                        
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $ktp["nama"]; ?>" placeholder="Masukan Nama..." required>
                        
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?php echo $ktp["alamat"]; ?>" placeholder="Masukan alamat..." required>
                        
                        <label for="profil">Profil :</label> <br>
                        <img src="img/<?php echo $ktp['profil']; ?>" width="40"> <br>
                        <input type="file" name="profil" id="profil">
                    
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                </form>
            </div>
        </div>
    </div>



    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>