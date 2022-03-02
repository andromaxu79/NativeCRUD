
<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}


require 'koneksi.php';
$ktp = query("SELECT*FROM ktp");

// tombol cari ditekan
if( isset($_POST["cari"]) ) {
	$ktp = cari($_POST["keyword"]);
}
?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!p--My CSS-->
    <link rel="stylesheet" href="assets/css/style.css">


    <title>Information Data System</title>

  </head>
  <body>
    
    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark  fixed-top">
      <a class="navbar-brand" href="#">Brand</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- untuk align linknya : class= mx-auto'tengah', mr-auto'kiri', ml-auto'kanan' -->
        <ul class="navbar-nav ml-auto"> 
          <li class="nav-item active">
            <a class="nav-link" href="#">Admin <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Out</a>
          </li>
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      </div>
    </nav>
    <!-- endnav bar -->


    <!-- jumbotron -->
    <div class="jumbotron">
      <div class="container text-center">
        <h1>Selamat Datang</h1>
      </div>

    </div>
    <!-- endjumbotron -->
    
    
    <!-- tambah data dan cari -->
    
    <div class="container">
    <div class="cari">
    <a href="tambahdata.php" class="btn btn-info" role="button">Tambah Data</a>

      <form  action="" method="post">

          <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off">
          <button type="submit" name="cari">Cari!</button>
      </form>
    </div>

    <div class="container">

      <div class="table table-responsive">
        <table class="table table-bordered table-sm">
          <thead class="text-center">
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Profil</th>
              <th scope="col">NIK</th>
              <th scope="col">Nama</th>
              <th scope="col">Alamat</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>

          <!-- view data  -->
          <?php
          $no=1;
          ?>

          <?php foreach ($ktp as $row) {?>
            
          
              
          <tbody>
            <tr>
              <td><?php echo $no; ?></td>
              <td class="text-center"><img src="img/<?= $row['profil']; ?>" width="50" height="50"></td>
              <td><?php echo $row['nik']; ?></td>
              <td><?php echo $row['nama']; ?></td>
              <td><?php echo $row['alamat']; ?></td>
              <td class="text-center">
                  <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary" role="button">Edit</a> |
                  <a href="hapus.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger" role="button">hapus</a>
              </td>
            </tr>
          </tbody>

        <?php $no++; ?>
        <?php } ?>  
        <!-- end view data -->
        </table>
      </div>
    </div>

    <h1></h1>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  </body>
</html>