<?php
require_once '_akses.php';

/* ======================================================================
[Proses simpan] */
if ((isset($_POST["fsimpan"])) && ($_POST["fsimpan"] == "y")) {
  $id_pasien    = htmlspecialchars($_POST['id_pasien']);
  $tgl_daftar   = htmlspecialchars(tglSql($_POST['tgl_daftar']));
  $nama_pasien  = htmlspecialchars($_POST['nama_pasien']);
  $tgl_lahir    = htmlspecialchars(tglSql($_POST['tgl_lahir']));
  $jk           = htmlspecialchars($_POST['jk']);
  $tlp          = htmlspecialchars($_POST['tlp']);
  $alamat       = htmlspecialchars($_POST['alamat']);

  // Simpan ke database
  $con->exec("INSERT INTO pasien (id_pasien, tgl_daftar, nama_pasien, tgl_lahir, jk, tlp, alamat, user_id)
                          VALUES ('$id_pasien', '$tgl_daftar', '$nama_pasien', '$tgl_lahir', '$jk', '$tlp', '$alamat', '$akun')");

  header('Location: ../pemeriksaan_pasien_tambah?id=' . $id_pasien);
}


/* ======================================================================
[Proses edit] */
if ((isset($_POST["fedit"])) && ($_POST["fedit"] == "y")) {
  $id_pasien    = htmlspecialchars($_POST['id_pasien']);
  $tgl_daftar   = htmlspecialchars(tglSql($_POST['tgl_daftar']));
  $nama_pasien  = htmlspecialchars($_POST['nama_pasien']);
  $tgl_lahir    = htmlspecialchars(tglSql($_POST['tgl_lahir']));
  $jk           = htmlspecialchars($_POST['jk']);
  $tlp          = htmlspecialchars($_POST['tlp']);
  $alamat       = htmlspecialchars($_POST['alamat']);

  // Update ke database
  $con->exec("UPDATE pasien SET tgl_daftar = '$tgl_daftar', nama_pasien = '$nama_pasien', tgl_lahir = '$tgl_lahir', jk = '$jk', tlp = '$tlp', alamat = '$alamat' WHERE id_pasien = '$id_pasien' ");

  $_SESSION['msg'] = alert('success', 'Perubahan berhasil disimpan');

  header('Location: ../pasien');
}


/* ======================================================================
[Proses hapus] */
if ((isset($_POST["fhapus"])) && ($_POST["fhapus"] == "y")) {
  $id_pasien   = htmlspecialchars($_POST['id_pasien']);

  // Hapus ke database
  $con->exec("DELETE FROM pasien WHERE id_pasien='$id_pasien' ");

  $sql_periksa = $con->query("SELECT * FROM pemeriksaan_pasien WHERE pasien_id = '$id_pasien' ");
  $row_periksa = $sql_periksa->fetch(PDO::FETCH_LAZY);
  $trow_periksa = $sql_periksa->rowCount();
  if (!empty($trow_periksa)) {
    $con->exec("DELETE FROM tes_pasien WHERE pp_id='$row_periksa->id_pp' ");
  }

  $con->exec("DELETE FROM pemeriksaan_pasien WHERE pasien_id='$id_pasien' ");

  $_SESSION['msg'] = alert('success', 'Data berhasil dihapus');

  header('Location: ../pasien');
}
