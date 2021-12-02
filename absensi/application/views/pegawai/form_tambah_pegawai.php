<script>
      function show_password(){
        var password = document.getElementById('password');
        if (password.type === "password") {
          password.type = "text"
        }
        else{
          password.type = "password";
        }
      }
</script> 
<div class="box-header">
  <div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
    <div class="form-msg">
      <div class="msg" style="display:none;">
        <?php echo $this->session->flashdata('msg'); ?>
      </div>
    </div>

    <h3 style="display:block; text-align:center;">Tambah Data Pegawai</h3>

    <form id="form_tambah_pegawai" method="POST" enctype="multipart/form-data" action="<?php echo base_url('Pegawai/prosesTambah/')?>">
      <div class="input-group form-group">
        <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-tags"></i>
        </span>
        <input type="text" class="form-control" placeholder="NIP" name="NIP" aria-describedby="sizing-addon2">
      </div>
      <div class="input-group form-group">
        <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-user"></i>
        </span>  
        <input type="text" class="form-control" placeholder="Nama Pegawai" name="nama pegawai" aria-describedby="sizing-addon2">
      </div>
      <div class="input-group form-group">
        <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-map-marker"></i>
        </span>
        <input type="text" class="form-control" placeholder="Alamat" name="alamat" aria-describedby="sizing-addon2">
      </div>
      <div class="input-group form-group">
        <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-user"></i>
        </span>
        <input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="sizing-addon2">
      </div>
      <div class="input-group form-group">
        <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-lock"></i>
        </span>
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-describedby="sizing-addon2">
      </div>
      <div class="input-group form-group">
        <input type="checkbox" onclick="show_password()"> Tampilkan Password
      </div>
      <div class="input-group form-group">
        <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-pushpin"></i>
        </span>
        <select class="form-control" name="status" aria-describedby="sizing-addon2">
          <option value="Aktif" selected>Aktif</option>
          <option value="Pindah">Pindah</option>
          <option value="Cuti" >Cuti</option>
          <option value="Keluar" >Keluar</option>
          <option value="Pensiun">Pensiun</option>
        </select>
      </div>
      <div class="input-group form-group">
        <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-camera"></i>
        </span>  
        <input type="file" class="form-control" placeholder="Foto" name="foto" aria-describedby="sizing-addon2">
      </div>
      <div class="input-group form-group">
        <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-briefcase"></i>
        </span>  
        <select name="id_jabatan" class="form-control select2" aria-describedby="sizing-addon2">
          <?php
          foreach ($dataJabatan as $jabatan) {
            ?>
            <option value="<?php echo $jabatan->id_jabatan; ?>" <?php if($jabatan->id_jabatan==2) echo "selected";?>>
              <?php echo $jabatan->nama_jabatan; ?>
            </option>
            <?php
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <div class="col-md-12">
            <button type="submit" class="form-control btn btn-success"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>            
        </div>
      </div>
    </form>
    <br><br>
    <div class="col-md-12">
      <a href="<?php echo base_url('Pegawai')?>">
        <button class="form-control btn btn-primary"> <i class="glyphicon glyphicon-remove"></i> Batalkan</button>  
      </a>
    </div>
  </div>
</div>