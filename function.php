<?php 

$conn = mysqli_connect('localhost', 'root', '', 'ujikom'); 

function query($query) {
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function add_listberobat($data) {
    global $conn;

    $no_transaksi = htmlspecialchars($data['no_transaksi']);
    $pasien_id = $data['pasien_id'];
    $tahun = $data['tahun'];
    $bulan = $data['bulan'];
    $tanggal = $data['tanggal'];
    $dokter_id = $data['dokter_id'];
    $keluhan = htmlspecialchars($data['keluhan']);
    $biaya_admin = $data['biaya_admin'];

    $query = "INSERT INTO berobat VALUES (
        '$no_transaksi',
        '$pasien_id',
        '$tahun-$bulan-$tanggal',
        '$dokter_id',
        '$keluhan',
        '$biaya_admin'
    )";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function edit_listberobat($data) {
    global $conn;

    $no_transaksi = $data['no_transaksi'];
    $pasien_id = $data['pasien_id'];
    $tanggal = $data['tanggal'];
    $bulan = $data['bulan'];
    $tahun = $data['tahun'];
    $dokter_id = $data['dokter_id'];
    $keluhan = htmlspecialchars($data['keluhan']);
    $biaya_admin = $data['biaya_admin'];

    $query = "UPDATE berobat SET
        pasien_id = '$pasien_id',
        tanggal_berobat = '$tahun-$bulan-$tanggal',
        dokter_id = '$dokter_id',
        keluhan = '$keluhan',
        biaya_admin = '$biaya_admin'
        WHERE no_transaksi = '$no_transaksi'
        ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete_listberobat($no_transaksi) {
	global $conn;
	mysqli_query($conn, "DELETE FROM berobat WHERE no_transaksi = '$no_transaksi'");

	return mysqli_affected_rows($conn);
}
?>