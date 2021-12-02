<?php $uri = $this->uri->segment(1)==""?"dashboard":$this->uri->segment(1); ?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MENU UTAMA</li>
			<li <?php if($uri=="dashboard"){ echo "class='active'"; } ?>><a href="<?php echo base_url("dashboard"); ?>"><i class="fa fa-home"></i> Home</a></li>
			<li <?php if($uri=="siswa"){ echo "class='active'"; } ?>><a href="<?php echo base_url("siswa"); ?>"><i class="fa fa-user"></i> Data Siswa</a></li>
			<li <?php if($uri=="studi"){ echo "class='active'"; } ?>><a href="<?php echo base_url("studi"); ?>"><i class="fa fa-institution"></i> Bidang Studi</a></li>
			<li <?php if($uri=="ujian_upload"){ echo "class='active'"; } ?>><a href="<?php echo base_url("ujian_upload"); ?>"><i class="fa fa-picture-o"></i> Upload Media</a></li>
			<li <?php if($uri=="ujian_soal"){   echo "class='active'"; } ?>><a href="<?php echo base_url("ujian_soal");   ?>"><i class="fa fa-file-text"></i> Soal Ujian</a></li>
			<li <?php if($uri=="ujian_judul"){  echo "class='active'"; } ?>><a href="<?php echo base_url("ujian_judul");  ?>"><i class="fa fa-mortar-board"></i> Kegiatan Ujian</a></li>
			<li <?php if($uri=="ujian_hasil"){  echo "class='active'"; } ?>><a href="<?php echo base_url("ujian_hasil");  ?>"><i class="fa fa-pie-chart"></i> Hasil Ujian</a></li>
        </ul>
    </section>
</aside>
<div class="content-wrapper">