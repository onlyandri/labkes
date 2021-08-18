<?php
require_once '_akses.php';

/* ======================================================================
[Tampil Data] */
$periode = '';
if (!isset($_GET['tgl_awal']) && !isset($_GET['tgl_akhir'])) {
    $q = "SELECT pp.pasien_id, tp.sub_periksa_id, jp.nama_pemeriksaan, sp.nama_sub_periksa, pp.tgl_periksa,
                (SELECT count(tp2.sub_periksa_id) AS jml_pemeriksaan FROM tes_pasien tp2 WHERE tp2.sub_periksa_id = tp.sub_periksa_id ) AS jml_pemeriksaan
                FROM tes_pasien tp
                JOIN pemeriksaan_pasien pp
                    ON pp.id_pp = tp.pp_id
                JOIN sub_periksa sp
                    ON sp.id_sub_periksa = tp.sub_periksa_id
                JOIN jenis_pemeriksaan jp
                    ON jp.id_pemeriksaan = sp.pemeriksaan_id
                JOIN pasien p
                    ON p.id_pasien = pp.pasien_id
                GROUP BY jp.nama_pemeriksaan ASC, sp.nama_sub_periksa ASC";

    $periode     = "<h4 class='text-center' style='margin-top: 50px; margin-bottom: 20px'>Periode Awal S/D Akhir</h4>";
} else {

    $tgl_awal  = $_GET['tgl_awal'];
    $tgl_akhir = $_GET['tgl_akhir'];

    $q = "SELECT pp.pasien_id, tp.sub_periksa_id, jp.nama_pemeriksaan, sp.nama_sub_periksa, pp.tgl_periksa,
                (SELECT count(tp2.sub_periksa_id) AS jml_pemeriksaan FROM tes_pasien tp2 WHERE tp2.sub_periksa_id = tp.sub_periksa_id ) AS jml_pemeriksaan
                FROM tes_pasien tp
                JOIN pemeriksaan_pasien pp
                    ON pp.id_pp = tp.pp_id
                JOIN sub_periksa sp
                    ON sp.id_sub_periksa = tp.sub_periksa_id
                JOIN jenis_pemeriksaan jp
                    ON jp.id_pemeriksaan = sp.pemeriksaan_id
                JOIN pasien p
                    ON p.id_pasien = pp.pasien_id
                WHERE pp.tgl_periksa BETWEEN '$tgl_awal' AND '$tgl_akhir'
                GROUP BY jp.nama_pemeriksaan ASC, sp.nama_sub_periksa ASC";

    $tgl_awal_t  = longDate($tgl_awal);
    $tgl_akhir_t = longDate($tgl_akhir);
    $periode     = "<h4 class='text-center' style='margin-top: 50px; margin-bottom: 20px'>Periode " . $tgl_awal_t . " S/D " . $tgl_akhir_t . "</h4>";
}

$sql = $con->query($q);
$trow = $sql->rowCount();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laboratorium Kesehatan Daerah</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onLoad="window.print()">
    <h2 class="text-center">
        Laporan Pemeriksaan Laboratorium Kesehatan<br>
        Dinas Kesehatan Kabupaten Pekalongan
    </h2>
    <hr>
    <?php echo $periode; ?>

    <table id="mytable" class="table table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center" width="1%">No.</th>
                <th>Jenis Pemeriksaan</th>
                <th>Sub Pemeriksaan</th>
                <th class="text-center">Jumlah Pemeriksaan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($trow)) : $no = 1; ?>
                <?php while ($row = $sql->fetch(PDO::FETCH_LAZY)) {

                ?>
                    <tr>
                        <td class="text-center"><?php echo $no;
                                                $no++; ?></td>
                        <td><?php echo $row->nama_pemeriksaan; ?></td>
                        <td><?php echo $row->nama_sub_periksa; ?></td>
                        <td class="text-center"><?php echo $row->jml_pemeriksaan; ?></td>
                    </tr>
                <?php } ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" class="text-center"><i> Tidak ada data yang ditampilkan</i></td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>

    <!-- Tanda Tangan
        ========================================================= -->
    <div class="row" style="margin-top: 40px">
        <div class="col-xs-4" style="text-align: center">

        </div>
        <div class="col-xs-4" style="text-align: center">
        </div>
        <div class="col-xs-4" style="text-align: center">
            <p>Pekalongan, <?php echo longDate(date("Y-m-d")); ?></p>
            <p>Dokter Penanggung Jawab,</p>
            <br>
            <br>
            <br>
            <p><?php echo $nama_akun; ?></p>
        </div>
    </div>

    <!-- jQuery 3 -->
    <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        setTimeout(function() {
            window.top.location = "laporan"
        }, 1000);
    </script>
</body>

</html>