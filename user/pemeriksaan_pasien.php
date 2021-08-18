<?php
require_once '_akses.php';

/* ======================================================================
[Tampil Data] */
// query
$q = "SELECT p.id_pasien, p.nama_pasien, pp.tgl_periksa, pp.ket_klinis, pp.id_pp,
                GROUP_CONCAT(sp.nama_sub_periksa ORDER BY sp.nama_sub_periksa ASC SEPARATOR ', ') AS list_periksa
                FROM pemeriksaan_pasien pp
                JOIN pasien p
                ON p.id_pasien = pp.pasien_id
                JOIN tes_pasien tp
                ON tp.pp_id = pp.id_pp
                INNER JOIN sub_periksa sp
                ON sp.id_sub_periksa = tp.sub_periksa_id
                GROUP BY pp.id_pp
                ORDER BY pp.id_pp DESC ";
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
    <!-- Select2 -->
    <link rel="stylesheet" href="../assets/bower_components/select2/dist/css/select2.min.css">
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
                    Data Pemeriksaan Pasien
                    <!-- <small></small> -->

                    <!-- Tombol battom -->
                    <div class="pull-right">
                        <a class="btn bg-purple btn-sm" data-toggle="modal" href='#modal-tambah'>Tambah Baru</a>
                        <a class="btn btn-success btn-sm" data-toggle="modal" href='#modal-rekam-medis'>Rekam Medis Pasien</a>
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
                                    <th width="10%">Tgl. Periksa</th>
                                    <th width="8%">ID Pasien</th>
                                    <th width="15%">Nama Pasien</th>
                                    <th width="auto">Pemeriksaan</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($trow)) : $no = 1; ?>
                                    <?php while ($row = $sql->fetch(PDO::FETCH_LAZY)) {

                                    ?>
                                        <tr>
                                            <td><?php echo $no;
                                                $no++; ?></td>
                                            <td><?php echo longDate($row->tgl_periksa); ?></td>
                                            <td><?php echo $row->id_pasien; ?></td>
                                            <td><?php echo $row->nama_pasien; ?></td>
                                            <td><?php echo $row->list_periksa; ?></td>
                                            <td>
                                                <!-- Tombol Aksi -->
                                                <div class="pull-right">
                                                    <form method="POST" action="_proses/pemeriksaan_pasien_proses">
                                                        <a href='pemeriksaan_pasien_edit?id=<?php echo $row->id_pp; ?>' class='btn bg-orange btn-xs'>Edit</a>
                                                        <button type="submit" onclick="return confirm('Anda yakin akan menghapus data ini ?')" class='btn bg-maroon btn-xs' name="fhapus" value="y">Hapus</button>
                                                        <input type="hidden" name="id" value="<?php echo $row->id_pp; ?>" />
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

                <!-- Modal tambah baru -->
                <div class="modal fade" id="modal-tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form method="get" action="pemeriksaan_pasien_tambah">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Tambah Pemeriksaan Pasien</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Pilih Pasien</label>
                                        <select id="listPasien" class="form-control" name="id" data-validetta="required" style="width: 100%;">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Modal rekam medis -->
                <div class="modal fade" id="modal-rekam-medis">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form method="get" action="rekam_medis">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Rekam Medis Pasien</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Pilih Pasien</label>
                                        <select id="listPasien2" class="form-control" name="id" data-validetta="required" style="width: 100%;">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Tampilkan</button>
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
    <!-- DataTables -->
    <script src="../assets/bower_components/datatables.net/js/jquery.dataTables.js"></script>
    <script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Select2 -->
    <script src="../assets/bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <!-- Sidebar Menu Active -->
    <script>
        $('#nav-periksa_pasien').addClass('active');
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

    <!-- Select2 -->
    <script>
        $('#listPasien').select2({
            placeholder: "Pilih Pasien",
            allowClear: true,
            ajax: {
                url: '_proses/list_pasien',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('#listPasien2').select2({
            placeholder: "Pilih Pasien",
            allowClear: true,
            ajax: {
                url: '_proses/list_pasien',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    </script>
</body>

</html>
<?php unset($_SESSION['msg']); ?>