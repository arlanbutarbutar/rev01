<?php
if (!isset($_SESSION[""])) {
   session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
include '../konektor.php';

//Fungsi untuk mencegah inputan karakter yang tidak sesuai
include '../cekInput.php';

// menangkap data yang di kirim dari form
$id_bengkel = input($_POST['id_bengkel']);
$path = "../berkas/";
$fileName = basename($_FILES["file_bengkel"]["name"]);
$fileName = str_replace(" ", "-", $fileName);
$ekstensiGambar = explode('.', $fileName);
$ekstensiGambar = strtolower(end($ekstensiGambar));
$imageUploadPath = $path . $fileName;
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
$nama_bengkel = input($_POST['nama_bengkel']);
$nama_pemilik = input($_POST['nama_pemilik']);
$no_hp = input($_POST['no_hp']);
$alamat = input($_POST['alamat']);
$jam_buka = input($_POST['jam_buka']);
$jam_tutup = input($_POST['jam_tutup']);
$deskripsi = $_POST['deskripsi'];

// update data ke database
mysqli_query($konektor, "UPDATE bengkel SET image='$fileName', nama_bengkel='$nama_bengkel', nama_pemilik='$nama_pemilik', no_hp='$no_hp', alamat='$alamat', jam_buka='$jam_buka', jam_tutup='$jam_tutup' WHERE id_bengkel='$id_bengkel'");
$sql = "DELETE FROM fasilitas_bengkel WHERE id_bengkel='$id_bengkel'";
mysqli_query($konektor, $sql);
if (!empty($deskripsi)) {
   for ($x = 0; $x < count($deskripsi); $x++) {
      mysqli_query($konektor, "INSERT INTO fasilitas_bengkel(id_fasilitas,id_bengkel) VALUES('$deskripsi[$x]','$id_bengkel')");
   }
}

// mengalihkan halaman kembali ke index.php
header("location:../index.php?pesan=ubah");
