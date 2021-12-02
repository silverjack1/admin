<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Ubah Data </h3>

  <form id="form-update-mapel" method="POST">
    <input type="hidden" name="id_mapel" value="<?php echo $dataMapel->id_mapel; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-book"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nama Mapel" name="nama_mapel" aria-describedby="sizing-addon2" value="<?php echo $dataMapel->nama_mapel; ?>">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Ubah Data</button>
      </div>
    </div>
  </form>
</div>