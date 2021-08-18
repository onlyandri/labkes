<?php
require_once '_akses.php';

$pemeriksaan_id = $_GET['pemeriksaan_id'];
$sql_jenis_pemeriksaan = $con->query("SELECT nama_pemeriksaan FROM jenis_pemeriksaan WHERE id_pemeriksaan = '$pemeriksaan_id' ");
$row_jenis_pemeriksaan = $sql_jenis_pemeriksaan->fetch(PDO::FETCH_LAZY);
$trow_jenis_pemeriksaan = $sql_jenis_pemeriksaan->rowCount();
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
          Tambah Sub Pemeriksaan
          <small><?php echo $row_jenis_pemeriksaan->nama_pemeriksaan; ?></small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">

        <form id="myform" method="POST" enctype="multipart/form-data" action="_proses/sub_pemeriksaan_proses">

          <?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : '';  ?>

          <!-- Default box -->
          <div class="box box-solid">

            <div class="box-body">
              <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="form-group">
                    <label class="wajib" for="namaSubp">Nama Sub Pemeriksaan</label>
                    <input id="namaSubp" class="form-control" type="text" name="nama_sub_periksa" data-validetta="required">
                  </div>
                  <!-- /.form-group -->
                </div>

              </div>
              <!-- ./row -->
            </div>
            <!-- /.box-body -->


            <div class="box-footer">
              <input type="hidden" name="pemeriksaan_id" value="<?php echo $pemeriksaan_id; ?>">
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
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <!-- Sidebar Menu Active -->
  <script>
    $('#nav-pemeriksaan').addClass('active');

    // Valideta
    $("#myform").validetta({
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