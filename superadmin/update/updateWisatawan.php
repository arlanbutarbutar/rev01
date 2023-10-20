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
$id_bengkel = input($_POST['id_bengkel']);
$nama_bengkel = input($_POST['nama_bengkel']);
$nama_pemilik = input($_POST['nama_pemilik']);
$no_hp = input($_POST['no_hp']);
$jam_buka = input($_POST['jam_buka']);
$jam_tutup = input($_POST['jam_tutup']);
$deskripsi = input($_POST['deskripsi']);

// update data ke database
mysqli_query($konektor, "update tbl_wisatawan set nama_bengkel='$nama_bengkel', nama_pemilik='$nama_pemilik', no_hp='$no_hp', jam_buka='$jam_buka', jam_tutup='$jam_tutup', deskripai='$deskripsi' where id_bengkel='$id_bengkel'");

// mengalihkan halaman kembali ke index.php
header("location:../index.php?pesan=ubah");
?>