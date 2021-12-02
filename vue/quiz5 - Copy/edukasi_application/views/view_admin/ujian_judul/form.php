<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo ucwords($title); ?>
	</h1>
</section>

<?php
$judul_id      		 = isset($qry_judul) ? $qry_judul->judul_id : "";
$judul_token   		 = isset($qry_judul) ? ucwords($qry_judul->judul_token)   : "";
$judul_parent    	 = isset($qry_judul) ? ucwords($qry_judul->judul_parent)  : "";
$judul_tingkat 		 = isset($qry_judul) ? ucwords($qry_judul->judul_tingkat) : "";
$judul_kelas   		 = isset($qry_judul) ? ucwords($qry_judul->judul_kelas) : "";
$judul_type    		 = isset($qry_judul) ? ucwords($qry_judul->judul_type)  : "";
$judul_mode    		 = isset($qry_judul) ? ucwords($qry_judul->judul_mode)  : "";
$judul_acak    		 = isset($qry_judul) ? ucwords($qry_judul->judul_acak)  : "";
$judul_akses   		 = isset($qry_judul) ? ucwords($qry_judul->judul_akses) : "";
$judul_jurusan 		 = isset($qry_judul) ? ucwords($qry_judul->judul_jurusan) : "";
$judul_studi   		 = isset($qry_judul) ? ucwords($qry_judul->judul_studi) : "";
$judul_tahun   		 = isset($qry_judul) ? ucwords($qry_judul->judul_tahun) : "";
$judul_update  		 = isset($qry_judul) ? ucwords($qry_judul->judul_update_date) : date("d-m-Y h:m:s");
$judul_keterangan    = isset($qry_judul) ? ucwords($qry_judul->judul_keterangan) : "";
$judul_waktu         = isset($qry_judul) ? ucwords($qry_judul->judul_waktu) : "";
$judul_tgl_mulai     = isset($qry_judul) ? ucwords($qry_judul->judul_tgl_mulai) : "";
$judul_tgl_selesai   = isset($qry_judul) ? ucwords($qry_judul->judul_tgl_selesai) : "";
$judul_jam_mulai     = isset($qry_judul) ? ucwords($qry_judul->judul_jam_mulai) : "";
$judul_jam_selesai   = isset($qry_judul) ? ucwords($qry_judul->judul_jam_selesai) : "";

if($judul_id === ""){
	$btn_value = "btn_simpan";
	$tanggal = "Tgl. Input";
}else{
	$btn_value = "btn_ubah";
	$tanggal = "Tgl. Update";
}

$random = rand();
$id = base64_encode($random."-".$judul_id);
			
