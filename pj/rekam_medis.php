<?php
require_once '_akses.php';

$id_pasien = $_GET['id'];
$sql = $con->query("SELECT p.*, pp.tgl_periksa, pp.ket_klinis, pp.id_pp,
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
                    ORDER BY pp.id_pp DESC ");
$row = $sql->fetch(PDO::FETCH_LAZY);
$trow = $sql->rowCount();
$tgl_akhir_periksa = $row->tgl_periksa;
if (empty($trow)) {
    header("Location: pasien");
}

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
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Valideta -->
    <link rel="stylesheet" href="../assets/bower_components/validetta/validetta.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- partial::header -->
        <?php include '_header.php'; ?>
        <!-- =============================================== -->

        <!-- partial::sidebar_menu -->
        <?php include '_sidebar_menu.php'; ?>
        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Rekam Medis Pasien
                    <small><?php echo $row->id_pasien . ' - ' . $row->nama_pasien; ?></small>

                    <!-- Tombol battom -->
                    <div class="pull-right">
                        <a class="btn btn-success btn-sm" data-toggle="modal" href='#modal-rekam-medis'>Cetak Rekam Medis</a>
                    </div>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">

                <?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : '';  ?>

                <!-- Default box -->
                <div class="box box-solid">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Informasi Pasien
                        </h3>
                    </div>

                    <div class="box-body">
                        <table width="100%">
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
                                <th>Telepon</th>
                                <td style="text-transform: uppercase;">: <?php echo $row->tlp; ?></td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Rekam Medis
                        </h3>
                    </div>

                    <div class="box-body">

                        <table id="mytable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th width="10%">Tgl. Periksa</th>
                                    <th>Ket. Klinis</th>
                                    <th>Pemeriksaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($trow)) : $no = 1; ?>
                                    <?php do {

                                    ?>
                                        <tr>
                                            <td><?php echo $no;
                                                $no++; ?></td>
                                            <td><?php echo longDate($row->tgl_periksa); ?></td>
                                            <td><?php echo $row->ket_klinis; ?></td>
                                            <td><?php echo $row->list_periksa; ?></td>
                                        </tr>
                                    <?php
                                        $tgl_awal_periksa = $row->tgl_periksa;
                                    } while ($row = $sql->fetch(PDO::FETCH_LAZY)); ?>
                                <?php endif ?>
                            </tbody>
                        </table>

                        <input type="hidden" id="tgl_awal_periksa" value="<?php echo $tgl_awal_periksa; ?>">
                        <input type="hidden" id="tgl_akhir_periksa" value="<?php echo $tgl_akhir_periksa; ?>">

                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->

                <!-- Modal rekam medis -->
                <div class="modal fade" id="modal-rekam-medis">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form method="get" action="rekam_medis_cetak">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Cetak Rekam Medis Pasien</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Awal</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="tgl_awal" class="form-control pull-right" id="tgl_awal" autocomplete="off" readonly data-validetta="required" style="background-color: white;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Akhir</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="tgl_akhir" class="form-control pull-right" id="tgl_akhir" autocomplete="off" readonly data-validetta="required" style="background-color: white;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id" value="<?php echo $id_pasien; ?>">
                                    <button type="submit" class="btn btn-success">Cetak</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- partial::sidebar_menu -->
        <?php include '_footer.php'; ?>
        <!-- =============================================== -->

    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Form Validation -->
    <script src="../assets/bower_components/validetta/regex-input.js"></script>
    <!-- Valideta -->
    <script src="../assets/bower_components/validetta/validetta.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <!-- Sidebar Menu Active -->
    <script>
        $('#nav-periksa_pasien').addClass('active');

        // Valideta
        $("#myform").validetta({
            // errorTemplateClass : 'validetta-bubble',
            // bubblePosition: 'bottom', // Bubble position // right / bottom
            errorTemplateClass: 'validetta-inline',
            bubblePosition: 'inline',
            realTime: true
        });
    </script>

    <!-- date picker script -->
    <script>
        tgl_awal_periksa = new Date($("#tgl_awal_periksa").val());
        tgl_akhir_periksa = new Date($("#tgl_akhir_periksa").val());
        $('#tgl_awal').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true,
            startDate: tgl_awal_periksa,
            endDate: tgl_akhir_periksa,
        }).on('changeDate', function(selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#tgl_akhir').datepicker('setStartDate', maxDate);
        });
        $('#tgl_akhir').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true,
            startDate: tgl_awal_periksa,
            endDate: tgl_akhir_periksa,
        }).on('changeDate', function(selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#tgl_awal').datepicker('setEndDate', maxDate);
        });
    </script>
</body>

</html>
<?php unset($_SESSION['msg']); ?>