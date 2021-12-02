<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo ucwords($title); ?>
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-body box-profile">
					
					<?php
					if(isset($message))
                    {
					?>
					<div class="alert alert-<?php echo $alert; ?> alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p><i class="icon fa fa-info"></i><?php echo $message;?></p>
					</div>
					<?php
					}
					?>

					<table id="my-table" class="display compact nowrap" width="100%">
						<thead>
							<tr>
								<th>Option</th>
								<th>ID</th>
								<th>Siswa</th>
								<th>NIS</th>
								<th>Akademik</th>
								<th>Bidang Studi</th>
								<th>Tipe Ujian</th>
								<th>Judul Ujian</th>
								<th>Nilai</th>
								<th>Detail Jawaban</th>
								<th>Mulai</th>
								<th>Selesai</th>
								<th>Device</th>
							</tr>
						</thead>
					</table>
				
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
$(document).ready(function(){
     var table = $('#my-table').DataTable({responsive: false,
        "processing" : true,
        "serverSide" : true,
		"scrollX" : true,
		"bLengthChange" : false,
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"order": [[ 1, "desc" ]],
        "ajax" : {
            url: "<?php echo site_url("ujian_hasil/siswa_ujian_ajax"); ?>",
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
            "targets": [0,9], "orderable": false
        }]
    });
	
	new $.fn.dataTable.Buttons( table, {
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy',
				exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
				exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
				exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
			'colvis',
			'pageLength'
        ]
    } );
 
    table.buttons( 0, null ).container().prependTo(
        table.table().container()
    );
});

function klik_hapus(id,m) 
{
	if (confirm('Apakah Anda Yakin?'))
    {
		var base_url = "ujian_hasil/hapus?id="+id+"&m="+m+"&cb="+'<?php echo $this->input->get('cb');?>'+"&th="+'<?php echo $this->input->get('id');?>';
		window.location.href = "<?php echo site_url(); ?>"+base_url;
	}
    else{}
}

function klik_del_function(id,m) 
{	
    if (confirm('Apakah Anda Yakin?'))
    {
       var base_url = "ujian_hasil/hapus?id="+id+"&m="+m+"&cb="+'<?php echo $this->input->get('cb');?>'+"&th="+'<?php echo $this->input->get('id');?>';
       window.open("<?php echo site_url(); ?>"+base_url);
    }else{}
}
</script>
