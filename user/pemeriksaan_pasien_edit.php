<?php
require_once '_akses.php';

$id_pp = $_GET['id'];
$sql_pasien = $con->query("SELECT pp.*, p.id_pasien, p.nama_pasien, p.tgl_daftar 
                                FROM pemeriksaan_pasien pp
                                JOIN pasien p
                                ON p.id_pasien = pp.pasien_id
                                WHERE pp.id_pp = '$id_pp' ");
$row_pasien = $sql_pasien->fetch(PDO::FETCH_LAZY);
$trow_pasien = $sql_pasien->rowCount();
if (empty($trow_pasien)) {
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
                    Edit Pemeriksaan Pasien
                    <small><?php echo $row_pasien->id_pasien . ' - ' . $row_pasien->nama_pasien; ?></small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">

                <form id="myform" method="POST" enctype="multipart/form-data" action="_proses/pemeriksaan_pasien_proses">

                    <?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : '';  ?>

                    <!-- Default box -->
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Informasi Pasien
                            </h3>
                        </div>

                        <div class="box-body">
                            <div class="row">


                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="wajib" for="tglPeriksa">Tgl. Periksa</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input id="tglPeriksa" class="form-control" type="text" name="tgl_periksa" data-validetta="required" value="<?php echo tglIndo($row_pasien->tgl_periksa); ?>" readonly style="background-color: white;">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label for="ketKlinis">Ket. Klinis</label>
                                        <input id="ketKlinis" class="form-control" type="text" name="ket_klinis" value="<?php echo $row_pasien->ket_klinis; ?>">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                            </div>
                            <!-- ./row -->
                        </div>
                        <!-- /.box-body -->

                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Jenis Pemeriksaan
                            </h3>
                        </div>

                        <div class="box-body">

                            <?php
                            $sql_pemeriksaan = $con->query("SELECT * FROM jenis_pemeriksaan ORDER BY id_pemeriksaan ASC ");
                            while ($row_pemeriksaan = $sql_pemeriksaan->fetch(PDO::FETCH_LAZY)) {
                            ?>
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <b><?php echo $row_pemeriksaan->nama_pemeriksaan; ?></b>
                                    </div>

                                    <?php
                                    $sql_sub_periksa = $con->query("SELECT * FROM sub_periksa WHERE pemeriksaan_id = '$row_pemeriksaan->id_pemeriksaan' ORDER BY id_sub_periksa ASC ");
                                    while ($row_sub_periksa = $sql_sub_periksa->fetch(PDO::FETCH_LAZY)) {

                                        $sql_tes = $con->query("SELECT * FROM tes_pasien WHERE pp_id = '$row_pasien->id_pp' AND sub_periksa_id = '$row_sub_periksa->id_sub_periksa' ");
                                        $row_tes = $sql_tes->fetch(PDO::FETCH_LAZY);
                                    ?>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="sub_periksa_id[]" value="<?php echo $row_sub_periksa->id_sub_periksa; ?>" <?php terconteng($row_tes['sub_periksa_id'], $row_sub_periksa->id_sub_periksa); ?>> <?php echo $row_sub_periksa->nama_sub_periksa; ?>
                                                </label>
                                            </div>
                                            <!-- /.checkbox -->
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- ./row -->
                            <?php } ?>


                        </div>
                        <!-- /.box-body -->


                        <div class="box-footer">
                            <input type="hidden" name="id_pp" value="<?php echo $id_pp; ?>" readonly>
                            <input type="hidden" id="tgl_daftar" value="<?php echo $row_pasien->tgl_daftar; ?>" readonly>
                            <button type="submit" class="btn btn-success pull-right" name="fedit" value="y"><i class="fa fa-floppy-o"></i> Simpan</button>
                        </div>
                        <!-- /.box-footer-->

                    </div>
                    <!-- /.box -->
                </form>

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
        tgl_daftar = new Date($("#tgl_daftar").val());
        $('#tglPeriksa').datepicker({
            format: "dd/mm/yyyy",
            todayHighlight: true,
            startDate: tgl_daftar,
            endDate: '+1d',
            autoclose: true,
            orientation: "bottom"
        })
    </script>
</body>

</html>
<?php unset($_SESSION['msg']); ?>