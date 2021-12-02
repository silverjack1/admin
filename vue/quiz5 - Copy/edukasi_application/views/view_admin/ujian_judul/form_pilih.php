<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo ucwords($title); ?>
	</h1>
</section>

<?php
$judul_id = isset($qry_judul) ? $qry_judul->judul_id : "";
$judul_tingkat = isset($qry_judul) ? ucwords($qry_judul->judul_tingkat) : "";
$judul_kelas   = isset($qry_judul) ? ucwords($qry_judul->judul_kelas) : "";
$judul_jurusan = isset($qry_judul) ? ucwords($qry_judul->judul_jurusan) : "";
$judul_studi   = isset($qry_judul) ? ucwords($qry_judul->judul_studi) : "";
$judul_bds     = isset($qry_judul) ? ucwords($qry_judul->bds_ket) : "";
$judul_tahun   = isset($qry_judul) ? ucwords($qry_judul->judul_tahun) : $this->session->userdata('ta_idSkr');
$judul_update  = isset($qry_judul) ? ucwords($qry_judul->judul_update_date) : date("d-m-Y h:m:s");
$judul_keterangan  = isset($qry_judul) ? ucwords($qry_judul->judul_keterangan) : "";
$judul_waktu   	   = isset($qry_judul) ? ucwords($qry_judul->judul_waktu) : "";
$judul_tgl_mulai   = isset($qry_judul) ? ucwords($qry_judul->judul_tgl_mulai) : "";
$judul_tgl_selesai = isset($qry_judul) ? ucwords($qry_judul->judul_tgl_selesai) : "";
$judul_jam_mulai   = isset($qry_judul) ? ucwords($qry_judul->judul_jam_mulai) : "";
$judul_jam_selesai = isset($qry_judul) ? ucwords($qry_judul->judul_jam_selesai) : "";

if($judul_id === ""){
	$btn_value = "btn_simpan";
	$tanggal = "Tgl. Input";
}else{
	$btn_value = "btn_ubah";
	$tanggal = "Tgl. Update";
}

$random = rand();
$ejudul = base64_encode($random."-".$judul_id);
		
echo validation_errors();$konfirmasi = $btn_value === "btn_ubah" ? "onClick=\"return confirm('Apakah Anda Yakin?')\"" : "";
?>

