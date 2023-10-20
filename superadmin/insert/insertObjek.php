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
$idkategori = input($_POST['idkategori']);
$nama = input($_POST['nama']);
$deskripsi = input($_POST['deskripsi']);
$alamat = input($_POST['alamat']);
$status = input($_POST['status']);


// menginput data ke database
mysqli_query($konektor,"insert into tbl_objekwisata values('','$idkategori','$nama','$deskripsi','$alamat','$status')");

// mengalihkan halaman kembali ke index.php
header("location:../index.php?pesan=tersimpan");
?>