<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$tk = $this->input->get('tk');
$kl = $this->input->get('kl');
$jr = $this->input->get('jr');
$th = $this->input->get('th');
$st = $this->input->get('st');
$id = $this->input->get('id');

if($jr==""){
	$jurusan=0;
}else{
	$jurusan=$jr;
}
?>

<section class="content-header">
	<h1>
		<?php echo ucwords($title); ?>
	</h1>
</section>

<section class="content">
	<div class="row">
	
		<div class="col-md-4">
			<div class="box box-warning">
				<div class="box-body box-profile">
			
					<?php
					if(isset($message)){
					?>
					<div class="alert alert-<?php echo $alert; ?> alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<p><i class="icon fa fa-info"></i><?php echo $message;?></p>
					</div>
					<?php
					}
					?>
					
					<button type="button" class='btn btn-sm btn-success' onClick=input_function(); tabindex="1">TAMBAH SOAL</button>
					<?php
					if(isset($id) && $id!=""){
						?><button type="button" class='btn btn-sm btn-primary' onClick=edit_function(); tabindex="2">EDIT SOAL</button><?php
					}
					?>
					<button type="button" class='btn btn-sm btn-danger' onClick=view_function(); tabindex="2">LIHAT SOAL</button>
				</div>
			</div>
		</div>
		
	</div>
</section>

<script type="text/javascript">
function input_function() 
{
	var base_url = "ujian_soal/form?m=MjAwNDQtYWRk&tk="+<?php echo $tk;?>+"&kl="+<?php echo $kl;?>+"&jr="+<?php echo $jurusan;?>+"&th="+<?php echo $th;?>+"&st="+<?php echo $st;?>;
	window.location.href = "<?php echo site_url(); ?>"+base_url;
}

function edit_function() 
{
	var base_url = "ujian_soal/form?m=MTY2MTUtZWRpdA==&id=<?php echo $id;?>";
	window.location.href = "<?php echo site_url(); ?>"+base_url;
}

function view_function() 
{
	var base_url = "ujian_soal";
	window.location.href = "<?php echo site_url(); ?>"+base_url;
}
</script>