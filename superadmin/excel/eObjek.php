<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Objek Wisata.xls");
?>
LAPORAN OBJEK WISATA KESELURUHAN<BR />
Seluruh
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