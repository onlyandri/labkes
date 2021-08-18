<?php
require_once '_akses.php';

/* ======================================================================
[Tampil Data] */
$id_pasien = $_GET['id'];
if (empty($_GET['id'])) {
    header("Location: pemeriksaan_pasien");
}
$periode = '';
if (!isset($_GET['tgl_awal']) && !isset($_GET['tgl_akhir'])) {
    $q = "SELECT p.*, pp.tgl_periksa, pp.ket_klinis, pp.id_pp,
            GROUP_CONCAT(sp.nama_sub_periksa ORDER BY sp.nama_sub_periksa ASC SEPARATOR ', ') AS list_periksa
            FROM pemeriksaan_pasien pp
            JOIN pasien p
            ON p.id_pasien = pp.pasien_id
            JOIN tes_pasien tp
            ON tp.pp_id = pp.id_pp
            INNER JOIN sub_periksa sp
            ON sp.id_sub_periksa = tp.sub_periksa_id
            WHERE pp.pasien_id = '$id_pasien'
            GROUP BY pp.id_pp
            ORDER BY pp.id_pp DESC";

    $periode     = "<h4 class='text-center' style='margin-bottom: 50px'>Periode Awal S/D Akhir</h4>";
} else {

    $tgl_awal  = tglSql($_GET['tgl_awal']);
    $tgl_akhir = tglSql($_GET['tgl_akhir']);

    $q = "SELECT p.*, pp.tgl_periksa, pp.ket_klinis, pp.id_pp,
            GROUP_CONCAT(sp.nama_sub_periksa ORDER BY sp.nama_sub_periksa ASC SEPARATOR ', ') AS list_periksa
            FROM pemeriksaan_pasien pp
            JOIN pasien p
            ON p.id_pasien = pp.pasien_id
            JOIN tes_pasien tp
            ON tp.pp_id = pp.id_pp
            INNER JOIN sub_periksa sp
            ON sp.id_sub_periksa = tp.sub_periksa_id
            WHERE pp.pasien_id = '$id_pasien' 
            AND pp.tgl_periksa BETWEEN '$tgl_awal' AND '$tgl_akhir'
            GROUP BY pp.id_pp
            ORDER BY pp.id_pp DESC";

    $tgl_awal_t  = longDate($tgl_awal);
    $tgl_akhir_t = longDate($tgl_akhir);
    if ($tgl_awal_t == $tgl_akhir_t) {
        $periode     = $tgl_awal_t;
    } else {
        $periode     = $tgl_awal_t . " S/D " . $tgl_akhir_t;
    }
}

$sql = $con->query($q);
$row = $sql->fetch(PDO::FETCH_LAZY);
$trow = $sql->rowCount();

$sql_dokter = $con->query("SELECT * FROM dokter ORDER BY id_dokter ASC LIMIT 1 ");
$row_dokter = $sql_dokter->fetch(PDO::FETCH_LAZY);
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
        Rekam Medis Pasien Laboratorium Kesehatan<br>
        Dinas Kesehatan Kabupaten Pekalongan
    </h2>
    <hr>

    <!-- Informasi Pasien -->
    <table width="100%" style="margin-top:50px; margin-bottom: 50px;">
        <tr>
            <th width="20%">ID Pasien</th>
            <td style="text-transform: uppercase;">: <?php echo $row->id_pasien; ?></td>
        </tr>
        <tr>
            <th>Nama Pasien</th>
            <td style="text-transform: uppercase;">: <?php echo $row->nama_pasien; ?></td>
        </tr>
        <tr>
            <th>Tgl. Lahir / Umur</th>
            <td style="text-transform: uppercase;">: <?php echo longDate($row->tgl_lahir) . " (" . umur($row->tgl_lahir) . ")"; ?></td>
        </tr>
        <tr>
            <th>J. Kelamin</th>
            <td style="text-transform: uppercase;">: <?php echo kelamin($row->jk); ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td style="text-transform: uppercase;">: <?php echo $row->alamat; ?></td>
        </tr>
        <tr>
            <th>Periode Pemeriksaan</th>
            <td style="text-transform: uppercase;">: <?php echo $periode; ?></td>
        </tr>
    </table>

    <!-- Riwayat Pemeriksaan -->
    <table id="mytable" class="table table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>Tgl. Periksa</th>
                <th>Ket. Klinis</th>
                <th>Pemeriksaan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($trow)) : $no = 1; ?>
                <?php do {

                ?>
                    <tr>
                        <td class="text-center"><?php echo $no;
                                                $no++; ?></td>
                        <td><?php echo longDate($row->tgl_periksa); ?></td>
                        <td><?php echo $row->ket_klinis; ?></td>
                        <td><?php echo $row->list_periksa; ?></td>
                    </tr>
                <?php } while ($row = $sql->fetch(PDO::FETCH_LAZY)); ?>
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
            <p><?php echo $row_dokter->nama_dokter; ?></p>
        </div>
    </div>
    <input type="hidden" id="id_pasien" value="<?php echo $id_pasien; ?>">

    <!-- jQuery 3 -->
    <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        id_pasien = $("#id_pasien").val()
        setTimeout(function() {
            window.top.location = "rekam_medis?id=" + id_pasien
        }, 1000);
    </script>
</body>

</html>