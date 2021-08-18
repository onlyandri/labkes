<?php
require_once '_akses.php';

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
                    Tambah Data Dokter
                    <!-- <small>it all starts here</small> -->
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">

                <form id="myform" method="POST" enctype="multipart/form-data" action="_proses/dokter_proses">

                    <?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : '';  ?>

                    <!-- Default box -->
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Informasi Dokter
                            </h3>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label class="wajib" for="namaDokter">Nama Dokter</label>
                                        <input id="namaDokter" class="form-control" type="text" maxlength="100" name="nama_dokter" data-validetta="required">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="wajib" for="Spesifikasi">Spesialisasi</label>
                                        <input id="Spesifikasi" class="form-control" type="text" maxlength="100" name="spesifikasi" data-validetta="required">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="Tlp">Telepon</label>
                                        <input id="Tlp" class="form-control" type="text" maxlength="14" name="tlp" onKeyPress="return goodchars(event,'+0123456789',this)">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="form-group">
                                        <label for="Alamat">Alamat</label>
                                        <input id="Alamat" class="form-control" type="text" name="alamat">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                            </div>
                            <!-- ./row -->
                        </div>
                        <!-- /.box-body -->

                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Akun
                            </h3>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label class="wajib" for="username">Username</label>
                                        <input id="username" class="form-control" type="text" maxlength="20" name="username" data-validetta="required" autocomplete="off">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label class="wajib" for="password">Password </label> <small>Password Default (dokterlab)</small>
                                        <input id="password" class="form-control" type="password" maxlength="20" name="password" data-validetta="required" value="dokterlab" readonly>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                            </div>
                            <!-- ./row -->
                        </div>
                        <!-- /.box-body -->


                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right" name="fsimpan" value="y"><i class="fa fa-floppy-o"></i> Simpan</button>
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
        $('#nav-dokter').addClass('active');

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
        $('#tglDaftar').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            orientation: "bottom"
        })
        $('#tglLahir').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            orientation: "bottom"
        })
    </script>
</body>

</html>
<?php unset($_SESSION['msg']); ?>