echo validation_errors();$konfirmasi = $btn_value === "btn_ubah" ? "onClick=\"return confirm('Apakah Anda Yakin?')\"" : "";
?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url("ujian_judul/form"); ?>">
<section class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="box-body box-profile">
				<div class="box box-warning">
					<div class="box-body">

						<div class="form-group">
							<label class="col-sm-2 control-label">Tahun Ajaran</label>
							<div class="col-sm-4">
								<select name="opt_tahun" id="opt_tahun" class="form-control">
									<?php
									foreach($res_ta as $row_ta)
									{
										$selected = $judul_tahun == $row_ta->ta_id ? "selected=\"selected\"" : "";
										?>
										<option value="<?php echo $row_ta->ta_id; ?>" <?php echo $selected; ?>><?php echo strtoupper($row_ta->ta_tahun1); ?> / <?php echo strtoupper($row_ta->ta_tahun2); ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Tingkat</label>
							<div class="col-sm-4">
								<select name="opt_tingkat" id="tingkat" class="form-control">
									<option value="0">Tingkat</option>
									<?php
									foreach($qry_jenjang as $row_jenjang)
									{
										$selected = $judul_tingkat === $row_jenjang->jenjang_id ? "selected=\"selected\"" : "";
										?><option value="<?php echo $row_jenjang->jenjang_id; ?>" <?php echo $selected; ?>><?php echo strtoupper($row_jenjang->jenjang_ket); ?></option><?php
									}
									?>
								</select>
							</div>
							<div class="col-sm-2">
								<select name="opt_kelas" id="kelas" class="form-control">
									<option>Kelas</option>
								</select>
							</div>
							<div class="col-sm-3">
								<select name="opt_jurusan" id="jurusan" class="form-control">
									<option value="0" <?php if($judul_jurusan==0){ echo "selected=\"selected\""; } ?>>Semua Jurusan</option>
									<option value="1" <?php if($judul_jurusan==1){ echo "selected=\"selected\""; } ?>>IPA</option>
									<option value="2" <?php if($judul_jurusan==2){ echo "selected=\"selected\""; } ?>>IPS</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Bidang Studi</label>
							<div class="col-sm-4">
								<select class="form-control" name="opt_studi" id="studi">
									<option value="0">Bidang Studi</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Judul Ujian</label>
							<div class="col-sm-4">
								<input type="hidden" name="hdd_judul_lama" id="hdd_judul_lama" value="<?php echo $judul_keterangan; ?>">
								<input type="text" id="txt_keterangan" name="txt_keterangan" class="form-control" placeholder="Judul Ujian" value="<?php echo $judul_keterangan; ?>" required>
							</div>
						</div>
						
						<div class="form-group  has-error">
							<label class="col-sm-2 control-label">Parent Ujian</label>
							<div class="col-sm-4">
								<select name="opt_parent" id="opt_parent" class="form-control">
									<option value="0"></option>
									<?php
									foreach($qry_parent as $row_judul)
									{
										$selected = $judul_parent == $row_judul->judul_id ? "selected=\"selected\"" : "";
										?>
										<option value="<?php echo $row_judul->judul_id; ?>" <?php echo $selected; ?>><?php echo strtoupper($row_judul->judul_keterangan); ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>

						<?php
						if($judul_tgl_selesai=="0000-00-00"){
							$judul_tgl_selesaiku="";
						}else{
							$judul_tgl_selesaiku=$judul_tgl_selesai;
						}
						?>
						<hr>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Waktu Pengerjaan</label>
							<div class="col-sm-4">
								<input type="text" id="txt_waktu" name="txt_waktu" class="form-control" placeholder="Dalam Satuan Menit" value="<?php echo $judul_waktu; ?>" maxlength="3" required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Tanggal Ujian</label>
							<div class="col-sm-4">
								<input type="text" id="txt_tgl_mulai" name="txt_tgl_mulai" class="form-control"  placeholder="Tanggal Mulai" value="<?php echo $judul_tgl_mulai; ?>" required>
							</div>
							<div class="col-sm-2">
								<label>Sampai Dengan</label>
							</div>
							<div class="col-sm-3">
								<input type="text" id="txt_tgl_selesai" name="txt_tgl_selesai" class="form-control"  placeholder="Tanggal Selesai" value="<?php echo $judul_tgl_selesaiku; ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Jam Ujian</label>
							<div class="col-sm-4">
								<input type="text" id="txt_jam_mulai" name="txt_jam_mulai" class="form-control" placeholder="Jam:Menit" maxlength="5" value="<?php echo $judul_jam_mulai; ?>"> 
							</div>
							<div class="col-sm-2">
								<label>Sampai Dengan</label>
							</div>
							<div class="col-sm-3">
								<input type="text" id="txt_jam_selesai" name="txt_jam_selesai"  class="form-control" placeholder="Jam:Menit" maxlength="5" value="<?php echo $judul_jam_selesai; ?>">
							</div>
						</div>
						<hr>

						<div class="form-group">
							<label class="col-sm-2 control-label">Akses Ujian</label>
							<div class="col-sm-4">
								<select name="opt_judul_akses" id="opt_judul_akses" class="form-control">
									<option value="1" <?php if($judul_akses==1){ echo "selected=\"selected\""; } ?>>DIBUKA</option>
									<option value="2" <?php if($judul_akses==2){ echo "selected=\"selected\""; } ?>>DITUTUP</option>
								</select>
							</div>
						</div>
						
						<div class="box-footer">
							<input type="hidden" name="txt_judul_id" 	   id="txt_judul_id"       value="<?php echo $judul_id;    ?>">
							<input type="hidden" name="hdd_akademik_kelas" id="hdd_akademik_kelas" value="<?php echo $judul_kelas; ?>">
							<input type="hidden" name="hdd_akademik_studi" id="hdd_akademik_studi" value="<?php echo $judul_studi; ?>">
							<a href="<?php echo site_url('ujian_judul') ?>" class="btn btn-danger">Batal</a>&nbsp;
							<button type="submit" name="btn_simpan" id="btn_simpan" onClick="return cek_form()" value="<?php echo $btn_value; ?>" class="btn btn-primary" <?php echo $konfirmasi;?>>Simpan</button>
						</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</form>

<script type="text/javascript">
$(document).ready(function(){
    $("#tingkat").change(function(){
        tampil_bidang_studi();
    });
	
	tampil_bidang_studi();
});

function tampil_bidang_studi()
{
	var tingkat = $("#tingkat").val();
	var kelas_ku = $("#hdd_akademik_kelas").val();
	var studi_ku = $("#hdd_akademik_studi").val();
        
	$.ajax({
		url: "<?php echo site_url("ujian_soal/kelas_ajax"); ?>",
		data: "tingkat="+tingkat+"&kelas_ku="+kelas_ku,
		success:function(data){
			$("#kelas").html(data);
		}
	});
	
	$.ajax({
		url: "<?php echo site_url("ujian_soal/soal_studi_ajax"); ?>",
		data: "tingkat="+tingkat+"&studi_ku="+studi_ku,
		success:function(data){
			$("#studi").html(data);
		}
	});
	
	if(tingkat!=0){
		$('#kelas').prop('disabled',false);
		$('#studi').prop('disabled',false);
	}else{
		$('#kelas').prop('disabled',true);
		$('#studi').prop('disabled',true);
	}
	
	if(tingkat!=4){
		var jenjang_next=parseInt(tingkat)+1;
		$('#jurusan').prop('disabled',true);
		$('#jurusan').val(0);
	}else{
		$('#jurusan').prop('disabled',false);
	}
}

function cek_form()
{
	var tingkat=$("#tingkat").val();

	if(tingkat==0){
        alert('Belum ada Tingkat Sekolah yang dipilih');
		return false;
	}
	
	return true;
}
</script>

<script>
$( function(){
	$( "#txt_tgl_mulai" ).datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$( "#txt_tgl_selesai" ).datepicker({
		dateFormat: "yy-mm-dd"
	});
} );
</script>
