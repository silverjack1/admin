<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo ucwords($title); ?>
	</h1>
</section>

<?php
$siswa_id       = isset($qry_siswa) ? $qry_siswa->siswa_id : "";
$siswa_nis      = isset($qry_siswa) ? ucwords($qry_siswa->siswa_nis) : "";
$siswa_nama     = isset($qry_siswa) ? ucwords($qry_siswa->siswa_nama) : "";
$siswa_kelamin  = isset($qry_siswa) ? ucwords($qry_siswa->siswa_kelamin) : "";
$siswa_jenjang  = isset($qry_siswa) ? ucwords($qry_siswa->siswa_jenjang) : "";
$siswa_jurusan  = isset($qry_siswa) ? ucwords($qry_siswa->siswa_jurusan) : "";
$siswa_kelas    = isset($qry_siswa) ? ucwords($qry_siswa->siswa_kelas) : "";
$siswa_username = isset($qry_siswa) ? $qry_siswa->siswa_username : "";
$siswa_password = isset($qry_siswa) ? $qry_siswa->siswa_password : "";

$btn_value = $siswa_id === "" ? "btn_simpan" : "btn_ubah";
echo validation_errors();$konfirmasi = $btn_value === "btn_ubah" ? "onClick=\"return confirm('Apakah Anda Yakin?')\"" : "";
?>

<form class="form-horizontal" method="post" action="<?php echo site_url("siswa/form"); ?>" autocomplete="off">
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box-body box-profile">
				<div class="box box-warning">
					<div class="box-body">

						<div class="form-group">
							<label class="col-sm-3 control-label">NIS</label>
							<div class="col-sm-8">
								<input type="hidden" name="hdd_siswa_id" id="hdd_siswa_id" value="<?php echo $siswa_id; ?>">
								<input type="text" class="form-control" name="siswa_nis" id="siswa_nis" value="<?php echo ucwords($siswa_nis); ?>" required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Siswa</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="siswa_nama" id="siswa_nama" value="<?php echo ucwords($siswa_nama); ?>" required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Jenis Kelamin</label>
							<div class="col-sm-8">
								<input name="siswa_kelamin" id="siswa_kelamin" <?php if($siswa_kelamin==1){ echo "checked"; } ?> type="radio" value="1" required>Laki-Laki&nbsp;
								<input name="siswa_kelamin" id="siswa_kelamin" <?php if($siswa_kelamin==2){ echo "checked"; } ?> type="radio" value="2" required>Perempuan
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Jenjang</label>
							<div class="col-sm-8">
								<select name="siswa_jenjang" id="siswa_jenjang" class="form-control">
									<option value="1" <?php if($siswa_jenjang==1){ echo "selected=\"selected\""; } ?>>TK</option>
									<option value="2" <?php if($siswa_jenjang==2){ echo "selected=\"selected\""; } ?>>SD</option>
									<option value="3" <?php if($siswa_jenjang==3){ echo "selected=\"selected\""; } ?>>SMP</option>
									<option value="4" <?php if($siswa_jenjang==4){ echo "selected=\"selected\""; } ?>>SMA</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Kelas</label>
							<input type="hidden" name="hdd_kelas" id="hdd_kelas" value="<?php echo $siswa_kelas; ?>">
							<div class="col-sm-8">
								<select name="siswa_kelas" id="siswa_kelas" class="form-control"></select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Jurusan</label>
							<div class="col-sm-8">
								<select name="siswa_jurusan" id="siswa_jurusan" class="form-control">
									<option value="0" <?php if($siswa_jurusan==0){ echo "selected=\"selected\""; } ?>>Pilih Jurusan</option>
									<option value="1" <?php if($siswa_jurusan==1){ echo "selected=\"selected\""; } ?>>IPA</option>
									<option value="2" <?php if($siswa_jurusan==2){ echo "selected=\"selected\""; } ?>>IPS</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Username</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="siswa_username" id="siswa_username" autocomplete="false" value="<?php echo $siswa_username; ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Password</label>
							<div class="col-sm-8">
								<input type="hidden" name="hdd_password_lama" id="hdd_password_lama" value="<?php echo ucwords($siswa_password); ?>">
								<input type="password" class="form-control" name="siswa_password" autocomplete="false" id="siswa_password">
							</div>
						</div>
						
						<div class="box-footer">
							<a href="<?php echo site_url('siswa') ?>" class="btn btn-danger">Batal</a>&nbsp;
							<button type="submit" name="btn_simpan" id="btn_simpan" value="<?php echo $btn_value; ?>" class="btn btn-primary" <?php echo $konfirmasi;?>>Simpan</button>
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
	$("#siswa_jenjang").change(function(){
        tampil_kelas();
    });
	
	tampil_kelas();
});

function tampil_kelas()
{
	var tingkat = $("#siswa_jenjang").val();
	var kelas_ku = $("#hdd_kelas").val();
        
	$.ajax({
		url: "<?php echo site_url("siswa/kelas_ajax"); ?>",
		data: "tingkat="+tingkat+"&kelas_ku="+kelas_ku,
		success:function(data){
			$("#siswa_kelas").html(data);
		}
	});
	
	if(tingkat!=4){
		$('#siswa_jurusan').prop('disabled',true);
		$('#siswa_jurusan').val(0);
	}else{
		$('#siswa_jurusan').prop('disabled',false);
	}
}
</script>
