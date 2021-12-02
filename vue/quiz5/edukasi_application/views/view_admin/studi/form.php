<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo ucwords($title); ?>
	</h1>
</section>

<?php
$bds_id      = isset($qry_data) ? $qry_data->bds_id : "";
$bds_ket     = isset($qry_data) ? ucwords($qry_data->bds_ket) : "";
$bds_jenjang = isset($qry_data) ? ucwords($qry_data->bds_jenjang) : "";

$btn_value = $bds_id === "" ? "btn_simpan" : "btn_ubah";
echo validation_errors();$konfirmasi = $btn_value === "btn_ubah" ? "onClick=\"return confirm('Apakah Anda Yakin?')\"" : "";
?>

<form class="form-horizontal" method="post" action="<?php echo site_url("studi/form"); ?>" autocomplete="off">
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box-body box-profile">
				<div class="box box-warning">
					<div class="box-body">

						<div class="form-group">
							<label class="col-sm-3 control-label">Bidang Studi</label>
							<div class="col-sm-8">
								<input type="hidden" name="hdd_bds_id" id="hdd_bds_id" value="<?php echo $bds_id; ?>">
								<input type="text" class="form-control" name="txt_studi" id="txt_studi" value="<?php echo ucwords($bds_ket); ?>" required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Jenjang</label>
							<div class="col-sm-8">
								<select name="opt_jenjang" id="opt_jenjang" class="form-control">
									<option value="1" <?php if($bds_jenjang==1){ echo "selected=\"selected\""; } ?>>TK</option>
									<option value="2" <?php if($bds_jenjang==2){ echo "selected=\"selected\""; } ?>>SD</option>
									<option value="3" <?php if($bds_jenjang==3){ echo "selected=\"selected\""; } ?>>SMP</option>
									<option value="4" <?php if($bds_jenjang==4){ echo "selected=\"selected\""; } ?>>SMA</option>
								</select>
							</div>
						</div>
						
						<div class="box-footer">
							<a href="<?php echo site_url('studi') ?>" class="btn btn-danger">Batal</a>&nbsp;
							<button type="submit" name="btn_simpan" id="btn_simpan" value="<?php echo $btn_value; ?>" class="btn btn-primary" <?php echo $konfirmasi;?>>Simpan</button>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</form>
