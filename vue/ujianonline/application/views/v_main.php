<div class="row col-md-12">
  <div class="panel panel-info">
    <div class="panel-heading">Selamat datang di Sistem Ujian Online  <b><?php echo $this->session->userdata('admin_nama');?></b></div>
    <div class="panel-body">
        <div class="alert alert-info">
        <img src="<?= base_url('___/img/back02.jpg');?>" width="100%" alt="" srcset="">
        </div>
        <?php 
        if (!empty($p_mapel)) {
        	echo "<h3>Mata pelajaran yang Anda ikuti : </h3><ul>";
        	foreach ($p_mapel as $p) {	
        		echo '<li>'.$p->nama.'</li>';
        	}
        	echo '</ul>';
        }
        ?>
      </div>
    </div>
  </div>
</div>