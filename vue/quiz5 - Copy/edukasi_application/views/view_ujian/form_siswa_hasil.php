<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<i class="fa fa-graduation-cap"></i> HASIL UJIAN :  <b><?php echo strtoupper($nama." - ".$nis." - ".$bds); ?></b>
	</h1>
</section>

<section class="content">
	<div class="row">
	
		<div class="col-md-3">
			<div class="box box-warning">
				<div class="box-body box-profile">
				<div class="box-body">
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Benar</b> : <span class='label label-primary'><?php echo $benar; ?></span>
						</li>
						<li class="list-group-item">
							<b>Salah</b> : <span class='label label-danger'><?php echo $salah; ?></span>
						</li>
						<li class="list-group-item">
							<b>Kosong</b> : <span class='label label-warning'><?php echo $kosong; ?></span>
						</li>
						<li class="list-group-item">
							<b>Nilai</b> : <span class='label label-success'><?php echo number_format($score,2,",","."); ?></span>
						</li>
					</ul>
					
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Tanggal Ujian</b> : <span class='text-blue'><?php echo substr($mulai,0,10); ?></span>
						</li>
						<li class="list-group-item">
							<b>Jam Mulai</b> : <span class='text-blue'><?php echo substr($mulai,10,10); ?></span>
						</li>
						<li class="list-group-item">
							<b>Jam Selesai</b> : <span class='text-red'><?php echo substr($selesai,10,10); ?></span>
						</li>
					</ul>
				</div>
				
				</div>
			</div>
			<a href='javascript:void(0)' onClick=kembali_function(); class='btn btn-sm btn-primary btn-flat pull-left' title='Klik untuk kembali ke menu utama'>KEMBALI</a>
		</div>
		
		<div class="col-md-3">
			<div class="box box-success">
				<div class="box-body box-profile">
					<table class="table table-condensed table-no-border">
					<tr>
						<th>No.Soal</th><th><center>Jawaban</center></th><th><center>Status</center></th>
					</tr>
						
					<?php
					$array_jwb = explode(",",$rekap);
					$no=0;
					foreach ($array_jwb as $jwb) 
					{
						$string_jwb = explode(":",$jwb);
						$soal=$string_jwb[0];
						$jawab=$string_jwb[1];
						$kunci=$string_jwb[2];
						$status=$string_jwb[3];
						
						$no=$no+1;
						?>
						<tr>
							<td><?php echo $no;?></td>
							<td align="center"><?php echo $jawab;?></td>
							<td align="center"><?php echo $status?><?php echo $kunci;?></span></td>
						</tr>
						<?php
					}
					?>
					
					</table>
				
				</div>
			</div>
		</div>
	
	</div>
</section>

<script>
function kembali_function() {
	var base_url = "ujian_online";
	window.location.href = "<?php echo site_url(); ?>"+base_url;
}

function cek_form(){
	var saran=$("#saran").val();

	if(saran==""){
		alert('Belum ada saran & masukan');
		return false;
	}

	return true;
}
</script>