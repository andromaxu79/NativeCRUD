 
<?php 


$koneksi = mysqli_connect("localhost","root","","nasdem");

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

// view data 
function query($query) {
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

// tambah data

function tambah($data) {
	global $koneksi;

	$nik = htmlspecialchars($data["nik"]);
	$nama = htmlspecialchars($data["nama"]);
	$alamat = htmlspecialchars($data["alamat"]);


	// cek apakah NIK sama atau tidak
	$result = mysqli_query($koneksi, "SELECT nik FROM ktp WHERE nik = '$nik'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('NIK sudah terdaftar!')
		      </script>";
		return false;
	}

	// upload gambar
	$profil = upload();
	if( !$profil ) {
		return false;
	}
	

	$query = "INSERT INTO ktp VALUES('', '$profil', '$nik', '$nama', '$alamat')";

	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

// VErivikasi Upload file
function upload() {

	$namaFile = $_FILES['profil']['name'];
	$ukuranFile = $_FILES['profil']['size'];
	$error = $_FILES['profil']['error'];
	$tmpName = $_FILES['profil']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if( $ukuranFile > 1000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;
}

//edit data
function edit($data) {
	global $koneksi;

	$id = $data["id"];
	$profillama = $data["profillama"];
	$nik = htmlspecialchars($data["nik"]);
	$nama = htmlspecialchars($data["nama"]);
	$alamat = htmlspecialchars($data["alamat"]);
	
	// cek apakah user pilih gambar baru atau tidak
	if( $_FILES['profil']['error'] === 4 ) {
		$profil = $profillama;
	} else {
		$profil = upload();
	}
	

	$query = "UPDATE ktp SET 
				nik = '$nik',
				profil = '$profil',
				nama = '$nama',
				alamat = '$alamat'
			WHERE id = $id";

	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);	
}




// hapus data
function hapus($id) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM ktp WHERE id = $id");
	return mysqli_affected_rows($koneksi);
}

// cari data di search
function cari($keyword) {
	$query = "SELECT * FROM ktp WHERE
			  nik LIKE '%$keyword%' OR
			  nama LIKE '%$keyword%' OR
			  alamat LIKE '%$keyword%'
			";
	return query($query);
}

// registrasi
function registrasi($data) {
	global $koneksi;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
	}


	// cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$password')");

	return mysqli_affected_rows($koneksi);

}


?>
