<?php
require_once '_akses.php';

/* ======================================================================
[Proses simpan] */
if ((isset($_POST["fsimpan"])) && ($_POST["fsimpan"] == "y")) {
    $id_pasien    = htmlspecialchars($_POST['id_pasien']);
    $tgl_periksa  = htmlspecialchars(tglSql($_POST['tgl_periksa']));
    $ket_klinis   = htmlspecialchars($_POST['ket_klinis']);
    if ($ket_klinis == '') {
        $ket_klinis = '-';
    }

    $sqlMaxID = $con->query("SELECT max(id_pp) AS maxID FROM pemeriksaan_pasien ");
    $rowMaxID = $sqlMaxID->fetch(PDO::FETCH_LAZY);
    $id_pp = $rowMaxID['maxID'] + 1;
    if ($id_pp == NULL) {
        $id_pp = 1;
    }

    // Simpan ke database
    $con->exec("INSERT INTO pemeriksaan_pasien (id_pp, tgl_periksa, ket_klinis, pasien_id)
                          VALUES ('$id_pp', '$tgl_periksa', '$ket_klinis', '$id_pasien')");

    for ($i = 0; $i < count($_POST['sub_periksa_id']); $i++) {
        $sub_periksa_id = $_POST['sub_periksa_id'][$i];

        $con->exec("INSERT INTO tes_pasien (pp_id, sub_periksa_id)
                          VALUES ('$id_pp', '$sub_periksa_id')");
    }

    $_SESSION['msg'] = alert('success', 'Data pemeriksaan berhasil ditambahkan');

    header('Location: ../pemeriksaan_pasien');
}


/* ======================================================================
[Proses edit] */
if ((isset($_POST["fedit"])) && ($_POST["fedit"] == "y")) {
    $id_pp          = htmlspecialchars($_POST['id_pp']);
    $tgl_periksa    = htmlspecialchars(tglSql($_POST['tgl_periksa']));
    $ket_klinis     = htmlspecialchars($_POST['ket_klinis']);
    if ($ket_klinis == '') {
        $ket_klinis = '-';
    }

    // Update ke database
    $con->exec("UPDATE pemeriksaan_pasien SET tgl_periksa = '$tgl_periksa', ket_klinis = '$ket_klinis' WHERE id_pp = '$id_pp' ");

    $con->exec("DELETE FROM tes_pasien WHERE pp_id='$id_pp' ");

    for ($i = 0; $i < count($_POST['sub_periksa_id']); $i++) {
        $sub_periksa_id = $_POST['sub_periksa_id'][$i];

        $con->exec("INSERT INTO tes_pasien (pp_id, sub_periksa_id)
                          VALUES ('$id_pp', '$sub_periksa_id')");
    }

    $_SESSION['msg'] = alert('success', 'Perubahan berhasil disimpan');

    header('Location: ../pemeriksaan_pasien');
}


/* ======================================================================
[Proses hapus] */
if ((isset($_POST["fhapus"])) && ($_POST["fhapus"] == "y")) {
    $id_pp   = htmlspecialchars($_POST['id']);

    // Hapus ke database
    $con->exec("DELETE FROM pemeriksaan_pasien WHERE id_pp='$id_pp' ");
    $con->exec("DELETE FROM tes_pasien WHERE pp_id='$id_pp' ");

    $_SESSION['msg'] = alert('success', 'Data berhasil dihapus');

    header('Location: ../pemeriksaan_pasien');
}
