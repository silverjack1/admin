<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo $title; ?>
	</h1>
</section>

<section class="content">
	<div class="row">
	
		<div class="col-md-3">
			<div class="box box-warning">
				<div class="box-body box-profile">
					<center>
						<img class="profile-user-img img-responsive" src="<?php echo base_url('assets/images/user-icon.jpg') ?>">
					</center>
					<h3 class="profile-username text-center"><?php echo strtoupper($this->session->userdata("adminNama")); ?></h3>	
					<center>NIS : <?php echo strtoupper($this->session->userdata("adminNpp")); ?></center>
					<br>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="box box-info">
				<div class="box-body box-profile">
					<center>
						<a href="https://ri32.wordpress.com/edugi" target="_blank"><img src="<?php echo base_url('assets/images/edu-logo.png') ?>" title="Pelatihan Aplikasi Web & Mobile secara Online" width="400px" class="img-responsive"></a>
					</center><br>
					<h5 align="center"><b>(Edukasi Untuk Generasi Islami)</b></h5>
					<center><i>"Jika engkau tidak sanggup menahan perihnya belajar, maka engkau harus sanggup menahan perihnya kebodohan" (Imam Syafi'i)</i></center>
				</div>
			</div>
		</div>
		
	</div>
</section>
