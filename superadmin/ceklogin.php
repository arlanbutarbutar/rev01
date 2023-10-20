<?php
//Script ini diletakan pada halaman cekLogin.php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'konektor.php';

//Fungsi untuk mencegah inputan karakter yang tidak sesuai
include 'cekinput.php';

// menangkap data yang dikirim dari form
$username = input($_POST['username']);
$sandi = input($_POST['sandi']);

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($konektor, "select * from admin where username='$username' and sandi='$sandi'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if ($cek > 0) {
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:index.php");
} else {
	header("location:index.php?pesan=gagal");
}
