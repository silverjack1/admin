<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Ubah Data </h3>
  <form id="form-update-beasiswa" method="POST">
    <input type="hidden" name="id_beasiswa" value="<?php echo $dataBeasiswa->id_beasiswa; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-education"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nama Beasiswa" name="nama_beasiswa" aria-describedby="sizing-addon2" value="<?php echo $dataBeasiswa->nama_beasiswa; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-euro"></i>
      </span>
      <input type="number" class="form-control" placeholder="Nominal Beasiswa" name="nominal_beasiswa" aria-describedby="sizing-addon2" value="<?php echo $dataBeasiswa->nominal_beasiswa; ?>">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Ubah Data</button>
      </div>
    </div>
  </form>
</div>