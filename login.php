<?php 

session_start();
require 'koneksi.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($koneksi, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if( $key === hash('sha256', $row['username']) ) {
		$_SESSION['login'] = true;
	}


}

if( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}




if( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

	// cek username
	if( mysqli_num_rows($result) === 1 ) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;

            // cek remember me
			if( isset($_POST['remember']) ) {
				// buat cookie
				setcookie('id', $row['id'], time()+60);
				setcookie('key', hash('sha256', $row['username']), time()+60);
			}


			header("Location: index.php");
			exit;
		}
	}

	$error = true;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>

    
    <div class="container">
        <h2>User Login</h2>


        <?php if( isset($error) ) : ?>
	        <p style="color: red; font-style: italic;">username / password salah</p>
        <?php endif; ?>


            <form action="" method="POST">
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    
                    <div class="col-sm-5">
                        <input type="text"  id="username"  name="username" class="form-control" value="" placeholder="masukan username" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="password" placeholder="masukan password" required>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Remember Me</label>
                    </div>
                </div>
                       <button type="submit" name="login" class="btn btn-primary">LOG IN</button>
                
        </form>
    </div>
</body>
</html>