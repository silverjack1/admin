<?php $uri = $this->uri->segment(1)==""?"dashboard":$this->uri->segment(1); ?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MENU UTAMA</li>
			<li <?php if($uri=="home"){ echo "class='active'"; } ?>><a href="<?php echo base_url("home"); ?>"><i class="fa fa-home"></i> Home</a></li>
			<li <?php if($uri=="ujian_online"){ echo "class='active'"; } ?>><a href="<?php echo base_url("ujian_online"); ?>"><i class="fa fa-laptop"></i> Ujian Online</a></li>
        </ul>
    </section>
</aside>
<div class="content-wrapper">
