<script>
      function show_password(){
        var password = document.getElementById('passLama');
        if (password.type === "password") {
          password.type = "text"
        }
        else{
          password.type = "password";
        }
      }
      function show_password2(){
        var password = document.getElementById('passBaru');
        if (password.type === "password") {
          password.type = "text"
        }
        else{
          password.type = "password";
        }
      }
      function show_password3(){
        var password = document.getElementById('passKonf');
        if (password.type === "password") {
          password.type = "text"
        }
        else{
          password.type = "password";
        }
      }
</script>
<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" alt="User profile picture">

        <h3 class="profile-username text-center"><?php echo $userdata->nama_pegawai; ?></h3>

        <p class="text-muted text-center"><?php echo $userdata->nama_jabatan?></p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Username</b> <a class="pull-right"><?php echo $userdata->NIP; ?></a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#settings" data-toggle="tab">Detail</a></li>
        <li><a href="#password" data-toggle="tab">Ubah Password</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="settings">
          <form class="form-horizontal" action="<?php echo base_url('Profile/update') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="inputNIP" class="col-sm-2 control-label">NIP / Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="" placeholder="NIP" name="NIP" value="<?php echo $userdata->NIP; ?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="inputNama" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Name" name="nama" value="<?php echo $userdata->nama_pegawai; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputAlamat" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="<?php echo $userdata->alamat; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $userdata->email; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputJabatan" class="col-sm-2 control-label">Jabatan</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Jabatan" name="jabatan" value="<?php echo $userdata->nama_jabatan; ?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="inputFoto" class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-10">
                <input type="hidden" name="old_foto" value="<?php echo $userdata->foto; ?>">
                <input type="file" class="form-control" placeholder="Foto" name="foto">
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Simpan</button>
              </div>
            </div>
          </form>
        </div>
        <div class="tab-pane" id="password">
          <form class="form-horizontal" action="<?php echo base_url('Profile/ubah_password') ?>" method="POST">
            <div class="form-group">
              <label for="passLama" class="col-sm-2 control-label">Password Lama</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Password Lama" name="passLama" id="passLama">
                <input type="checkbox" onclick="show_password()"> Tampilkan Password
              </div>
            </div>
            <div class="form-group">
              <label for="passBaru" class="col-sm-2 control-label">Password Baru</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Password Baru" name="passBaru" id="passBaru">
                <input type="checkbox" onclick="show_password2()"> Tampilkan Password
              </div>
            </div>
            <div class="form-group">
              <label for="passKonf" class="col-sm-2 control-label">Konfirmasi Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Konfirmasi Password" name="passKonf" id="passKonf">
                <input type="checkbox" onclick="show_password3()"> Tampilkan Password
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="msg" style="display:none;">
      <?php echo $this->session->flashdata('msg'); ?>
    </div>
  </div>
</div>