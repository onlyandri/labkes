<?php
require_once '_akses.php';

$id_pasien = $_GET['id'];
$sql_pasien = $con->query("SELECT * FROM pasien WHERE id_pasien = '$id_pasien' ");
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
                    Edit Pendaftaran Pasien
                    <!-- <small>it all starts here</small> -->
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">

                <form id="myform" method="POST" enctype="multipart/form-data" action="_proses/pasien_proses">

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
                                        <label class="wajib" for="IDPasien">ID Pasien</label>
                                        <input id="IDPasien" class="form-control" type="text" name="id_pasien" data-validetta="required" value="<?php echo $id_pasien; ?>" readonly>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="wajib" for="tglDaftar">Tgl. Daftar</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input id="tglDaftar" class="form-control" type="text" name="tgl_daftar" data-validetta="required" value="<?php echo tglIndo($row_pasien->tgl_daftar); ?>" readonly style="background-color: white;">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="wajib" for="namaPasien">Nama Pasien</label>
                                        <input id="namaPasien" class="form-control" type="text" maxlength="100" name="nama_pasien" data-validetta="required" value="<?php echo $row_pasien->nama_pasien; ?>">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="wajib" for="tglLahir">Tgl. Lahir</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input id="tglLahir" class="form-control" type="text" name="tgl_lahir" data-validetta="required" readonly value="<?php echo tglIndo($row_pasien->tgl_lahir); ?>" style="background-color: white;">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="wajib" for="jk_w">Jenis Kelamin</label>
                                        <select id="jk_w" class="form-control" name="jk" data-validetta="required">
                                            <option value="L" <?php cbTerpilih('L', $row_pasien->jk); ?>>Laki-laki</option>
                                            <option value="P" <?php cbTerpilih('P', $row_pasien->jk); ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="wajib" for="Tlp">Telepon</label>
                                        <input id="Tlp" class="form-control" type="text" maxlength="14" name="tlp" onKeyPress="return goodchars(event,'+0123456789',this)" value="<?php echo $row_pasien->tlp; ?>" data-validetta="required">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="wajib" for="Alamat">Alamat</label>
                                        <input id="Alamat" class="form-control" type="text" name="alamat" data-validetta="required" value="<?php echo $row_pasien->alamat; ?>">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                            </div>
                            <!-- ./row -->
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
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
        $('#nav-pasien').addClass('active');

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
            todayHighlight: true,
            endDate: '+1d',
            autoclose: true,
            orientation: "bottom",
        })
        $('#tglLahir').datepicker({
            format: "dd/mm/yyyy",
            todayHighlight: true,
            endDate: '+1d',
            autoclose: true,
            orientation: "bottom"
        })
    </script>
</body>

</html>
<?php unset($_SESSION['msg']); ?>