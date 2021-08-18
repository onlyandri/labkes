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

    // $periode     = "<h4 class='text-center' style='margin-bottom: 50px'>Periode Awal S/D Akhir</h4>";
} else {

    $tgl_awal  = tglSql($_GET['tgl_awal']);
    $tgl_akhir = tglSql($_GET['tgl_akhir']);

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
    // $periode     = "<h4 class='text-center' style='margin-bottom: 50px'>Periode " . $tgl_awal_t . " S/D " . $tgl_akhir_t . "</h4>";
}

$sql = $con->query($q);
$trow = $sql->rowCount();
?>

<div id="print">

    <table id="mytable" class="table table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center" width="1%">No.</th>
                <th width="15%">Jenis Pemeriksaan</th>
                <th>Sub Pemeriksaan</th>
                <th width="15%" class="text-center">Jumlah Pemeriksaan</th>
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
</div>