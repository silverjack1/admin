<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<i class="fa fa-clock-o"></i> TIMER : <font color="brown"><div id="clock" style="display: inline; font-weight: bold"></div></font> 
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-body box-profile">
				
				<?php
				$id = $this->input->get('id');
				$token1 = "bismillah@edukasi#ri32".date('Y-m-d H:i:s');
				$token2 = "alhamdulillah@edukasi#ri32".date('Y-m-d H:i:s');
				
				$random = rand();
				$mkrip  = base64_encode($random."-".$token1);
				$skrip  = base64_encode($random."-".$token2);
				
				//menampilkan link previous
				if ($nohalaman > 1){	
					?> <a href="<?php echo site_url("ujian_soal_one?m=".$mkrip."&id=".$id."&pg=".($nohalaman-1)."&s=".$skrip); ?>"><span class='label label-success'><i class="fa fa-angle-double-left"></i>&nbsp;</span></a> <?php
				}
						
				//memunculkan nomor halaman dan linknya
				for($halaman = 1; $halaman <= $jumhalaman; $halaman++)
				{
					$array_jwb = explode(",",$jawab_submit);
					$no=0;
					$flag=0;
					$tanda=0;
					foreach ($array_jwb as $jwb) 
					{
						$string_jwb = explode(":",$jwb);
						$no=$no+1;
						$soal=$string_jwb[0];
						$jawab=$string_jwb[1];
						$ceklagi=$string_jwb[2];
						
						if($no==$halaman && !empty($jawab)){
							$flag++;
						}
						
						if($no==$halaman && $ceklagi!=0){
							$tanda++;
						}
					}
					
					if($tanda==1){
						$stat="danger";
						$judul="Cek kembali jawaban";
					}else if($flag==1){
						$stat="primary";
						$judul="Telah dijawab";
					}else{
						$stat="success";
						$judul="Belum dijawab";
					}
	
					if ((($halaman >= $nohalaman - 100) && ($halaman <= $nohalaman + 100)) || ($halaman == 1) || ($halaman == $jumhalaman)) 
					{   
						if ($halaman == $nohalaman){ 
							echo " <span class='label label-warning' title='Nomor soal yang tampil'><b>".$halaman."</b></span>";
						}else{ 
							?> <a href="<?php echo site_url("ujian_soal_one?m=".$mkrip."&id=".$id."&pg=".$halaman."&s=".$skrip); ?>"><span class='label label-<?php echo $stat;?>' title='<?php echo $judul;?>'>&nbsp;<?php echo $halaman;?>&nbsp;</span> </a><?php
						} 
					}
				}

				//menampilkan link next
				if ($nohalaman < $jumhalaman){ 
					?> <a href="<?php echo site_url("ujian_soal_one?m=".$mkrip."&id=".$id."&pg=".($nohalaman+1)."&s=".$skrip); ?>"><span class='label label-success'>&nbsp;<i class="fa fa-angle-double-right"></i></span></a> <?php
				}
				?>
				
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-9">
		  <div class="box box-primary">
			<div class="box-body">
			  
				<?php
				$pp = intval($nohalaman);
				$pg = $pp+1;
				?>
				
				<form name="myForm" id="myForm" method="post" action="<?php echo site_url("ujian_soal_one/submit?id=".$id."&pg=".$pg); ?>">
				<?php
				foreach($result as $row)
				{
					$soal_id=$row->soal_id;
					$pertanyaan=$row->soal_pertanyaan;
					$_a = $row->soal_opsi_a;
					$_b = $row->soal_opsi_b;
					$_c = $row->soal_opsi_c;
					$_d = $row->soal_opsi_d; 
					$_e = $row->soal_opsi_e;

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
					
					<div class="box-body table-responsive no-padding">
						<table border="1" bordercolor="white" align="left" width="100%">
						<tr>
							<td valign="top" width="20" align="center"><?php echo $offset=$offset+1; ?>.&nbsp;</td>
							<td valign="top" colspan="2" ><?php echo ucwords($pertanyaan); ?></td>
							<td width="20">&nbsp;&nbsp;</td>
							
							<input type="hidden" name="soal_id" value=<?php echo $soal_id; ?>>
							<input type="hidden" name="soal_no" value="<?php echo $offset; ?>">
							<input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>
							<input type="hidden" name="judul_kode" value=<?php echo $judul_kode; ?>>
							<input type="hidden" name="judul_id" value=<?php echo $judul_id; ?>>
							
							<?php
							$random = rand();
							$jm = base64_encode($random."-".$jumlah);
							?>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td></td>
							<td></td>
							<td></td>
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
							    <td valign="top" width="18" align="center"><input id="pilihan" name="pilihan" type="radio" <?php if($dijawab==$counter_abjad){ echo "checked";} ?> value="<?php echo $counter_abjad;?>"></td>
							    <td valign="top"><?php echo ucwords($pilihan_jawaban);?></td>
							    <td></td>
						    </tr>

                            <?php
                            $looping++;
                        }
                        ?>
						</table>
					</div>
					
					<br>
					<?php
				}
				?>
				<tr>
					<td>&nbsp;</td>
					<td>

					<?php
					if ($nohalaman > 1){
					?> 
					<a href="<?php echo site_url("ujian_soal_one?m=".$mkrip."&id=".$id."&pg=".($nohalaman-1)."&s=".$skrip); ?>" class="btn btn-success" title="Kembali ke soal sebelumnya"><i class="fa fa-angle-double-left"></i> Soal Sebelumnya</a> 
					<?php
					}
					?>
					
					<?php
					if($offset==$jumlah){
					?>
						<button type="submit" class="btn btn-danger" name="submit" value="Jawab" onClick="return confirm('Apakah Anda yakin akan menyelesaikan ujian ini? Silahkan cek kembali jawaban!')";>Selesai <i class="fa fa-angle-double-right"></i></button>
					<?php
					}else{
					?>
						<input type="hidden" name="cek_kembali" id="cek_kembali" value="<?php echo $ditandai; ?>">
						<button type="button" class="<?php if($ditandai=="1"){ echo "btn btn-danger";}else{ echo "btn btn-warning";} ?>" id="tandai" name="tandai"><?php if($ditandai=="1"){ echo "Cek Kembali";}else{ echo "Ditandai";} ?></button>
						<button type="submit" class="btn btn-primary" name="submit" value="Jawab">Soal Selanjutnya <i class="fa fa-angle-double-right"></i></button>
					<?php
					}
					?>

					</td>
				</tr>
				</form>
				<br/>
			  
			</div>
		  </div>
		</div>
		
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-body box-profile">
					
					<div class="box-body">
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Judul Ujian</b> : <?php echo $judul_ket;?>
							</li>
							<li class="list-group-item">
								<b>Tanggal Ujian</b> : <?php echo substr($jawab_mulai,0,10);?>
							</li>
							<li class="list-group-item">
								<b>Bidang Studi</b> : <?php echo $judul_bds;?>
							</li>
							<li class="list-group-item">
								<b>Jumlah</b> : <?php echo $jumlah;?> soal
							</li>
							<li class="list-group-item">
								<b>Waktu</b> : <?php echo $judul_waktu;?> menit
							</li>
							<li class="list-group-item">
								<b>Jam Mulai</b> : <?php echo substr($jawab_mulai,11,8); ?>
							</li>
							<li class="list-group-item">
								<b>Jam Selesai</b> : <?php echo substr($jawab_timer,11,8); ?>
							</li>
							<li class="list-group-item">
								<?php $jam=date("Y-m-d H:i:s");?>
								<b>Jam Server</b> : <?php echo substr($jam,11,8); ?>
							</li>
						</ul>
						
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
						  Panduan Aplikasi
						</button>
					</div>
					
				</div>
			</div>
		</div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Panduan Aplikasi</h4>
			  </div>
			  <div class="modal-body">
				
				<img class="img-responsive" src="<?php echo base_url('assets/images/list-soal.png') ?>">
				<ul>
					<li>Nomor <b>warna Hijau</b> untuk soal yang belum dijawab</li>
					<li>Nomor <b>warna Biru</b> untuk soal yang sudah dijawab</li>
					<li>Nomor <b>warna Merah</b> untuk soal yang ditandai untuk dicek</li>
					<li>Nomor <b>warna Kuning</b> untuk soal yang sedang dikerjakan</li>
				</ul>
				<br>
				
				<img class="img-responsive" src="<?php echo base_url('assets/images/tombol.png') ?>" width="350">
				<ul>
					<li>Klik Tombol <b>Soal Selanjutnya</b> untuk menyimpan jawaban</li>
					<li>Klik Tombol <b>Soal Sebelumnya</b> untuk kembali ke soal sebelumnya</li>
					<li>Klik Tombol <b>Ditandai</b> untuk menandai soal yang akan dicek</li>
					<li>Klik Tombol <b>Cek Kembali</b> jika jawaban sudah dicek</li>
				</ul>
	
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
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
		alert('Waktu telah selesai!...Anda akan dialihkan ke halaman HASIL UJIAN');
		var base_url = "ujian_soal_one/finish?id="+'<?php echo $id; ?>';
        window.location.href = "<?php echo site_url(); ?>"+base_url;
	});
	
	$("#tandai").click(function(){
		
		var cek_kembali = $("#cek_kembali").val();
		
		var numberChecked =  $("#pilihan:checked").length;
		if (numberChecked==0 )
		{
			alert('Belum ada jawaban yang dipilih');
			return false;
		}else{

			if(cek_kembali=="0"){
				$("#tandai").html("Cek Kembali");
				$("#tandai").removeClass('btn btn-warning').addClass('btn btn-danger');
				$('#cek_kembali').val("1");
			}else{
				$("#tandai").html("Tandai");
				$("#tandai").removeClass('btn btn-danger').addClass('btn btn-warning');
				$('#cek_kembali').val("0");
			}
		}

    });
});

function submit(){
	var waktu = 10;
	setInterval(function() {
		waktu--;
		if(waktu < 0) {
			var base_url = "ujian_soal_one/finish?id="+'<?php echo $id; ?>';
			window.location.href = "<?php echo site_url(); ?>"+base_url;
		}else{
			document.getElementById("clock").innerHTML = waktu;
		}
	}, 1000);
}

function cek_form(){
	if (confirm('Apakah Anda yakin akan menyelesaikan ujian?'))
    {
		var base_url = "ujian_soal_one/finish?&id="+'<?php echo $id; ?>';
        window.location.href = "<?php echo site_url(); ?>"+base_url;
    }else{}
}
</script> 
