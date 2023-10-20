<?php
if (!isset($_SESSION[""])) {
   session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
include '../konektor.php';

$idBengkels = "SELECT * FROM bengkel ORDER BY id_bengkel DESC LIMIT 1";
$idBengkel = mysqli_query($konektor, $idBengkels);
if (mysqli_num_rows($idBengkel) > 0) {
   $row = mysqli_fetch_assoc($idBengkel);
   $id = $row['id_bengkel'] + 1;
} else {
   $id = 1;
}
$path = "../berkas/";
$fileName = basename($_FILES["file_bengkel"]["name"]);
$fileName = str_replace(" ", "-", $fileName);
$ekstensiGambar = explode('.', $fileName);
$ekstensiGambar = strtolower(end($ekstensiGambar));
$imageUploadPath = $path . $id . ".jpg";
$fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
$allowTypes = array('jpg', 'png', 'jpeg');
if (in_array($fileType, $allowTypes)) {
   $imageTemp = $_FILES["file_bengkel"]["tmp_name"];
   move_uploaded_file($imageTemp, $imageUploadPath);
} else {
   $_SESSION['message-danger'] = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
   $_SESSION['time-message'] = time();
   return false;
}
$nama_bengkel = $_POST['nama_bengkel'];
$nama_pemilik = $_POST['nama_pemilik'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$jam_buka = $_POST['jam_buka'];
$jam_tutup = $_POST['jam_tutup'];
$deskripsi = $_POST['deskripsi'];

// menginput data ke database
mysqli_query($konektor, "INSERT INTO bengkel(id_bengkel,nama_bengkel,nama_pemilik,no_hp,alamat,jam_buka,jam_tutup,deskripsi) VALUES('$id','$nama_bengkel','$nama_pemilik','$no_hp','$alamat','$jam_buka','$jam_tutup','$deskripsi')");

// mengalihkan halaman kembali ke index.php
header("location:../index.php?pesan=tersimpan");
