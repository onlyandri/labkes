<?php
require_once '_akses.php';

if (!empty($_GET['search'])) {
	$search    = $_GET['search'];
	$sql = $con->query("SELECT id_pasien, nama_pasien FROM pasien WHERE (id_pasien LIKE '%$search%' OR nama_pasien LIKE '%$search%') ");
} else {
	$sql = $con->query("SELECT id_pasien, nama_pasien FROM pasien ");
}

$json = [];

while ($row = $sql->fetch(PDO::FETCH_LAZY)) {
	$text = $row->id_pasien . ' | ' . $row->nama_pasien;
	$json[] = ['id' => $row->id_pasien, 'text' => $text];
}

echo json_encode($json);
