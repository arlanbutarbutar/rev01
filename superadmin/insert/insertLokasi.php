<!-- cek apakah sudah login -->
<!-- Cara 1 Jika halaman login terpisah dengan halaman index -->
<?php
session_start();
if ($_SESSION['status'] != "login") {
   header("location:../index.php?pesan=belum_login");
}
?>

<?php
//Script ini disimpan dengan nama file sendiri. Misalkan insertAdmin.php
// koneksi database
include '../konektor.php';

//Fungsi untuk mencegah inputan karakter yang tidak sesuai
include '../cekInput.php';

// menangkap data yang di kirim dari form
$id_bengkel = input($_POST['id_bengkel']);
$nama_lokasi = input($_POST['nama_lokasi']);
$latitude = input($_POST['latitude']);
$longitude = input($_POST['longitude']);

// menginput data ke database
mysqli_query($konektor, "insert into lokasi_bengkel values('','$id_bengkel','$nama_lokasi','$latitude','$longitude')");

// mengalihkan halaman kembali ke index.php
header("location:../index.php?pesan=tersimpan");
?>