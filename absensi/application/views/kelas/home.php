<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <?php if($this->userdata->nama_jabatan == 'Admin'){?>
      <div class="col-md-3">
      </div>
    <div class="col-md-5">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-kelas"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
     <div class="col-md-4">
        <a href="<?php echo base_url('Kelas/kelola_siswa')?>">
          <button class="form-control btn btn-primary" data-toggle="modal"><i class="glyphicon glyphicon-list-alt"></i> Kelola Data Siswa Tiap Kelas</button>
        </a>
    </div>
    <!-- <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-kelas"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div> -->
    <?php }?>
    <!-- <div class="col-md-3">
        <a href="<?php echo base_url('Kelas/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div> -->
  </div>
  <!-- /.box-header -->

  <div class="box-header">
    <!-- <form id="filter-kelas" method="POST">
    <table>
      <tr>
        <td width="100">Tahun Ajaran</td>
        <td></td>
        <td width="200">
          <div >
              <select class="form-control btn btn-default" data-toggle="modal" name="tahun_ajaran">
                <?php
                    //masih ngebug di option sessionnya
                    foreach ($dataTahunAjaran as $ta) { ?>
                        <option value="<?php echo $ta->id_tahun ?>" <?php if($this->session->userdata('tahun_ajaran')==$ta->id_tahun) echo "selected";?>><?php echo $ta->tahun?></option>
                <?php } ?>
              </select>
          </div>
        </td>
        <td width="50" style="padding-left: 10px">
          <button type="submit" class="form-control btn btn-primary getTahun_ajaran" name="submit" value="Submit"> Lihat Data</button>
        </td>
    
      </tr>
    </table>    
  </form> -->
  </div>

  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama kelas</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-kelas">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_tambah_kelas; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataKelas', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'kelas';
  $data['url'] = 'Kelas/import';
  echo show_my_modal('modals/modal_import', 'import-kelas', $data);

  // if (isset($_POST["submit"])){  
    // echo trim($_POST["tahun_ajaran"]);
    // $this->session->set_userdata('tahun_ajaran', trim($_POST["tahun_ajaran"]));
// }
?>