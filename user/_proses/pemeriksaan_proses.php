<?php
require_once '_akses.php';

/* ======================================================================
[Proses simpan] */
if ((isset($_POST["fsimpan"])) && ($_POST["fsimpan"] == "y")) {


  $nama_pemeriksaan = htmlspecialchars($_POST['nama_pemeriksaan']);

  // Mengecek data yang sama dengan yang diinput
  $sql_cek_jumlah = $con->query("SELECT nama_pemeriksaan FROM jenis_pemeriksaan WHERE nama_pemeriksaan = '$nama_pemeriksaan' ");
  $trow_cek_jumlah = $sql_cek_jumlah->rowCount();

  // Jika ada data yang sama
  if ($trow_cek_jumlah > 0) {

    $_SESSION['msg'] = alert('danger', 'Jenis Pemeriksaan yang Anda masukkan sudah digunakan');
    header('Location: ../pemeriksaan_tambah');

    // Tidak ada yang sama
  } else {

    // Simpan ke database
    $con->exec("INSERT INTO jenis_pemeriksaan (nama_pemeriksaan)
                              VALUES ('$nama_pemeriksaan')");

    $_SESSION['msg'] = alert('success', 'Jenis Pemeriksaan berhasil ditambahkan');

    header('Location: ../pemeriksaan');
  }
}

/* ======================================================================
[Proses edit] */
if ((isset($_POST["fedit"])) && ($_POST["fedit"] == "y")) {


  $id_pemeriksaan   = htmlspecialchars($_POST['id_pemeriksaan']);
  $nama_pemeriksaan = htmlspecialchars($_POST['nama_pemeriksaan']);

  // Mengecek data yang sama dengan yang diinput
  $sql_cek_jumlah = $con->query("SELECT id_pemeriksaan, nama_pemeriksaan FROM jenis_pemeriksaan WHERE nama_pemeriksaan = '$nama_pemeriksaan' AND id_pemeriksaan != '$id_pemeriksaan' ");
  $trow_cek_jumlah = $sql_cek_jumlah->rowCount();

  // Jika ada data yang sama
  if ($trow_cek_jumlah > 0) {

    $_SESSION['msg'] = alert('danger', 'Jenis Pemeriksaan yang Anda masukkan sudah digunakan');
    header('Location: ../pemeriksaan_edit?id=' . $id_pemeriksaan);

    // Tidak ada yang sama
  } else {

    // Simpan ke database
    $con->exec("UPDATE jenis_pemeriksaan SET nama_pemeriksaan = '$nama_pemeriksaan' WHERE id_pemeriksaan = '$id_pemeriksaan' ");

    $_SESSION['msg'] = alert('success', 'Perubahan berhasil disimpan');

    header('Location: ../pemeriksaan');
  }
}

/* ======================================================================
[Proses hapus] */
if ((isset($_POST["fhapus"])) && ($_POST["fhapus"] == "y")) {

  $id_pemeriksaan   = htmlspecialchars($_POST['id_pemeriksaan']);

  // Simpan ke database
  $sql_sub = $con->query("SELECT * FROM sub_periksa WHERE pemeriksaan_id = '$id_pemeriksaan' ");
  while ($row_sub = $sql_sub->fetch(PDO::FETCH_LAZY)) {
    $con->exec("DELETE FROM tes_pasien WHERE sub_periksa_id = '$row_sub->id_sub_periksa' ");
  }

  $con->exec("DELETE FROM sub_periksa WHERE pemeriksaan_id = '$id_pemeriksaan' ");
  $con->exec("DELETE FROM jenis_pemeriksaan WHERE id_pemeriksaan = '$id_pemeriksaan' ");

  $_SESSION['msg'] = alert('success', 'Data berhasil dihapus');

  header('Location: ../pemeriksaan');
}
