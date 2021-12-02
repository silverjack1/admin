<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Ubah Data Kelas</h3>

  <form id="form-update-kelas" method="POST">
    <input type="hidden" name="id_kelas" value="<?php echo $dataKelas->id_kelas; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-sound-6-1"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nama Kelas" name="nama_kelas" aria-describedby="sizing-addon2" value="<?php echo $dataKelas->nama_kelas; ?>">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Ubah Data</button>
      </div>
    </div>
  </form>
</div>