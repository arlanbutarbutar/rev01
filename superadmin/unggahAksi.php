<?php
include 'enkripsiVariabel.php';

$temp = $_FILES['berkas']['tmp_name'];
$name = $_FILES['berkas']['name'];//mengambil nama file asli
$id =   $_POST['id'].'.jpg';//mengambil nama file dari url parameter
$size = $_FILES['berkas']['size'];//mengambil ukuran file
$type = $_FILES['berkas']['type'];//mengambil tipe file
$folder = "berkas/";//Folder untuk menampung berkas. Pastikan Anda telah membuatnya
// upload Process
//10 Megabyte = 1000000 
if ($size <= 10000000 and $type =='image/jpeg') {   //Melakukan validasi tipe file dan ukuran file 5 MB
    move_uploaded_file($temp, $folder . $id); //Jika menggunakan nama file berdasarkan url parameter silakan ganti $name dengan $id
    // mengalihkan halaman kembali ke unggah.php atau sesui yang diinginkan

    $id = kunci($id); //enkripsi nama file dari url parameter
    $size = kunci($size); //enkripsi ukuran file
    $type = kunci($type); //enkripsi tipe file

    header("location:index.php?pesan=fileterkirim&name=$id&size=$size&type=$type");
}else{
    $id = kunci($id); //enkripsi nama file dari url parameter
    $size = kunci($size); //enkripsi ukuran file
    $type = kunci($type); //enkripsi tipe file
    header("location:index.php?pesan=filegagalterkirim&name=$id&size=$size&type=$type");
}
