<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<i class="fa fa-clock-o"></i> TIMER : <font color="brown"><div id="clock" style="display: inline; font-weight: bold"></div></font> 
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body box-profile">

				<form name="myForm" id="myForm" method="post" action="<?php echo site_url("ujian_soal_all/submit"); ?>">
				<?php
				$urut=0;
				foreach($res_soal as $row)
				{
					$soal_id=$row->soal_id;
					$pertanyaan=$row->soal_pertanyaan;
					$_a = strip_tags($row->soal_opsi_a,'<p>');
					$_b = strip_tags($row->soal_opsi_b,'<p>');
					$_c = strip_tags($row->soal_opsi_c,'<p>');
					$_d = strip_tags($row->soal_opsi_d,'<p>'); 
					$_e = strip_tags($row->soal_opsi_e,'<p>');
					
					if(!empty($_a)){ $c_a = 1; }else{ $c_a = 0; }
					if(!empty($_b)){ $c_b = 1; }else{ $c_b = 0; }
					if(!empty($_c)){ $c_c = 1; }else{ $c_c = 0; }
					if(!empty($_d)){ $c_d = 1; }else{ $c_d = 0; }
					if(!empty($_e)){ $c_e = 1; }else{ $c_e = 0; }
					
					if($_a=="<p>.</p>"){ $pilihan_a=""; }else{ $pilihan_a=$_a; }
					if($_b=="<p>.</p>"){ $pilihan_b=""; }else{ $pilihan_b=$_b; }
					if($_c=="<p>.</p>"){ $pilihan_c=""; }else{ $pilihan_c=$_c; }
					if($_d=="<p>.</p>"){ $pilihan_d=""; }else{ $pilihan_d=$_d; }
					if($_e=="<p>.</p>"){ $pilihan_e=""; }else{ $pilihan_e=$_e; }
					?>
					
					<input type="hidden" name="id[]" value=<?php echo $soal_id; ?>>
					<input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>
					<input type="hidden" name="judul_kode" value=<?php echo $judul_kode; ?>>
					<input type="hidden" name="judul_mulai" value=<?php echo $judul_mulai; ?>>
					<input type="hidden" name="judul_id" value=<?php echo $judul_id; ?>>
					<table width="457" border="0">
					<tr>
						<td valign="top" width="25" align="center"><?php echo $urut=$urut+1; ?>.</td>
						<td valign="top" align="left" colspan="2"><?php echo $pertanyaan; ?></td>
					</tr>

					<?php
					$jml_pilihan = $c_a+$c_b+$c_c+$c_d+$c_e;

					if($jml_pilihan==3){ $pilihan_abjad = array("A","B","C"); }
					if($jml_pilihan==4){ $pilihan_abjad = array("A","B","C","D"); }
					if($jml_pilihan==5){ $pilihan_abjad = array("A","B","C","D","E"); }

                    if($judul_acak==1){ shuffle($pilihan_abjad); }
					
                    $looping = 1;
					while($looping<=$jml_pilihan)
                    {
                        $counter = $looping-1;
                        $counter_abjad = $pilihan_abjad[$counter];

                        if($counter_abjad=="A"){ $pilihan_jawaban=$pilihan_a; }
                        if($counter_abjad=="B"){ $pilihan_jawaban=$pilihan_b; }
                        if($counter_abjad=="C"){ $pilihan_jawaban=$pilihan_c; }
                        if($counter_abjad=="D"){ $pilihan_jawaban=$pilihan_d; }
                        if($counter_abjad=="E"){ $pilihan_jawaban=$pilihan_e; }

						if($looping==1){ $abjad="A"; }
						if($looping==2){ $abjad="B"; }
						if($looping==3){ $abjad="C"; }
						if($looping==4){ $abjad="D"; }
						if($looping==5){ $abjad="E"; }
						
						?>
						<tr>
							<td valign="top" align="center"><?php echo $abjad;?></td>
							<td valign="top" width="25" align="center"><input name="pilihan[<?php echo $soal_id; ?>]" type="radio" value="<?php echo $counter_abjad;?>"></td>
							<td valign="top"><?php echo $pilihan_jawaban;?></td>
						</tr>
						<?php
						
						$looping++;
					}
					?>

					</table>
					<br>
					<?php
				}
				?>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-primary" name="submit" value="Jawab" onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')">Jawab</button></td>
				</tr>
				</form>

				</div>
			</div>
		</div>
	
	</div>
</section>

<script type="text/javascript">     
$(document).ready(function(){
	$('#clock').countdown("<?php echo $jawab_timer;?>")
	.on('update.countdown', function (event) { 
		$(this).html(event.strftime('%H:%M:%S'));
	})
	.on('finish.countdown', function (event) {
		alert('Waktu telah selesai!...JIKA dalam waktu 10 DETIK tidak mengklik tombol SUBMIT, maka jawaban Anda TIDAK akan di PROSES');
		submit();
	});
});

function submit(){
	var waktu = 10;
	var m = "MjUzNTctSmF3YWJhbiBBbmRhIHRpZGFrIHRlcnNpbXBhbiBrZSBEYXRhYmFzZQ==";
	var a = "MjUzNTctd2FybmluZw==";
	setInterval(function() {
		waktu--;
		if(waktu < 0) {
			 var base_url = "ujian_online?m="+m+"&a="+a;
			window.location.href = "<?php echo site_url(); ?>"+base_url;
		}else{
			document.getElementById("clock").innerHTML = waktu;
		}
	}, 1000);
}
</script> 
