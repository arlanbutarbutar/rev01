<!-- cek apakah sudah login -->
<!-- Cara 1 Jika halaman login terpisah dengan halaman index -->
<?php
session_start();
if ($_SESSION['status'] != "login") {
	header("location:../index.php?pesan=belum_login");
}
?>

<?php
// koneksi database
include '../konektor.php';

//Fungsi untuk mencegah inputan karakter yang tidak sesuai
include '../cekinput.php';

// menangkap data yang di kirim dari form
$id_admin = input($_POST['id_admin']);
$emel = input($_POST['emel']);
$username = input($_POST['username']);
$sandi = input($_POST['sandi']);
$password = password_hash($sandi, PASSWORD_DEFAULT);

// update data ke database
mysqli_query($konektor, "update admin set email='$emel', username='$username', password='$sandi' where id_admin='$id_admin'");

// mengalihkan halaman kembali ke index.php
header("location:../index.php?pesan=ubah");
?>