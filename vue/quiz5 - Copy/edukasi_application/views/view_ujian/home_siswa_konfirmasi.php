<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content">
	<div class="row">
		<div class="col-md-5">
			<div class="box box-primary">
				<div class="box-body box-profile">
					
					<div class="box-body">
						<form method="post" action="<?php echo site_url("ujian_online/token"); ?>">
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Judul Ujian</b> : <?php echo $judul_ket;?>
							</li>
							<li class="list-group-item">
								<b>Tipe Ujian</b> : Evaluasi Pegawai
							</li>
							<li class="list-group-item">
								<b>Tanggal Ujian</b> : <?php echo date("Y-m-d");?>
							</li>
							<li class="list-group-item">
								<b>Jumlah</b> : <?php echo $jawab_jumlah;?> soal
							</li>
							<li class="list-group-item">
								<b>Waktu</b> : <?php echo $judul_waktu;?> menit
							</li>
							<li class="list-group-item">
								<?php $jam=date("Y-m-d H:i:s");?>
								<b>Jam Server</b> : <?php echo substr($jam,11,8); ?>
							</li>
							
							<?php if($judul_token!=0){?> 
							<li class="list-group-item">
								<b>Masukan Token</b> <input type="password" name="token" required>
							</li>
							<?php }?>
						</ul>
						
						<?php
						$random = rand();
						$edit = base64_encode($random."-edit");
						?>
						
						<?php 
						if($judul_token!=0)
						{?>
							<input type="hidden" name="mo" value="<?php echo $edit;?>">
							<input type="hidden" name="id" value="<?php echo $this->input->get('id');?>">
							<input type="hidden" name="kd" value="<?php echo $this->input->get('kd');?>">
							<input type="hidden" name="jj" value="<?php echo $this->input->get('jj');?>">
							<input type="submit" name="konfirmasi" class='btn btn-sm btn-success' value="KONFIRMASI">
						<?php 
						}else{ 
						?>
							<a href='javascript:void(0)' onClick=soal_function("<?php echo $edit; ?>","<?php echo $this->input->get('id'); ?>","<?php echo $this->input->get('kd'); ?>","<?php echo $this->input->get('jj'); ?>"); class='btn btn-sm btn-primary' title='Klik untuk mengerjakan'>KONFIRMASI</a>
						<?php 
						} 
						?>
						
						<a href='javascript:void(0)' onClick=batal_function(); class='btn btn-sm btn-danger' title='Klik untuk mengerjakan'>BATAL</a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">     
function soal_function(m,id,kd,jj) {
    if (confirm('Apakah Anda Yakin?'))
    {
        var base_url = "ujian_online/tampil?m="+m+"&id="+id+"&kd="+kd+"&jj="+jj;
        window.location.href = "<?php echo site_url(); ?>"+base_url;
    }else{}
}

function batal_function() {
	var base_url = "ujian_online";
	window.location.href = "<?php echo site_url(); ?>"+base_url;
}
</script> 