<form class="form-horizontal">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box-body box-profile">
				<div class="box box-warning">
					<div class="box-body">
						
						<input type="hidden" name="txt_judul_id" id="txt_judul_id" value="<?php echo $judul_id; ?>">
						<input type="hidden" name="hdd_akademik_kelas" id="hdd_akademik_kelas" value="<?php echo $judul_kelas; ?>">
						<input type="hidden" name="hdd_akademik_studi" id="hdd_akademik_studi" value="<?php echo $judul_studi; ?>">
						
						<input type="hidden" id="hdd_id" value="<?php echo $this->input->get('id'); ?>">
						<input type="hidden" id="hdd_m"  value="<?php echo $this->input->get('m'); ?>">
						<input type="hidden" id="hdd_a"  value="<?php echo $this->input->get('a'); ?>">
						<input type="hidden" id="hdd_th" value="<?php echo $this->input->get('th'); ?>">

						<div class="form-group">
							<label class="col-sm-2 control-label">Tahun Ajaran</label>
							<div class="col-sm-4">
								<select name="opt_tahun" id="opt_tahun" class="form-control" disabled>
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
								<select name="opt_tingkat" id="tingkat" class="form-control" disabled>
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
								<select name="opt_kelas" id="kelas" class="form-control" disabled>
									<option>Kelas</option>
								</select>
							</div>
							<div class="col-sm-2">
								<select name="opt_jurusan" id="jurusan" class="form-control" disabled>
									<option value="0" <?php if($judul_jurusan==0){ echo "selected=\"selected\""; } ?>>Semua Jurusan</option>
									<option value="1" <?php if($judul_jurusan==1){ echo "selected=\"selected\""; } ?>>IPA</option>
									<option value="2" <?php if($judul_jurusan==2){ echo "selected=\"selected\""; } ?>>IPS</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Bidang Studi</label>
							<div class="col-sm-4">
								<select class="form-control" name="opt_studi" id="studi" disabled>
									<option value="0">Bidang Studi</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Judul Ujian</label>
							<div class="col-sm-4">
								<input type="hidden" name="hdd_judul_lama" id="hdd_judul_lama" value="<?php echo $judul_keterangan; ?>" disabled>
								<input type="text" id="txt_keterangan" name="txt_keterangan" class="form-control" placeholder="Judul Ujian" value="<?php echo $judul_keterangan; ?>" disabled>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Waktu Pengerjaan</label>
							<div class="col-sm-4">
								<input type="text" id="txt_waktu" name="txt_waktu" class="form-control" placeholder="Dalam Satuan Menit" value="<?php echo $judul_waktu; ?>" maxlength="3" disabled>
							</div>
						</div>
						
						<?php
						if($judul_tgl_selesai=="0000-00-00"){
							$judul_tgl_selesaiku="";
						}else{
							$judul_tgl_selesaiku=$judul_tgl_selesai;
						}
						?>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Tanggal Pelaksanaan</label>
							<div class="col-sm-4">
								<input type="text" id="txt_tgl_mulai" name="txt_tgl_mulai" class="form-control"  placeholder="Tanggal Mulai" value="<?php echo $judul_tgl_mulai; ?>" disabled>
							</div>
							<div class="col-sm-2">
								<label>Sampai Dengan</label>
							</div>
							<div class="col-sm-2">
								<input type="text" id="txt_tgl_selesai" name="txt_tgl_selesai" class="form-control"  placeholder="Tanggal Selesai" value="<?php echo $judul_tgl_selesaiku; ?>" disabled>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Jam Pelaksanaan</label>
							<div class="col-sm-4">
								<input type="text" id="txt_jam_mulai" name="txt_jam_mulai" class="form-control" placeholder="jam:menit" maxlength="5" value="<?php echo $judul_jam_mulai; ?>" disabled> 
							</div>
							<div class="col-sm-2">
								<label>Sampai Dengan</label>
							</div>
							<div class="col-sm-2">
								<input type="text" id="txt_jam_selesai" name="txt_jam_selesai"  class="form-control" placeholder="jam:menit" maxlength="5" value="<?php echo $judul_jam_selesai; ?>" disabled>
							</div>
						</div>
						<a href="<?php echo site_url('ujian_judul') ?>" class="btn btn-danger">Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="box-body box-profile">
				<div class="box box-success">
					<div class="box-body">
					
						<form title="Filter Berdasarkan Tahun Ajaran">
							<div class="form-group">
								<label class="col-sm-2 control-label">Filter Tahun Ajaran</label>
								<div class="col-sm-2">
									<select name="filter_tahun" id="filter_tahun" class="form-control">
										<?php
										$fil_thn=$this->input->get('th');
										
										if(isset($fil_thn) && $fil_thn!=""){
											$thn = $this->input->get("th");
											$thn_decrypt = base64_decode("$thn");
											$tahun = explode("-",$thn_decrypt);
										
											$judul_tahunku = $tahun[1];;
										}else{
											$judul_tahunku = $judul_tahun;
										}
										
										foreach($res_ta as $row_ta)
										{
											$selected = $judul_tahunku == $row_ta->ta_id ? "selected=\"selected\"" : "";
											?>
											<option value="<?php echo $row_ta->ta_id; ?>" <?php echo $selected; ?>><?php echo strtoupper($row_ta->ta_tahun1); ?> / <?php echo strtoupper($row_ta->ta_tahun2); ?></option>
											<?php
										}
										?>
									</select>
								</div>
								<div class="col-sm-3">
									<button type="button" name="btn_refresh" id="btn_refresh" title="Refresh Tahun Ajaran" class="btn btn-success btn-sm"  onClick="refresh_function('<?php echo $this->input->get('id');?>')">Refresh</button>
								</div>
							</div>
						</form>
						
						<table id="my-table" class="display compact nowrap" width="100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Pertanyaan</th>
									<th>Jawaban</th>
									<th>TA</th>
									<th>Bidang Studi</th>
									<th>Jenjang</th>
									<th>Kelas</th>
									<th style="width: 8%;">Option</th>
								</tr>
							</thead>
						</table>
					
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="box-body box-profile">
				<div class="box box-danger">
					<div class="box-body">
					
						<table id="my-soal" class="display compact nowrap" width="100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Pertanyaan</th>
									<th>Jawaban</th>
									<th>TA</th>
									<th>Bidang Studi</th>
									<th>Jenjang</th>
									<th>Kelas</th>
									<th style="width: 8%;">Option</th>
								</tr>
							</thead>
						</table>	
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
</section>
</form>

