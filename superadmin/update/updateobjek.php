<!-- cek apakah sudah login -->
<!-- Cara 1 Jika halaman login terpisah dengan halaman index -->
<?php 
@session_start(); 
ob_start();
?>
<?php 
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
$idobjekwisata = input($_POST['idobjekwisata']);
$idkategori = input($_POST['idkategori']);
$nama = input($_POST['nama']);
$deskripsi = input($_POST['deskripsi']);
$alamat = input($_POST['alamat']);
$status = input($_POST['status']);
 
// update data ke database
mysqli_query($konektor,"update tbl_objekwisata set idkategori='$idkategori', nama='$nama', deskripsi='$deskripsi', alamat='$alamat', status='$status' where idobjekwisata='$idobjekwisata'");
 header("location:../index.php?pesan=ubah");
?>