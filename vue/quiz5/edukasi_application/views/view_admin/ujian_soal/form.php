<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo ucwords($title); ?>
	</h1>
</section>

<?php
$soal_id = isset($qry_soal) ? $qry_soal->soal_id : "";
$soal_update  = isset($qry_soal) ? ucwords($qry_soal->soal_update_date) : date("d-m-Y h:m:s");;
$soal_pertanyaan = isset($qry_soal) ? $qry_soal->soal_pertanyaan : "";
$soal_lampiran   = isset($qry_soal) ? strtolower($qry_soal->soal_lampiran) : "";

$soal_opsi_a  = isset($qry_soal) ? $qry_soal->soal_opsi_a  : "";
$soal_opsi_b  = isset($qry_soal) ? $qry_soal->soal_opsi_b  : "";
$soal_opsi_c  = isset($qry_soal) ? $qry_soal->soal_opsi_c  : "";
$soal_opsi_d  = isset($qry_soal) ? $qry_soal->soal_opsi_d  : "";
$soal_opsi_e  = isset($qry_soal) ? $qry_soal->soal_opsi_e  : "";
$soal_jawaban = isset($qry_soal) ? $qry_soal->soal_jawaban : "";
$soal_bobot   = isset($qry_soal) ? $qry_soal->soal_bobot   : "1";

//menangani get
$tk = $this->input->get('tk');
$kl = $this->input->get('kl');
$jr = $this->input->get('jr');
$th = $this->input->get('th');
$st = $this->input->get('st');

if(isset($tk) && $tk!=""){
	$soal_tingkat = $tk;
}else{
	$soal_tingkat = isset($qry_soal) ? ucwords($qry_soal->soal_tingkat) : "";
}

if(isset($kl) && $kl!=""){
	$soal_kelas   = $kl;
}else{
	$soal_kelas   = isset($qry_soal) ? ucwords($qry_soal->soal_kelas) : "";
}

if(isset($jr) && $jr!=""){
	$soal_jurusan = $jr;
}else{
	$soal_jurusan = isset($qry_soal) ? ucwords($qry_soal->soal_jurusan) : "";
}

if(isset($th) && $th!=""){
	$soal_tahun   = $th;
}else{
	$soal_tahun   = isset($qry_soal) ? ucwords($qry_soal->soal_tahun) : $this->session->userdata('ta_idSkr');
}

if(isset($st) && $st!=""){
	$soal_studi   = $st;
}else{
	$soal_studi   = isset($qry_soal) ? ucwords($qry_soal->soal_studi) : "";
}

if($soal_id === ""){
	$btn_value = "btn_simpan";
	$tanggal = "Tgl. Input";
}else{
	$btn_value = "btn_ubah";
	$tanggal = "Tgl. Update";
}

$random = rand();
$id = base64_encode($random."-".$soal_id);
$delete = base64_encode($random."-delete");
$elampiran = base64_encode($random."-".$soal_lampiran);

echo validation_errors();$konfirmasi = $btn_value === "btn_ubah" ? "onClick=\"return confirm('Apakah Anda Yakin?')\"" : "";
?>

<script src='<?php echo base_url("assets/plugins/tinymce/tinymce.min.js"); ?>'></script>
<form class="form-horizontal" method="post" enctype="multipart/form-data" method="post" action="<?php echo site_url("ujian_soal/form"); ?>">
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
										$selected = $soal_tahun == $row_ta->ta_id ? "selected=\"selected\"" : "";
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
										$selected = $soal_tingkat === $row_jenjang->jenjang_id ? "selected=\"selected\"" : "";
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
									<option value="0" <?php if($soal_jurusan==0){ echo "selected=\"selected\""; } ?>>Semua Jurusan</option>
									<option value="1" <?php if($soal_jurusan==1){ echo "selected=\"selected\""; } ?>>IPA</option>
									<option value="2" <?php if($soal_jurusan==2){ echo "selected=\"selected\""; } ?>>IPS</option>
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
							<div class="col-sm-5">
								<input type="text" class="form-control" value="<?php echo $soal_update; ?>" disabled>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Pertanyaan</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="txt_soal_pertanyaan" name="txt_soal_pertanyaan" autofocus="autofocus"><?php echo $soal_pertanyaan; ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Pilihan A</label>
							<div class="col-sm-3">
								<textarea class="form-control" id="txt_opsi_a" name="txt_opsi_a" autofocus="autofocus"><?php echo $soal_opsi_a; ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Pilihan B</label>
							<div class="col-sm-3">
								<textarea class="form-control" id="txt_opsi_b" name="txt_opsi_b" autofocus="autofocus"><?php echo $soal_opsi_b; ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Pilihan C</label>
							<div class="col-sm-3">
								<textarea class="form-control" id="txt_opsi_c" name="txt_opsi_c" autofocus="autofocus"><?php echo $soal_opsi_c; ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Pilihan D</label>
							<div class="col-sm-3">
								<textarea class="form-control" id="txt_opsi_d" name="txt_opsi_d" autofocus="autofocus"><?php echo $soal_opsi_d; ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Pilihan E</label>
							<div class="col-sm-3">
								<textarea class="form-control" id="txt_opsi_e" name="txt_opsi_e" autofocus="autofocus"><?php echo $soal_opsi_e; ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Jawaban</label>
							<div class="col-sm-3">
								<select name="opt_jawaban" id="opt_jawaban" class="form-control">
									<option value="A" <?php if($soal_jawaban=="A"){ echo "selected=\"selected\""; } ?>>A</option>
									<option value="B" <?php if($soal_jawaban=="B"){ echo "selected=\"selected\""; } ?>>B</option>
									<option value="C" <?php if($soal_jawaban=="C"){ echo "selected=\"selected\""; } ?>>C</option>
									<option value="D" <?php if($soal_jawaban=="D"){ echo "selected=\"selected\""; } ?>>D</option>
									<option value="E" <?php if($soal_jawaban=="E"){ echo "selected=\"selected\""; } ?>>E</option>
								</select>
							</div>
						</div>
						
						<div class="box-footer">
							<input type="hidden" name="txt_soal_id" id="txt_soal_id" value="<?php echo $soal_id; ?>">
							<input type="hidden" name="hdd_akademik_kelas" id="hdd_akademik_kelas" value="<?php echo $soal_kelas; ?>">
							<input type="hidden" name="hdd_akademik_studi" id="hdd_akademik_studi" value="<?php echo $soal_studi; ?>">
							<input type="hidden" name="hdd_soal_id" id="hdd_soal_id" value="<?php echo $this->input->get('id'); ?>">
							
							<a href="<?php echo site_url('ujian_soal') ?>" class="btn btn-danger">Batal</a>&nbsp;
							<button type="submit" name="btn_simpan" id="btn_simpan" value="<?php echo $btn_value; ?>" onClick="return cek_form()" class="btn btn-primary" <?php echo $konfirmasi;?>>Simpan Soal</button>&nbsp;
                            <a href="<?php echo site_url('ujian_upload') ?>" target="_blank" class="btn btn-success"><i class="fa fa-picture-o"></i> &nbsp;Upload Media</a>&nbsp;						
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
	var soal=$("#txt_soal_pertanyaan").val();
	var opsi_a=$("#txt_opsi_a").val();
	var opsi_b=$("#txt_opsi_b").val();
	var opsi_c=$("#txt_opsi_c").val();
	var opsi_d=$("#txt_opsi_d").val();

	if(tingkat==0){
        alert('Belum ada Tingkat Sekolah yang dipilih');
		return false;
	}
	
	return true;
}

	
function del_function(m,id,lampiran) 
{
    if (confirm('Apakah Anda Yakin?'))
    {
        var base_url = "ujian_soal/delete_lampiran?m="+m+"&id="+id+"&fl="+lampiran;
        window.location.href = "<?php echo site_url(); ?>"+base_url;
    }else{}
}

