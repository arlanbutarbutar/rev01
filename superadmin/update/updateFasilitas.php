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
$id_fasilitas = input($_POST['id_fasilitas']);
$nama_fasilitas = input($_POST['nama_fasilitas']);

// update data ke database
mysqli_query($konektor, "update fasilitas set nama_fasilitas='$nama_fasilitas' where id_fasilitas='$id_fasilitas'");

// mengalihkan halaman kembali ke index.php
header("location:../index.php?pesan=ubah");
?>