<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo ucwords($title); ?>
	</h1>
</section>

<section class="content">
	<div class="row">		
		<div class="col-md-9">
			<?php
			if(isset($message)){
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-<?php echo $alert; ?>" alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fa fa-info"></i><?php echo $message;?>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			
			<div class="box box-success">
				<div class="box-body">
					<?php
					$parent = $this->session->userdata("session_parent_ujian");
					if(isset($parent) && $parent!="")
					{
						?><a href='javascript:;' onClick=refresh_function(); class='btn btn-sm btn-success' title='Tampilkan Semua Data'>Tampil Semua Ujian</a><br><br><?php
					}					
					?>
					<table id="my-table" class="display nowrap" width="100%">
						<thead>
							<tr>
								<th style="width: 9%;">Status</th>
								<th>Judul Ujian</th>
								<th>Waktu</th>
								<th>Jumlah</th>
								<th>Bidang Studi</th>
								<th>Tgl.Mulai</th>
							</tr>
						</thead>
					</table>
					
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
$random   = rand();
$ejenjang = base64_encode($random."-".$this->session->userdata("siswaJenjang"));
$ejurusan = base64_encode($random."-".$this->session->userdata("siswaJurusan"));
$ekelas   = base64_encode($random."-".$this->session->userdata("siswaKelas"));
$ekode    = base64_encode($random."-".$this->session->userdata("siswaId"));
?>

<script type="text/javascript">
$(document).ready(function() {
     $('#my-table').DataTable({responsive: false,
        "processing" : true,
        "serverSide" : true,
		"scrollX"    : true,
		"order": [[ 1, "asc" ]],
        "ajax" : {
			url: "<?php echo site_url("ujian_online/ujian_ajax?jj=".$ejenjang."&kd=".$ekode."&jr=".$ejurusan."&kl=".$ekelas); ?>",
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
            "targets": [0,3], "orderable": false
        }]
    });
});

function refresh_function(m) 
{
    var base_url = "ujian_online/refresh_data";
    window.location.href = "<?php echo site_url(); ?>"+base_url;
}

function view_function(m,id) 
{
	var base_url = "ujian_online/tampil_data?id="+id;
	window.location.href = "<?php echo site_url(); ?>"+base_url;
}

function konfirmasi_function(id) {
    var base_url = "ujian_online/konfirmasi?id="+id;
    window.location.href = "<?php echo site_url(); ?>"+base_url;
}

function progress_function(m,id,kd,jj) {
    var base_url = "ujian_online/tampil?m="+m+"&id="+id+"&kd="+kd+"&jj="+jj;
    window.location.href = "<?php echo site_url(); ?>"+base_url;
}

function hasil_function(id) {
	var base_url = "ujian_online/hasil?jd="+id;
	window.location.href = "<?php echo site_url(); ?>"+base_url;
}
</script>
