<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Ubah Data siswa</h3>

  <form id="form-update-siswa" method="POST">
    <input type="hidden" name="NIS" value="<?php echo $dataSiswa->NIS; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>  
      <input type="text" class="form-control" placeholder="Nama Siswa" name="nama_siswa" aria-describedby="sizing-addon2" value="<?php echo $dataSiswa->nama_siswa; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Tempat Tanggal Lahir" name="TTL" aria-describedby="sizing-addon2" value="<?php echo $dataSiswa->TTL; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <select class="form-control" name="jenis_kelamin" aria-describedby="sizing-addon2">
        <option value="L"<?php if($dataSiswa->jenis_kelamin==='L') echo 'selected="selected"' ;?>>Laki-Laki</option>
        <option value="P"<?php if($dataSiswa->jenis_kelamin==='P') echo 'selected="selected"' ;?>>Perempuan</option>
      </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>  
      <input type="text" class="form-control" placeholder="Alamat" name="alamat" aria-describedby="sizing-addon2" value="<?php echo $dataSiswa->alamat; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>  
      <select class="form-control" name="status_siswa" aria-describedby="sizing-addon2">
        <option value="Aktif" <?php if($dataSiswa->status_siswa==='Aktif') echo 'selected="selected"' ;?>>Aktif</option>
        <option value="Lulus" <?php if($dataSiswa->status_siswa==='Lulus') echo 'selected="true"' ;?>>Lulus</option>
        <option value="Keluar" <?php if($dataSiswa->status_siswa==='Keluar') echo 'selected="selected"' ;?>>Keluar</option>
      </select>
    </div>

    
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Ubah Data</button>
      </div>
    </div>
  </form>
</div>