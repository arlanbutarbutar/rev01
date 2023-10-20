<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Wistawan.xls");
?>
LAPORAN DATA WISATAWAN<BR />
Seluruh
<hr />
<?php // koneksi database
include '../konektor.php';
?>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr bgcolor="#FFFFCC">
		<td>No</td>
		<td>Nama Wisatawan</td>
		<td>Jenis Kelamin</td>
		<td>Telepon</td>
		<td>Email</td>
	</tr>
	<?php
	$no = 1;
	$data = mysqli_query($konektor, "select * from tbl_wisatawan");//Mengambil data dari tabel
	while ($d = mysqli_fetch_array($data)) {
	?>
		<tr>
			<td><?= $no++; ?></td>
			<td><?php echo $d['namawisatawan']; ?></td>
			<td><?php echo $d['jeniskelamin']; ?></td>
			<td><?php echo $d['telepon']; ?></td>
			<td><?php echo $d['email']; ?></td>
		</tr>
	<?php } ?>
</table>
<hr />
<small>Dicetak Tanggal <?php echo ucwords(strtolower(date('j F Y, g:i a'))) ?>, Melalui: <strong>iClass</strong> www.namadomain.com</small>