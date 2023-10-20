<?php
//Script ini diletakan pada sebuah halaman dengan nama cekInput.php
//Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>