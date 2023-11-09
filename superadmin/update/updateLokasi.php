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
include '../cekInput.php';

// menangkap data yang di kirim dari form
$id_lokasi = input($_POST['id_lokasi']);
$id_bengkel = input($_POST['id_bengkel']);
$nama_lokasi = input($_POST['nama_lokasi']);
$latitude = input($_POST['latitude']);
$longitude = input($_POST['longitude']);

// update data ke database
mysqli_query($konektor, "update lokasi_bengkel set id_bengkel='$id_bengkel', nama_lokasi='$nama_lokasi', latitude='$latitude', longitude='$longitude' where id_lokasi='$id_lokasi'");

// mengalihkan halaman kembali ke index.php
header("location:../index.php?pesan=ubah");
?>