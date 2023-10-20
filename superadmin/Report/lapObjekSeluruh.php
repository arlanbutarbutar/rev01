<?php
//Tidak support bootstrap
//Pada halaman html ini tidak boleh menggunakan CDN atau framework
//Membuat laporan pdf bagian atas
$nama_dokumen='Laporan Objek Seluruh'; //Beri nama file PDF hasil.
include("../mpdf60/mpdf.php"); //Lokasi file mpdf.php
$mpdf=new mPDF('utf-8', 'A4'); // Membuat sebuah file pdf
$mpdf->SetHeader('');
//$mpdf->setFooter('{PAGENO}');// Memberi nomor halaman
ob_start();
?>

LAPORAN OBJEK WISATA KESELURUHAN<BR />
Keterangan
<hr />
<?php // koneksi database
include '../konektor.php';
?>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr bgcolor="#FFFFCC">
		<td>No</td>
		<td>Nama</td>
		<td>Kategori</td>
		<td>Deskripsi</td>
		<td>Alamat</td>
    <td>Status</td>
	</tr>
	<?php
	$no = 1;
	$data = mysqli_query($konektor,"SELECT tbl_objekwisata.`idobjekwisata`,tbl_objekwisata.nama,tbl_objekwisata.status,tbl_kategoriobjekwisata.namakategori,tbl_kategoriobjekwisata.idkategori,tbl_objekwisata.deskripsi,tbl_objekwisata.alamat,if(tbl_objekwisata.status ='1', 'publish','tunda') As publikasi FROM `tbl_objekwisata`,tbl_kategoriobjekwisata WHERE tbl_objekwisata.idkategori = tbl_kategoriobjekwisata.idkategori");
	while ($d = mysqli_fetch_array($data)) {
	?>
		<tr>
			<td><?= $no++; ?></td>
			<td><?php echo $d['nama']; ?></td>
			<td><?php echo $d['namakategori']; ?></td>
      <td><?php echo $d['deskripsi']; ?></td>
			<td><?php echo $d['alamat']; ?></td>
			<td><?php echo $d['publikasi']; ?></td>
		</tr>
	<?php } ?>
</table>
<hr />
<small>Dicetak Tanggal <?php echo ucwords(strtolower(date('j F Y, g:i a'))) ?>, Melalui: <strong>iClass</strong> www.namadomain.com</small>

<?php
//Membuat laporan pdf bagian atas
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>