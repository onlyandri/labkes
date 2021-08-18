<?php
session_start();
require_once '../koneksi.php';
require_once '../config.php';
require_once '../lib/function.php';

$login_page = "../";

/* ======================================================================
[Cek login] */
if (!isset($_SESSION['id_user']) and $_SESSION['user_level'] != 'PJ') {
	header("Location: " . $login_page);
	session_destroy();
	exit;
}

/* ======================================================================
[Data user yang login] */
$akun = $_SESSION['id_user'];
$akun_level = $_SESSION['user_level'];
$sql_akun = $con->query("SELECT d.*, u.* FROM dokter d
                            JOIN user u
                            ON u.id_user = d.user_id
                            WHERE d.user_id = '$akun' ");
$row_akun = $sql_akun->fetch(PDO::FETCH_LAZY);
$nama_akun = $row_akun->nama_dokter;
