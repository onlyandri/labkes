<!-- Default box -->
<div class="box box-solid">

  <div class="box-header with-border">
    <h3 class="box-title">
      <i class="fa fa-info-circle"></i> 5 Pendaftaran Pasien Terbaru
    </h3>
  </div>
  <!-- /.box-header -->

  <?php
  $sql_pendaftaran = $con->query("SELECT * FROM pasien ORDER BY id_pasien DESC LIMIT 5 ");
  $trow_pendaftaran = $sql_pendaftaran->rowCount();

  ?>
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <tr>
        <th width="1%">No.</th>
        <th>Tgl. Daftar</th>
        <th>ID Pasien</th>
        <th>Nama Pasien</th>
        <th>Tgl. Lahir</th>
        <th>Umur</th>
        <th>JK</th>
        <th>Alamat</th>
        <th>Telepon</th>
      </tr>
      <?php if (!empty($trow_pendaftaran)) : $no = 1; ?>
        <?php while ($row_pendaftaran = $sql_pendaftaran->fetch(PDO::FETCH_LAZY)) { ?>
          <tr>
            <td><?php echo $no;
                $no++; ?></td>
            <td><?php echo longDate($row_pendaftaran->tgl_daftar); ?></td>
            <td><?php echo $row_pendaftaran->id_pasien; ?></td>
            <td><?php echo $row_pendaftaran->nama_pasien; ?></td>
            <td><?php echo longDate($row_pendaftaran->tgl_lahir); ?></td>
            <td><?php echo umur($row_pendaftaran->tgl_lahir); ?></td>
            <td><?php echo $row_pendaftaran->jk; ?></td>
            <td><?php echo $row_pendaftaran->alamat; ?></td>
            <td><?php echo $row_pendaftaran->tlp; ?></td>
          </tr>
        <?php } ?>
      <?php endif ?>
    </table>
  </div>
  <!-- /.box-body -->

</div>
<!-- /.box -->

<!-- =================================================================================== -->
<!-- Default box -->
<div class="box box-solid">

  <div class="box-header with-border">
    <h3 class="box-title">
      <i class="fa fa-info-circle"></i> 5 Pemeriksaan Pasien Terbaru
    </h3>
  </div>
  <!-- /.box-header -->

  <?php
  $sql_pemeriksaan = $con->query("SELECT p.id_pasien, p.nama_pasien, pp.tgl_periksa, pp.ket_klinis, pp.id_pp,
                GROUP_CONCAT(sp.nama_sub_periksa ORDER BY sp.nama_sub_periksa ASC SEPARATOR ', ') AS list_periksa
                FROM pemeriksaan_pasien pp
                JOIN pasien p
                ON p.id_pasien = pp.pasien_id
                JOIN tes_pasien tp
                ON tp.pp_id = pp.id_pp
                INNER JOIN sub_periksa sp
                ON sp.id_sub_periksa = tp.sub_periksa_id
                GROUP BY pp.id_pp
                ORDER BY pp.id_pp DESC LIMIT 5 ");
  $trow_pemeriksaan = $sql_pemeriksaan->rowCount();

  ?>
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <tr>
        <th width="1%">No.</th>
        <th width="10%">Tgl. Periksa</th>
        <th width="8%">ID Pasien</th>
        <th width="15%">Nama Pasien</th>
        <th width="auto">Pemeriksaan</th>
      </tr>
      <?php if (!empty($trow_pemeriksaan)) : $no = 1; ?>
        <?php while ($row_pemeriksaan = $sql_pemeriksaan->fetch(PDO::FETCH_LAZY)) { ?>
          <tr>
            <td><?php echo $no;
                $no++; ?></td>
            <td><?php echo longDate($row_pemeriksaan->tgl_periksa); ?></td>
            <td><?php echo $row_pemeriksaan->id_pasien; ?></td>
            <td><?php echo $row_pemeriksaan->nama_pasien; ?></td>
            <td><?php echo $row_pemeriksaan->list_periksa; ?></td>
          </tr>
        <?php } ?>
      <?php endif ?>
    </table>
  </div>
  <!-- /.box-body -->

</div>
<!-- /.box -->