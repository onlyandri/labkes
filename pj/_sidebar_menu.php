  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" style="padding-bottom: 60px">
        <!-- <div class="pull-left image">
          <img src="../assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div> -->
        <div class="pull-left info">
          <p><?php echo $nama_akun; ?></p>
          <a href="#"><i class="fa fa-user text-white"></i> Penanggung Jawab</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <li id="nav-dashboard"><a href="./"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

        <li id="nav-pasien"><a href="pasien"><i class="fa fa-address-book"></i> <span>Data Pendaftaran Pasien</span></a></li>

        <li id="nav-laporan"><a href="laporan"><i class="fa fa-file"></i> <span>Laporan Pemeriksaan</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>