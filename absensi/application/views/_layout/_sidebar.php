<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img style="min-height: 40px" src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->nama_pegawai; ?></p>
        <!-- Status -->
        <a href=""><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->    
    <ul class="sidebar-menu">
      <?php if($this->session->userdata('posisi_halaman') == '') {?>
        <li class="header">LIST MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li <?php if ($page == 'beranda') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Beranda'); ?>">
            <i class="fa fa-home"></i>
            <span>Halaman Utama</span>
          </a>
        </li>
        <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Home'); ?>">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
      <?php } ?>

      <?php if($this->session->userdata('posisi_halaman') == 'absensi') {?>
        <li class="header">LIST MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li <?php if ($page == 'beranda') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Beranda'); ?>">
          <!-- <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> -->
            <i class="fa fa-home"></i>
            <span>Halaman Utama</span>
          </a>
         <!--  <ul class="collapse sidebar-menu" id="homeSubmenu">
            <li>
              <a href="<?php echo base_url('Auth/setHalamanAbsensi'); ?>">Absensi</a>
            </li>
            <li>
              <a href="<?php echo base_url('Auth/setHalamanSPP'); ?>">Pembayaran SPP</a>
            </li>
            <li>
              <a href="<?php echo base_url('Auth/setHalamanSekolah'); ?>">Data Sekolah</a>
            </li>
          </ul> --> 
        </li>        
        <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Home'); ?>">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li <?php if ($page == 'absensi') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Absensi'); ?>">
                <i class="fa fa-group"></i>
                <span>Absensi</span>
              </a>
        </li>
        <li <?php if ($page == 'rekap_absen') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Rekap_Absen'); ?>">
            <i class="fa fa-line-chart"></i>
            <span>Rekapitulasi Harian</span>
          </a>
        </li> 
        <li <?php if ($page == 'laporan_absensi') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Laporan_Absensi'); ?>">
            <i class="fa fa-fax"></i>
            <span>Laporan Tiap Semester</span>
          </a>
        </li> 
      <?php }  ?>    

      <?php if($this->session->userdata('posisi_halaman') == 'spp') {?>
        <li class="header">LIST MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li <?php if ($page == 'beranda') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Beranda'); ?>">
            <i class="fa fa-home"></i>
            <span>Halaman Utama</span>
          </a>
        </li>
        <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Home'); ?>">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li <?php if ($page == 'SPP') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('SPP'); ?>">
            <i class="fa fa-money"></i>
            <span>Pembayaran SPP</span>
          </a>
        </li>
        <li <?php if ($page == 'rekap_spp') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Rekap_SPP'); ?>">
            <i class="fa fa-line-chart"></i>
            <span>Rekapitulasi SPP</span>
          </a>
        </li>
        <li <?php if ($page == 'tagihan_spp') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Tagihan_SPP'); ?>">
            <i class="fa fa-history"></i>
            <span>Tagihan SPP</span>
          </a>
        </li>
        <li <?php if ($page == 'beasiswa_potongan') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Beasiswa'); ?>">
            <i class="fa fa-graduation-cap"></i>
            <span>Beasiswa dan Potongan</span>
          </a>
        </li>
      <?php }  ?>

      
      <?php if($this->session->userdata('posisi_halaman') == 'sekolah') {?>
        <li class="header">LIST MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li <?php if ($page == 'beranda') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Beranda'); ?>">
            <i class="fa fa-home"></i>
            <span>Halaman Utama</span>
          </a>
        </li>
        <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Home'); ?>">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li <?php if ($page == 'kelas') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Kelas'); ?>">
            <i class="fa fa-archive"></i>
            <span>Data Kelas</span>
          </a>
        </li>
        <li <?php if ($page == 'mapel') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Mapel'); ?>">
            <i class="fa fa-book"></i>
            <span>Data Mata Pelajaran</span>
          </a>
        </li>
        <li <?php if ($page == 'master') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Master'); ?>">
            <i class="fa fa-database"></i>
            <span>Tabel Master SPP</span>
          </a>
        </li>
        <li <?php if ($page == 'siswa') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Siswa'); ?>">
            <i class="fa fa-hdd-o"></i>
            <span>Data Siswa</span>
          </a>
        </li>
        <li <?php if ($page == 'pegawai') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Pegawai'); ?>">
            <i class="fa fa-user"></i>
            <span>Data Pegawai</span>
          </a>
        </li>
        <li <?php if ($page == 'master_semester') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Master_Semester'); ?>">
            <i class="fa fa-calendar"></i>
            <span>Data Semester</span>
          </a>
        </li>
        <li <?php if ($page == 'tahun_ajaran') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Tahun_Ajaran'); ?>">
            <i class="fa fa-calendar"></i>
            <span>Data Tahun Ajaran</span>
          </a>
        </li>
        <li <?php if ($page == 'wali_kelas') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Wali_Kelas'); ?>">
            <i class="fa fa-user"></i>
            <span>Data Wali Kelas</span>
          </a>
        </li>
        <li <?php if ($page == 'pengajar') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Pengajar'); ?>">
            <i class="fa fa-user"></i>
            <span>Data Guru Pengajar</span>
          </a>
        </li> 
      <?php }  ?>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>