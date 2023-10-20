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
include '../cekInput.php';

// menangkap data yang di kirim dari form
$idkategori = input($_POST['idkategori']);
$namakategori = input($_POST['namakategori']);
 
// update data ke database
mysqli_query($konektor,"update tbl_kategoriobjekwisata set namakategori='$namakategori'where idkategori='$idkategori'");
 
// mengalihkan halaman kembali ke index.php
header("location:../index.php?pesan=ubah");
?>