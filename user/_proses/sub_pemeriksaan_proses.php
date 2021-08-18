<?php
require_once '_akses.php';

/* ======================================================================
[Proses simpan] */
if ((isset($_POST["fsimpan"])) && ($_POST["fsimpan"] == "y")) {


  $pemeriksaan_id    = htmlspecialchars($_POST['pemeriksaan_id']);
  $nama_sub_periksa = htmlspecialchars($_POST['nama_sub_periksa']);

  // Mengecek data yang sama dengan yang diinput
  $sql_cek_jumlah = $con->query("SELECT nama_sub_periksa FROM sub_periksa WHERE nama_sub_periksa = '$nama_sub_periksa' ");
  $trow_cek_jumlah = $sql_cek_jumlah->rowCount();

  // Jika ada data yang sama
  if ($trow_cek_jumlah > 0) {

    $_SESSION['msg'] = alert('danger', 'Sub Pemeriksaan yang Anda masukkan sudah digunakan');
    header('Location: ../sub_pemeriksaan_tambah?pemeriksaan_id=' . $pemeriksaan_id);

    // Tidak ada yang sama
  } else {

    // Simpan ke database
    $con->exec("INSERT INTO sub_periksa (pemeriksaan_id, nama_sub_periksa)
                            VALUES ('$pemeriksaan_id', '$nama_sub_periksa')");

    $_SESSION['msg'] = alert('success', 'Sub Jenis Pemeriksaan berhasil ditambahkan');

    header('Location: ../sub_pemeriksaan?pemeriksaan_id=' . $pemeriksaan_id);
  }
}

/* ======================================================================
[Proses edit] */
if ((isset($_POST["fedit"])) && ($_POST["fedit"] == "y")) {


  $id        = htmlspecialchars($_POST['id']);
  $pemeriksaan_id    = htmlspecialchars($_POST['pemeriksaan_id']);
  $nama_sub_periksa = htmlspecialchars($_POST['nama_sub_periksa']);

  // Mengecek data yang sama dengan yang diinput
  $sql_cek_jumlah = $con->query("SELECT nama_sub_periksa FROM sub_periksa WHERE nama_sub_periksa = '$nama_sub_periksa' AND id_sub_periksa != '$id' ");
  $trow_cek_jumlah = $sql_cek_jumlah->rowCount();

  // Jika ada data yang sama
  if ($trow_cek_jumlah > 0) {

    $_SESSION['msg'] = alert('danger', 'Sub Pemeriksaan yang Anda masukkan sudah digunakan');
    header('Location: ../sub_pemeriksaan_edit?id=' . $id . '&pemeriksaan_id=' . $pemeriksaan_id);

    // Tidak ada yang sama
  } else {

    // Simpan ke database
    $con->exec("UPDATE sub_periksa SET pemeriksaan_id = '$pemeriksaan_id', nama_sub_periksa = '$nama_sub_periksa' WHERE id_sub_periksa = '$id' ");

    $_SESSION['msg'] = alert('success', 'Perubahan berhasil disimpan');

    header('Location: ../sub_pemeriksaan?pemeriksaan_id=' . $pemeriksaan_id);
  }
}

/* ======================================================================
[Proses hapus] */
if ((isset($_POST["fhapus"])) && ($_POST["fhapus"] == "y")) {

  $id_sub_periksa   = htmlspecialchars($_POST['id']);
  $pemeriksaan_id    = htmlspecialchars($_POST['pemeriksaan_id']);

  // Hapus dari database
  $con->exec("DELETE FROM sub_periksa WHERE id_sub_periksa = '$id_sub_periksa' ");

  $_SESSION['msg'] = alert('success', 'Data berhasil dihapus');

  header('Location: ../sub_pemeriksaan?pemeriksaan_id=' . $pemeriksaan_id);
}
