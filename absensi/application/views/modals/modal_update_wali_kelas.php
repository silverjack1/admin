<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Ubah Data Wali Kelas</h3>

  <form id="form-update-wali_kelas" method="POST">
    <input type="hidden" name="id_wali_kelas" value="<?php echo $dataWali_Kelas->id_wali_kelas; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <select name="NIP" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataPegawai as $pegawai) {
              ?>
              <option value="<?php echo $pegawai->NIP; ?>" <?php if($pegawai->NIP == $dataWali_Kelas->NIP){echo "selected='selected'";} ?>><?php echo $pegawai->nama_pegawai; ?></option>
              <?php
            }
            ?>
          </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-sound-6-1"></i>
      </span>
      <select name="id_kelas" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataKelas as $kelas) {
              ?>
              <option value="<?php echo $kelas->id_kelas; ?>" <?php if($kelas->id_kelas == $dataWali_Kelas->id_kelas){echo "selected='selected'";} ?>><?php echo $kelas->nama_kelas; ?></option>
              <?php
            }
            ?>
          </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <select name="id_tahun" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataTahun_ajaran as $tahun_ajaran) {
              ?>
              <option value="<?php echo $tahun_ajaran->id_tahun; ?>" <?php if($tahun_ajaran->id_tahun == $dataWali_Kelas->id_tahun){echo "selected='selected'";} ?>><?php echo $tahun_ajaran->tahun; ?></option>
              <?php
            }
            ?>
          </select>
    </div>    
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Ubah Data</button>
      </div>
    </div>
  </form>
</div>