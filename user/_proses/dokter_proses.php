<?php
require_once '_akses.php';

/* ======================================================================
[Proses simpan] */
if ((isset($_POST["fsimpan"])) && ($_POST["fsimpan"] == "y")) {
    $nama_dokter    = htmlspecialchars($_POST['nama_dokter']);
    $spesifikasi    = htmlspecialchars($_POST['spesifikasi']);
    $tlp            = htmlspecialchars($_POST['tlp']);
    $alamat         = htmlspecialchars($_POST['alamat']);
    $username       = htmlspecialchars($_POST['username']);
    $password       = htmlspecialchars($_POST['password']);

    $sqlMaxID = $con->query("SELECT max(id_user) AS maxID FROM user ");
    $rowMaxID = $sqlMaxID->fetch(PDO::FETCH_LAZY);
    $id_user = $rowMaxID['maxID'] + 1;
    if ($id_user == NULL) {
        $id_user = 1;
    }

    $sqlMaxID2 = $con->query("SELECT max(id_dokter) AS maxID FROM dokter ");
    $rowMaxID2 = $sqlMaxID2->fetch(PDO::FETCH_LAZY);
    $id_dokter = $rowMaxID2['maxID'] + 1;
    if ($id_dokter == NULL) {
        $id_dokter = 1;
    }

    // Simpan ke database
    $con->exec("INSERT INTO user (id_user, username, password, user_level)
                          VALUES ('$id_user', '$username', md5('$password'), 'PJ')");

    // Simpan ke database
    $con->exec("INSERT INTO dokter (id_dokter, nama_dokter, spesifikasi, tlp, alamat, `user_id`)
                          VALUES ('$id_dokter', '$nama_dokter', '$spesifikasi', '$tlp', '$alamat', '$id_user')");

    $_SESSION['msg'] = alert('success', 'Dokter berhasil ditambahkan');

    header('Location: ../dokter');
}


/* ======================================================================
[Proses edit] */
if ((isset($_POST["fedit"])) && ($_POST["fedit"] == "y")) {
    $id_dokter    = htmlspecialchars($_POST['id_dokter']);
    $nama_dokter  = htmlspecialchars($_POST['nama_dokter']);
    $spesifikasi  = htmlspecialchars($_POST['spesifikasi']);
    $tlp          = htmlspecialchars($_POST['tlp']);
    $alamat       = htmlspecialchars($_POST['alamat']);

    // Update ke database
    $con->exec("UPDATE dokter SET nama_dokter = '$nama_dokter', spesifikasi = '$spesifikasi', tlp = '$tlp', alamat = '$alamat' WHERE id_dokter = '$id_dokter' ");

    $_SESSION['msg'] = alert('success', 'Perubahan berhasil disimpan');

    header('Location: ../dokter');
}


/* ======================================================================
[Proses hapus] */
if ((isset($_POST["fhapus"])) && ($_POST["fhapus"] == "y")) {
    $id_user   = htmlspecialchars($_POST['id_user']);

    // Hapus ke database
    $con->exec("DELETE FROM dokter WHERE user_id='$id_user' ");
    $con->exec("DELETE FROM user WHERE id_user='$id_user' ");

    $_SESSION['msg'] = alert('success', 'Data berhasil dihapus');

    header('Location: ../dokter');
}


/* ======================================================================
[Proses reset] */
if ((isset($_POST["freset"])) && ($_POST["freset"] == "y")) {
    $id_user    = htmlspecialchars($_POST['id_user']);
    $password   = 'dokterlab';

    // Update ke database
    $con->exec("UPDATE user SET password = md5('$password') WHERE id_user = '$id_user' ");

    $_SESSION['msg'] = alert('success', 'Password berhasil direset');

    header('Location: ../dokter');
}
