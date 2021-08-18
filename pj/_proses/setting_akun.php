<?php
require_once '_akses.php';

/* ======================================================================
[Proses edit] */
if ((isset($_POST["fedit"])) && ($_POST["fedit"] == "y")) {


  $id_user   = $akun;
  $username  = htmlspecialchars($_POST['username']);
  $password  = htmlspecialchars($_POST['password']);

  // Mengecek data yang sama dengan yang diinput
  $sql_cek_jumlah = $con->query("SELECT id_user, username FROM user WHERE username = '$username' AND id_user != '$id_user' ");
  $trow_cek_jumlah = $sql_cek_jumlah->rowCount();

  // Jika ada data yang sama
  if ($trow_cek_jumlah > 0) {

    $_SESSION['msg'] = alert('danger', 'Username yang Anda masukkan sudah digunakan');
    header('Location: ../setting_akun');

    // Tidak ada yang sama
  } else {

    // Simpan ke database
    if ($password == '') {
      $con->exec("UPDATE user SET  username = '$username' WHERE id_user = '$id_user' ");
    } else {
      $con->exec("UPDATE user SET username = '$username', password = MD5('$password') WHERE id_user = '$id_user' ");
    }

    $_SESSION['nama_user'] = $nama_user;
    $_SESSION['msg'] = alert('success', 'Perubahan berhasil disimpan');

    header('Location: ../setting_akun');
  }
}
