<?php
require_once '_akses.php';

/* ======================================================================
[Tampil Data] */

// Persediaan query
$q = "SELECT * FROM jenis_pemeriksaan ORDER BY id_pemeriksaan ASC ";
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
          Jenis Pemeriksaan
          <!-- <small></small> -->

          <!-- Tombol battom -->
          <div class="pull-right">
            <a href="pemeriksaan_tambah" class="btn bg-purple btn-sm">Tambah Baru</a>
            <!-- <a href="pemeriksaan_cetak" class="btn btn-default btn-sm">Cetak</a> -->
          </div>

        </h1>

      </section>

      <!-- Main content -->
      <section class="content">

        <?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : '';  ?>

        <!-- Default box -->
        <div class="box box-solid">

          <div class="box-body table-responsive">
            <table id="mytable" class="table table-hover">
              <thead>
                <tr>
                  <th width="1%">No.</th>
                  <th width="auto">Jenis Pemeriksaan</th>
                  <th width="12%">Sub Pemeriksaan</th>
                  <th class="text-center" width="10%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($trow)) : $no = 1; ?>
                  <?php while ($row = $sql->fetch(PDO::FETCH_LAZY)) {

                  ?>
                    <tr>
                      <td><?php echo $no;
                          $no++; ?></td>
                      <td><?php echo $row->nama_pemeriksaan; ?></td>
                      <td><a href="sub_pemeriksaan?pemeriksaan_id=<?php echo $row->id_pemeriksaan; ?>" class="btn btn-info btn-xs">Sub Pemeriksaan</a></td>
                      <td>
                        <!-- Tombol Aksi -->
                        <div class="pull-right">
                          <form method="POST" action="_proses/pemeriksaan_proses">
                            <a href='pemeriksaan_edit?id=<?php echo $row->id_pemeriksaan; ?>' class='btn bg-orange btn-xs'>Edit</a>
                            <button type="submit" onclick="return confirm('Anda yakin akan menghapus data ini ?')" class='btn bg-maroon btn-xs' name="fhapus" value="y">Hapus</button>
                            <input type="hidden" name="id_pemeriksaan" value="<?php echo $row->id_pemeriksaan; ?>" />
                          </form>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                <?php endif ?>
              </tbody>
            </table>
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
  <!-- DataTables -->
  <script src="../assets/bower_components/datatables.net/js/jquery.dataTables.js"></script>
  <script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- bootstrap datepicker -->
  <script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <!-- Sidebar Menu Active -->
  <script>
    $('#nav-pemeriksaan').addClass('active');
  </script>

  <!-- datatable script -->
  <script>
    $(function() {
      $('#mytable').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': false
      })
    })
  </script>

  <!-- date picker script -->
  <script>
    $('#tgl_awal').datepicker({
      format: "dd/mm/yyyy",
      autoclose: true
    })
    $('#tgl_akhir').datepicker({
      format: "dd/mm/yyyy",
      autoclose: true
    })
  </script>
</body>

</html>
<?php unset($_SESSION['msg']); ?>