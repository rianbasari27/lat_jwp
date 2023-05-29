<?php      
require 'function.php';

$no_transaksi = $_GET['no_transaksi'];

$berobat = query("SELECT * FROM berobat WHERE no_transaksi = '$no_transaksi'")[0];

if(isset($_POST['submit'])) {
	if (edit_listberobat($_POST) > 0) { 
		echo "
			<script>
				alert('Data berhasil diubah!');
				document.location.href = 'listberobat.php';
			</script>";
	} else {	
		echo "
			<script>
				alert('Data gagal diubah!');
				document.location.href = 'listberobat.php';
			</script>";
	}
}

$query = mysqli_query($conn, "SELECT * FROM berobat WHERE no_transaksi = '$no_transaksi'");
while($h = mysqli_fetch_array($query)){
	$pasien_id=$h['pasien_id'];
	$tanggal=explode("-",$h['tanggal_berobat']);// 1945/08/17 => [1945, 8, 17]
	$dokter_id=$h['dokter_id'];
}

if ($_GET["status"] == "clear") {
    $pasien_id = $dokter_id = "";
	$berobat['keluhan'] = $berobat['biaya_admin'] = "";
    $tanggal = ["", "", ""];
}

$option_pasien = "<option value='' style='display:none'>- Pilih Pasien -</option>";
$q = mysqli_query($conn,"SELECT * FROM pasien ORDER BY nama_pasien");
	while ($h = mysqli_fetch_array($q)) {
		$option_pasien = $option_pasien . "<option value=$h[pasien_id] " . ($pasien_id == $h['pasien_id']?'selected':'') . ">$h[nama_pasien]</option>";
	}

	$option_tanggal = "<option value='' style='display:none'>- Pilih Tanggal -</option>";
	for ($i = 1; $i <= 31; $i++) {
		$option_tanggal = $option_tanggal . "<option value=$i " . ($tanggal[2] == $i?'selected':'') . ">$i</option>";
	}

	$bulan=["","Januari","Februari", "Maret", "April",
            "Mei","Juni","Juli","Agustus","September",
            "Oktober","November","Desember"];
	$option_bulan="<option value='' style='display:none'>- Pilih Bulan -</option>";
	for($i = 1; $i <= 12; $i++) {
		$option_bulan = $option_bulan . "<option value=$i " . ($tanggal[1] == $i?'selected':'') . ">$bulan[$i]</option>";
	}

	$option_dokter="<option value='' style='display:none'>- Pilih Dokter -</option>";
	$q = mysqli_query($conn, "SELECT * FROM dokter ORDER BY nama_dokter");
	while ($h=mysqli_fetch_array($q)) {
		$option_dokter = $option_dokter . "<option value=$h[dokter_id] " . ($dokter_id == $h['dokter_id']?'selected':'') . ">$h[nama_dokter]</option>";
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>JWP - New Data Berobat</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
	<h2>EDIT DATA BEROBAT</h2><br>
	<a href='listberobat.php?' class='btn btn-warning'>< Back</a><br><br>
	<form action="" method="post">
		<table>
			<tr>
                <td><label for="no_transaksi">No. Transaksi</label></td>
				<td>:</td>
				<td><input type="text" class="form-control" id="no_transaksi" name="no_transaksi" value='<?= $berobat['no_transaksi']; ?>' readonly></td>
			</tr>
			<tr>
                <td><label for="pasien_id">Nama Pasien</label></td>
				<td>:</td>
				<td><select class="form-select" name="pasien_id" id="pasien_id" value=<?php echo $pasien_id; ?>><?php echo $option_pasien; ?></select></td>
			</tr>
			<tr>
				<td><label for="tanggal">Tanggal Berobat</label></td>
				<td>:</td>
				<td>
					<table>
						<tr>
							<td><select class="form-select" name="tanggal" id="tanggal"><?php echo $option_tanggal; ?></select></td>
							<td><select class="form-select" name="bulan"><?php echo $option_bulan; ?></select></td>
							<td><input type="number" class="form-control pull-left" name="tahun" value=<?php echo $tanggal[0]; ?>></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
                <td><label for="dokter_id">Nama Dokter</label></td>
				<td>:</td>
				<td><select class="form-select" name="dokter_id" id="dokter_id"><?php echo $option_dokter; ?></select></td>
			</tr>
			<tr>
                <td><label for="keluhan">Keluhan</label></td>
				<td>:</td>
				<td><input type="text" class="form-control" id="keluhan" name="keluhan" value='<?= $berobat['keluhan']; ?>'></td>
			</tr>
			<tr>
                <td><label for="biaya_admin">Biaya Administrasi</label></td>
				<td>:</td>
				<td><input type="number" class="form-control" name="biaya_admin" id="biaya_admin" value='<?= $berobat['biaya_admin']; ?>'></td>
			</tr>
		</table>
		<br>
		<button type="submit" name="submit" class='btn btn-success'>Submit</button> 
		<a href='edit_listberobat.php?status=clear&no_transaksi=<?= $no_transaksi; ?>' class='btn btn-danger'>Clear</a>
	</form>
</div>

</body>
</html>