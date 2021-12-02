<div class="box box-header">
<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg">
    <div class="msg" style="display:none;">
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
  </div>
  <h3 style="display:block; text-align:center;">Ubah Data siswa</h3>

  <form id="form_update_siswa" method="POST"enctype="multipart/form-data" action="<?php echo base_url('Siswa/prosesUpdate/'.$dataSiswa->NIS)?>">
    <input type="hidden" name="NIS" value="<?php echo $dataSiswa->NIS; ?>">
    <input type="hidden" name="foto_lama" value="<?php echo $dataSiswa->foto; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-tags"></i>
      </span>  
      <input type="text" class="form-control" placeholder="Nama Siswa" name="nama_siswa" aria-describedby="sizing-addon2" value="<?php echo $dataSiswa->nama_siswa; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <select name="tahun_masuk" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataTahunAjaran as $tahun) {
          ?>
          <option value="<?php echo $tahun->tahun; ?>" <?php if($tahun->tahun == $dataSiswa->tahun_masuk){echo "selected='selected'";} ?> >
            <?php echo $tahun->tahun; ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-map-marker"></i>
      </span>
      <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" aria-describedby="sizing-addon2" value="<?php echo $dataSiswa->tempat_lahir; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" aria-describedby="sizing-addon2" value="<?php echo $dataSiswa->tanggal_lahir; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-asterisk"></i>
      </span>
      <select class="form-control" name="jenis_kelamin" aria-describedby="sizing-addon2">
        <option value="L"<?php if($dataSiswa->jenis_kelamin==='L') echo 'selected="selected"' ;?>>Laki-Laki</option>
        <option value="P"<?php if($dataSiswa->jenis_kelamin==='P') echo 'selected="selected"' ;?>>Perempuan</option>
      </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-map-marker"></i>
      </span>  
      <input type="text" class="form-control" placeholder="Alamat" name="alamat" aria-describedby="sizing-addon2" value="<?php echo $dataSiswa->alamat; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-camera"></i>
      </span>
      <input type="file" class="form-control" placeholder="Foto" name="foto">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-pushpin"></i>
      </span>  
      <select class="form-control" name="status_siswa" aria-describedby="sizing-addon2">
        <option value="Aktif" <?php if($dataSiswa->status_siswa==='Aktif') echo 'selected="selected"' ;?>>Aktif</option>
        <option value="Lulus" <?php if($dataSiswa->status_siswa==='Lulus') echo 'selected="true"' ;?>>Lulus</option>
        <option value="Pindah" <?php if($dataSiswa->status_siswa==='Pindah') echo 'selected="selected"' ;?>>Pindah</option>
        <option value="Keluar" <?php if($dataSiswa->status_siswa==='Keluar') echo 'selected="selected"' ;?>>Keluar</option>
      </select>
    </div>

    
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-success"> <i class="glyphicon glyphicon-ok"></i> Ubah Data</button>
      </div>
    </div>
  </form>
      <br><br>
    <div class="col-md-12">
      <a href="<?php echo base_url('Siswa')?>">
        <button class="form-control btn btn-primary"> <i class="glyphicon glyphicon-remove"></i> Batalkan</button>  
      </a>
    </div>
  </div>
</div>