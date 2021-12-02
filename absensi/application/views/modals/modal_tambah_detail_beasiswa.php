<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Beasiswa</h3>

  <form id="form-tambah-detail-beasiswa" method="POST">
    <input type="hidden" name="id_beasiswa" value="<?php echo $id_beasiswa?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <select class = "form-control" name="NIS" aria-describedby="sizing-addon2"> 
        <?php
          foreach ($dataSiswa as $siswa) {
            ?>
            <option value="<?php echo $siswa->NIS ?>"><?php echo $siswa->nama_siswa ?></option>
          <?php }
        ?>
      </select>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Beasiswa </button>
      </div>
    </div>
  </form>
</div>