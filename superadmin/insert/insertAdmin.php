<!-- cek apakah sudah login -->
<!-- Cara 1 Jika halaman login terpisah dengan halaman index -->
<?php
session_start();
if ($_SESSION['status'] != "login") {
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
$nama_admin = input($_POST['nama_admin']);
$emel = input($_POST['emel']);
$username = input($_POST['username']);
$sandi = input($_POST['sandi']);

//Mencari data di dalam database sesuai dengan inputan yang dimasukan
$data = mysqli_query($konektor, "select * from admin where username like '$username'");
if (mysqli_num_rows($data) > 0) {   //Data ditemukan
    while ($d = mysqli_fetch_array($data)) {
        //cara 1 kembali kehalaman index dengan mengirimkan pesan
        header("location:../index.php?pesan=duplikat");
        //cara 2 dengan menampilkan alert 
        /* echo "<script>
        alert('Data username $d[username] sudah ada. Silahkan ulangi dengan memasukan data yang lainnya');
        history.go(-1)  //scrip kembali ke 1 halaman sebelumnya
        </script>";*/
    }
}

//Cara 2 kembali kehalaman index dengan mengirimkan pesan
//header("location:../index.php?pesan=duplikat");

else {
    echo 'Data tidak ditemukan';
    // menginput data ke database
    mysqli_query($konektor, "insert into admin values('','$nama_admin','$emel','$username','$sandi')");

    // mengalihkan halaman kembali ke index.php
    header("location:../index.php?pesan=tersimpan");
}

?>