<script type="text/javascript">
$(document).ready(function(){
	$('#my-table').DataTable({responsive: true,
        "processing" : true,
        "serverSide" : true,
		"order": [[ 0, "asc" ]],
        "ajax" : {
            url: "<?php echo site_url("ujian_judul/pilih_soal_ajax?ejd=".$ejudul."&th=".$judul_tahunku."&st=".$judul_studi."&jr=".$judul_jurusan."&kl=".$judul_kelas."&tk=".$judul_tingkat); ?>",
            type: "post",
            error: function() {
                $(".my-table-error").html("");
                $("#my-table").append('<tbody class="my-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#my-table_processing").css("display","none");
            }
        },
		"language": {
            
			"sZeroRecords":  "Tidak ada data di database",
			"sProcessing":   "Sedang memproses...",
			"sLengthMenu":   "Tampilkan _MENU_ data",
			"sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			"sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 data",
			"sSearch":       "Cari data:",
			"oPaginate": {
				"sFirst":    "Pertama",
				"sPrevious": "Sebelumnya",
				"sNext":     "Selanjutnya",
				"sLast":     "Terakhir"
			}
		},
        "columnDefs": [{
            "targets": [2,3,4,5,6,7], "orderable": false
        }]
    });
	
	$('#my-soal').DataTable({responsive: true,
         "processing" : true,
        "serverSide" : true,
		"order": [[ 0, "asc" ]],
        "ajax" : {
            url: "<?php echo site_url("ujian_judul/list_soal_ajax?ejd=".$ejudul); ?>",
            type: "post",
            error: function() {
                $(".my-table-error").html("");
                $("#my-table").append('<tbody class="my-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#my-table_processing").css("display","none");
            }
        },
		"language": {
            
			"sZeroRecords":  "Tidak ada data di database",
			"sProcessing":   "Sedang memproses...",
			"sLengthMenu":   "Tampilkan _MENU_ data",
			"sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			"sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 data",
			"sSearch":       "Cari data:",
			"oPaginate": {
				"sFirst":    "Pertama",
				"sPrevious": "Sebelumnya",
				"sNext":     "Selanjutnya",
				"sLast":     "Terakhir"
			}
		},
        "columnDefs": [{
            "targets": [2,3,4,5,6,7], "orderable": false
        }]
    });
	
    $("#tingkat").change(function(){
        tampil_bidang_studi();
    });
	
	$("#filter_tahun").change(function(){
		var tahun = $("#filter_tahun").val();
		var m  = $("#hdd_m").val();
		var a  = $("#hdd_a").val();
		var id = $("#hdd_id").val();
		
		var base_url = "ujian_judul/tampil_data?th="+tahun+"&m="+m+"&a="+a+"&id="+id;
		window.location.href = "<?php echo site_url(); ?>"+base_url;
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
		$('#kelas').prop('disabled',true);
		$('#studi').prop('disabled',true);
	}else{
		$('#kelas').prop('disabled',true);
		$('#studi').prop('disabled',true);
	}
	
	if(tingkat!=4){
		var jenjang_next=parseInt(tingkat)+1;
		$('#jurusan').prop('disabled',true);
		$('#jurusan').val(0);
	}else{
		$('#jurusan').prop('disabled',true);
	}
}

function refresh_function(id) 
{
	var base_url = "ujian_judul/form_pilih?id="+id;
	window.location.href = "<?php echo site_url(); ?>"+base_url;
}

function view_function(m,id)
{
	var base_url = "ujian_soal/form?m="+m+"&id="+id;
	window.open("<?php echo site_url(); ?>"+base_url);
}

function viewklik_function(m,id) 
{
	var base_url = "ujian_soal/form?m="+m+"&id="+id;
	window.open("<?php echo site_url(); ?>"+base_url);
}

function add_function(m,id) 
{
	if (confirm('Apakah Anda yakin?'))
    {
        var tahun = $('#hdd_th').val();
		var base_url = "ujian_judul/submit?m="+m+"&id="+id+"&ejd="+'<?php echo $ejudul; ?>'+"&th="+tahun;
        window.location.href = "<?php echo site_url(); ?>"+base_url;
    }else{}
}

function addklik_function(m,id) 
{
	if (confirm('Apakah Anda yakin?'))
    {
        var tahun = $('#hdd_th').val();
		var base_url = "ujian_judul/submit?m="+m+"&id="+id+"&ejd="+'<?php echo $ejudul; ?>'+"&th="+tahun;
        window.open("<?php echo site_url(); ?>"+base_url);
    }else{}
}

function delete_function(m,id) 
{
	if (confirm('Apakah Anda yakin?'))
    {
        var tahun = $('#hdd_th').val();
		var base_url = "ujian_judul/batal_soal?m="+m+"&id="+id+"&ejd="+'<?php echo $ejudul; ?>'+"&th="+tahun;
        window.location.href = "<?php echo site_url(); ?>"+base_url;
    }else{}
}

function delklik_function(m,id) 
{
	if (confirm('Apakah Anda yakin?'))
    {
        var tahun = $('#hdd_th').val();
		var base_url = "ujian_judul/batal_soal?m="+m+"&id="+id+"&ejd="+'<?php echo $ejudul; ?>'+"&th="+tahun;
        window.open("<?php echo site_url(); ?>"+base_url);
    }else{}
}
</script>
