<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Ubah Data </h3>

  <form id="form-update-master" method="POST">
    <input type="hidden" name="id_biaya" value="<?php echo $dataMaster->id_biaya; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-edit"></i>
      </span>
      <input type="text" class="form-control" placeholder="Jenis Biaya" name="jenis_biaya" aria-describedby="sizing-addon2" value="<?php echo $dataMaster->jenis_biaya; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-euro"></i>
      </span>
      <input type="number" class="form-control" placeholder="Nominal" name="nominal" aria-describedby="sizing-addon2" value="<?php echo $dataMaster->nominal; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="number" class="form-control" placeholder="Tahun Masuk" name="tahun_masuk" aria-describedby="sizing-addon2" value="<?php echo $dataMaster->tahun_masuk; ?>">
    </div>
     
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Ubah Data</button>
      </div>
    </div>
  </form>
</div>