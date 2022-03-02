<?php 
require 'koneksi.php';

if( isset($_POST["register"]) ) {

	if( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
			  </script>";
	} else {
		echo mysqli_error($koneksi);
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
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <title>Registrasi</title>
  </head>
  <body>
    <div class="container">
        <h1>Registrasi user</h1>

        <div class="row">
            <div class="col-12">
                <form action="" method="POST">
                  <div class="form-group">

                        <label for="username">Username :</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username..." required>
                        
                        <label for="password">Password :</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password..." required>
                        
                        <label for="password2">Konfirmasi Password :</label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Masukan Password..." required>
                        
                     </div>
                            <button type="submit" name="register" class="btn btn-primary">Daftar !</button>
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
