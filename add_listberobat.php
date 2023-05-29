<?php 
require 'function.php';

if(isset($_POST['submit'])) {

	if (add_listberobat($_POST) > 0) { 
		echo "
			<script>
				alert('Data berhasil ditambahkan!');
			</script>";
	} else {
		echo "
			<script>
				alert('Data gagal ditambahkan!');
			</script>";
	}
}

$option_pasien = "<option value='' style='display:none'>- Pilih Pasien -</option>";
$q = mysqli_query($conn,"SELECT * FROM pasien ORDER BY nama_pasien");
while($h=mysqli_fetch_array($q)) {
	$option_pasien = $option_pasien . "<option value=$h[pasien_id]>$h[nama_pasien]</option>";
}

$option_tanggal = "<option value='' style='display:none'>- Pilih Tanggal -</option>";
for ($i = 1;$i <= 31; $i++) { 
	$option_tanggal=$option_tanggal."<option value=$i>$i</option>";
}

$bulan = ["","Januari","Februari","Maret",
    	"April","Mei","Juni","Juli","Agustus",
		"September","Oktober","November","Desember"];
$option_bulan = "<option value='' style='display:none'>- Pilih Bulan -</option>";
for ($i = 1;$i <= 12; $i++) {
	$option_bulan=$option_bulan."<option value=$i>$bulan[$i]</option>";
}

$option_dokter = "<option value='' style='display:none'>- Pilih Dokter -</option>";
$q = mysqli_query($conn,"SELECT * FROM dokter ORDER BY nama_dokter");
while($h=mysqli_fetch_array($q)) {
	$option_dokter=$option_dokter."<option value=$h[dokter_id]>$h[nama_dokter]</option>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>JWP - Add Data Berobat</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
	<h2>DATA BEROBAT BARU</h2><br>
	<a href='listberobat.php' class='btn btn-warning'>< Back</a><br><br>
	<form action="" method="post">
		<table>
			<tr>
				<td><label for="no_transaksi">No. Transaksi</label></td>
				<td>:</td>
				<td colspan=3><input type="text" class="form-control" name="no_transaksi" id="no_transaksi"></td>
			</tr>
			<tr>
                <td><label for="pasien_id">Nama Pasien</label></td>
				<td>:</td>
				<td><select class="form-select" name="pasien_id" id="pasien_id"><?php echo $option_pasien ?></select></td>
			</tr>
			<tr>
                <td><label for="tanggal">Tanggal Berobat</label></td>
				<td>:</td>
				<td>
					<table>
						<tr>
							<td><select class="form-select" name="tanggal" id="tanggal"><?php echo $option_tanggal ?></select></td>
							<td><select class="form-select" name="bulan"><?php echo $option_bulan ?></select></td>
							<td><input type="number" class="form-control" name="tahun"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
                <td><label for="dokter_id">Nama Dokter</label></td>
				<td>:</td>
				<td><select class="form-select" name="dokter_id" id="dokter_id"><?php echo $option_dokter ?></select></td>
			</tr>
			<tr>
                <td><label for="keluhan">Keluhan</label></td>
				<td>:</td>
				<td><input type="text" class="form-control" name="keluhan" id="keluhan"></td>
			</tr>
			<tr>
                <td><label for="biaya_admin">Biaya Administrasi</label></td>
				<td>:</td>
				<td><input type="number" class="form-control" name="biaya_admin" id="biaya_admin"></td>
			</tr>
		</table>
		<br>
		<button type="submit" name="submit" class='btn btn-success'>Submit</button> 
		<a href='add_listberobat.php' class='btn btn-danger'>Clear</a>
	</form>
</div>

</body>
</html>