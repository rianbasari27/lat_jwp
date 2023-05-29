<?php 
require 'function.php';

$list_berobat = query('SELECT 
    berobat.no_transaksi, 
    berobat.tanggal_berobat, 
    pasien.nama_pasien, 
    TIMESTAMPDIFF(YEAR, pasien.tanggal_lahir, NOW()) AS usia, 
    pasien.jenis_kelamin, 
    poli.nama_poli, 
    dokter.nama_dokter, 
    berobat.biaya_admin 
    FROM 
    berobat 
    JOIN pasien ON berobat.pasien_id = pasien.pasien_id 
    JOIN dokter ON berobat.dokter_id = dokter.dokter_id 
    JOIN poli ON dokter.poli_id = poli.poli_id
    ORDER BY berobat.no_transaksi'
);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>JWP - List Data Berobat</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-3">
        <h2>LIST BEROBAT</h2><br>
        <a href='index.php' class='btn btn-warning'>< Back</a><br><br>
        <p><a href='add_listberobat.php' class='btn btn-info btn-sm'>Add New</a></p>
        <table class='table table-striped'>
            <tr class='table-success'>
                <th>No Transaksi</th>
                <th>Tanggal Berobat</th>
                <th>Nama Pasien</th>
                <th>Usia</th>
                <th>Jenis Kelamin</th>
                <th>Nama Poli</th>
                <th>Nama Dokter</th>
                <th>Biaya Adm</th>
                <th>Action</th>
            </tr>

            <?php foreach ($list_berobat as $row) : ?>
            <tr>
                <td><?= $row['no_transaksi']; ?></td>
                <td><?= $row['tanggal_berobat']; ?></td>
                <td><?= $row['nama_pasien']; ?></td>
                <td><?= $row['usia']; ?></td>
                <td><?= $row['jenis_kelamin']; ?></td>
                <td><?= $row['nama_poli']; ?></td>
                <td><?= $row['nama_dokter']; ?></td>
                <td><?= $row['biaya_admin']; ?></td>
                <td>
                    <a href='edit_listberobat.php?status=edit&no_transaksi=<?= $row['no_transaksi']; ?>' class='btn btn-success btn-sm'>Edit</a> 
                    <a href='delete_listberobat.php?no_transaksi=<?= $row['no_transaksi']; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Anda yakin ingin menghapus data ini?');">Delete</a>    
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>