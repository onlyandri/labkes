<?php
require_once '_akses.php';

/* ======================================================================
[Tombol Cetak] */
if ((isset($_GET["fcetak"])) && ($_GET["fcetak"] == "y")) {
    $tgl_awal   = htmlspecialchars(tglSql($_GET['tgl_awal']));
    $tgl_akhir  = htmlspecialchars(tglSql($_GET['tgl_akhir']));
    header('Location: laporan_cetak?tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
}

$hari_ini = date("Y-m-d");
$tgl_awal = date('01/m/Y', strtotime($hari_ini));
$tgl_akhir = date('t/m/Y', strtotime($hari_ini));

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
    <!-- Valideta -->
    <link rel="stylesheet" href="../assets/bower_components/validetta/validetta.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
                    Laporan Pemeriksaan

                    <!-- Tombol Pilihan -->
                    <div class="pull-right">
                        <!-- <button class="btn btn-success btn-sm" onclick="window.print()"><i class="fa fa-print"></i> Cetak</button> -->
                    </div>
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">

                <?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : '';  ?>

                <!-- Default box -->
                <div class="box box-solid">

                    <div class="box-body">
                        <form id="form-filter">
                            <div class="row">

                                <form method="get">
                                    <div class="col-md-3">
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

                                    <div class="col-md-3">
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>&nbsp</label>
                                            <div class="input-group date">
                                                <button id="tombol-filter" type="button" class="btn bg-purple">Tampilkan</button>
                                                &nbsp&nbsp
                                                <button type="submit" class="btn btn-success" name="fcetak" value="y">Cetak</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->


                <!-- Default box -->
                <div id="print" class="box box-solid">

                    <div id="tampil-data" class="box-body" style="padding-bottom: 50px">

                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->


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
    <!-- Valideta -->
    <script src="../assets/bower_components/validetta/validetta.min.js"></script>
    <!-- DataTables -->
    <script src="../assets/bower_components/datatables.net/js/jquery.dataTables.js"></script>
    <script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <!-- Sidebar Menu Active -->
    <script>
        $('#nav-laporan').addClass('active');
    </script>

    <!-- datatable script -->
    <script>
        $(function() {
            $('#mytable').DataTable({
                'paging': false,
                'lengthChange': false,
                'searching': false,
                'ordering': false,
                'info': false,
                'autoWidth': false
            })
        })
    </script>

    <!-- date picker script -->
    <script>
        $('#tgl_awal').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true,
            endDate: '+1d',
        }).on('changeDate', function(selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#tgl_akhir').datepicker('setStartDate', maxDate);
        });
        // $("#tgl_awal").datepicker("setDate", new Date());
        $('#tgl_akhir').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true,
            endDate: '+1d',
        }).on('changeDate', function(selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#tgl_awal').datepicker('setEndDate', maxDate);
        });
    </script>

    <script>
        $('#tampil-data').load("laporan_pemeriksaan_tampil.php");

        $("#tombol-filter").on('click', function(e) {
            var data = $('#form-filter').serialize();
            var awal = $('#tgl_awal').val();
            var akhir = $('#tgl_akhir').val();

            if (awal == '' && akhir == '') {
                alert('Harap tentukan parameter tanggal');
            } else {
                $.ajax({
                    type: 'get',
                    url: "laporan_pemeriksaan_tampil.php",
                    data: data,
                    success: function(response) {
                        $('#tampil-data').html(response);
                    }
                });
                console.log(data);
            }
        });

        // Valideta
        $("#form-filter").validetta({
            // errorTemplateClass : 'validetta-bubble',
            // bubblePosition: 'bottom', // Bubble position // right / bottom
            errorTemplateClass: 'validetta-inline',
            bubblePosition: 'inline',
            realTime: true
        });
    </script>
</body>

</html>
<?php unset($_SESSION['msg']); ?>