function media_function() 
{
	var base_url = "ujian_upload";
	window.open("<?php echo site_url(); ?>"+base_url);
}
</script>

<script type="text/javascript">
tinymce.init({
	selector: '#txt_opsi_a',
	relative_urls : false,
    remove_script_host : false,
    inline: false,
	menubar: false,
	statusbar: false,
	plugins: [
	"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak",
	"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	"table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern eqneditor tiny_mce_wiris"
	],
	toolbar: 'alignleft aligncenter alignright alignjustify subscript superscript eqneditor charmap image link unlink outdent indent table preview code',
	width: 600,
	height: 10,
});

tinymce.init({
	selector: '#txt_opsi_b',
	relative_urls : false,
    remove_script_host : false,
    inline: false,
	menubar: false,
	statusbar: false,
	plugins: [
	"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak",
	"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	"table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern eqneditor tiny_mce_wiris"
	],
	toolbar: 'alignleft aligncenter alignright alignjustify subscript superscript eqneditor charmap image link unlink outdent indent table preview code',
	width: 600,
	height: 10,
});

tinymce.init({
	selector: '#txt_opsi_c',
	relative_urls : false,
    remove_script_host : false,
    inline: false,
	menubar: false,
	statusbar: false,
	plugins: [
	"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak",
	"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	"table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern eqneditor tiny_mce_wiris"
	],
	toolbar: 'alignleft aligncenter alignright alignjustify subscript superscript eqneditor charmap image link unlink outdent indent table preview code',
	width: 600,
	height: 10,
});

tinymce.init({
	selector: '#txt_opsi_d',
	relative_urls : false,
    remove_script_host : false,
    inline: false,
	menubar: false,
	statusbar: false,
	plugins: [
	"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak",
	"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	"table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern eqneditor tiny_mce_wiris"
	],
	toolbar: 'alignleft aligncenter alignright alignjustify subscript superscript eqneditor charmap image link unlink outdent indent table preview code',
	width: 600,
	height: 10,
});

tinymce.init({
	selector: '#txt_opsi_e',
	relative_urls : false,
    remove_script_host : false,
    inline: false,
	menubar: false,
	statusbar: false,
	plugins: [
	"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak",
	"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	"table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern eqneditor tiny_mce_wiris"
	],
	toolbar: 'alignleft aligncenter alignright alignjustify subscript superscript eqneditor charmap image link unlink outdent indent table preview code',
	width: 600,
	height: 10,
});

tinymce.init({
	selector: "textarea",
	relative_urls : false,
    remove_script_host : false,
    document_base_url : "http://simteg.bintangpelajar.net",
	theme: 'modern',
	browser_spellcheck: true,
	statusbar: true,
	menubar: false,
	width: 600,
	height: 200,
	plugins: [
	"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak",
	"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	"table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern eqneditor tiny_mce_wiris"
	],
	toolbar1: "undo redo | cut copy paste searchreplace | bold italic underline | bullist numlist outdent indent",
	toolbar2: "alignleft aligncenter alignright alignjustify | link unlink image media | fontselect fontsizeselect",
	toolbar3: "insertdatetime table | subscript superscript eqneditor tiny_mce_wiris_formulaEditor charmap | print fullscreen preview code",
	audio_template_callback: function(data) {
	   return '<audio controls>' + '\n<source src="' + data.source1 + '"' + (data.source1mime ? ' type="' + data.source1mime + '"' : '') + ' />\n' + '</audio>';
	}
});
</script>
