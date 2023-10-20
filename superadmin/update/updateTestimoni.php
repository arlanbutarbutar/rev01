<!-- cek apakah sudah login -->
<!-- Cara 1 Jika halaman login terpisah dengan halaman index -->
<?php 
session_start();
if($_SESSION['status']!="login"){
		header("location:../index.php?pesan=belum_login");
}
?>

<?php
// koneksi database
include '../konektor.php';

//Fungsi untuk mencegah inputan karakter yang tidak sesuai
include '../cekinput.php';

// menangkap data yang di kirim dari form
$idtestimoni = input($_POST['idtestimoni']);
$tanggal = input($_POST['tanggal']);
$idwisatawan = input($_POST['idwisatawan']);
$idobjekwisata = input($_POST['idobjekwisata']);
$judul = input($_POST['judul']);
$deskripsi = input($_POST['deskripsi']);
$status = input($_POST['status']);
 
// update data ke database
mysqli_query($konektor,"UPDATE tbl_testimoni set tanggal='$tanggal', idwisatawan='$idwisatawan', idobjekwisata='$idobjekwisata', judul='$judul', deskripsi='$deskripsi', status='$status' where idtestimoni='$idtestimoni'");
 
// mengalihkan halaman kembali ke index.php
header("location:../index.php?pesan=ubah");
?>