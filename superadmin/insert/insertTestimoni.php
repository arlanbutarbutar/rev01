<!-- cek apakah sudah login -->
<!-- Cara 1 Jika halaman login terpisah dengan halaman index -->
<?php 
session_start();
if($_SESSION['status']!="login"){
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
$tanggal = input($_POST['tanggal']);
$idwisatawan = input($_POST['idwisatawan']);
$idobjekwisata = input($_POST['idobjekwisata']);
$judul = input($_POST['judul']);
$deskripsi = input($_POST['deskripsi']);
$status = input($_POST['status']);

// menginput data ke database
mysqli_query($konektor,"insert into tbl_testimoni values('','$tanggal','$idwisatawan','$idobjekwisata','$judul','$deskripsi','$status')");

// mengalihkan halaman kembali ke index.php
header("location:../index.php?pesan=tersimpan");
?>