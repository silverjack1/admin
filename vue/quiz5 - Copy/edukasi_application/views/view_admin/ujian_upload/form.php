<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo ucwords($title); ?>
	</h1>
</section>

<?php
$upload_id  = isset($qry_upload) ? $qry_upload->upload_id : "";
$upload_ket = isset($qry_upload) ? $qry_upload->upload_ket : "";
$upload_url = isset($qry_upload) ? $qry_upload->upload_url : "";

$random = rand();
$id = base64_encode($random."-".$upload_id);
$delete = base64_encode($random."-delete");
$btn_value = $upload_id === "" ? "btn_simpan" : "btn_ubah";

echo validation_errors();$konfirmasi = "onClick=\"return confirm('Apakah Anda Yakin?')\"";
?>

<script src='<?php echo base_url("assets/plugins/tinymce/tinymce.min.js"); ?>'></script>
<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url("ujian_upload/form"); ?>">
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box-body box-profile">
				<div class="box box-warning">
					<div class="box-body">

						<div class="form-group">
							<label class="col-sm-2 control-label">Judul File</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="txt_upload_ket" name="txt_upload_ket" value="<?php echo $upload_ket; ?>" required>
							</div>
						</div>

                        <?php
	                    if($btn_value!="btn_ubah"){
	                    ?>
	
                        <div class="form-group">
							<label class="col-sm-2 control-label">Upload File</label>
							<div class="col-sm-8">
                                <input type="file" class="form-control" name="fileuser" id="fileuser" required> 
							</div>
						</div>

	                    <?php
	                    }
	                    ?>
						
						<div class="box-footer">
							<input type="hidden" name="hdd_upload_id" id="hdd_upload_id" value="<?php echo $upload_id; ?>">
                            <input type="hidden" name="hdd_file_lama" id="hdd_file_lama" value="<?php echo $upload_url; ?>">
							
							<a href="<?php echo site_url('ujian_upload') ?>" class="btn btn-danger">Batal</a>&nbsp;
							<button type="submit" name="btn_simpan" id="btn_simpan" value="<?php echo $btn_value; ?>"  onClick="return cek_form()" class="btn btn-primary" <?php echo $konfirmasi;?>>Simpan</button>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</form>
