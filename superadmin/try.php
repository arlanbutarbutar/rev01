<?php

$conn = mysqli_connect("localhost", "root", "", "tambal_ban_rev");
// Check connection
if (mysqli_connect_errno()) {
  echo "Koneksi database gagal : " . mysqli_connect_error();
}

$sql = "DELETE FROM lokasi WHERE country!='Indonesia'";
mysqli_query($conn, $sql);

echo "berhasil";
