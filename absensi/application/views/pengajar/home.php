<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <?php if($this->userdata->nama_jabatan == 'Admin'){?>
      <div class="col-md-3">
      </div>
    <div class="col-md-6">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-pengajar"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
   <!--  <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-pengajar"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div> -->
  <?php }?>
   <!--  <div class="col-md-3">
        <a href="<?php echo base_url('Pengajar/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div> -->
    
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form id="filter-kelas" method="POST">
      <table>
        <tr>
          <td width="100">Tahun Ajaran</td>
          <td></td>
          <td width="200">
            <div >
                <select id="filter_pengajar" name="filter_pengajar"class="form-control btn btn-default" data-toggle="modal" name="tahun_ajaran">
                  <?php
                      //masih ngebug di option sessionnya
                      foreach ($dataTahunAjaran as $ta) { ?>
                          <option value="<?php echo $ta->id_tahun ?>" <?php if ($ta->id_tahun==$tahun_ajaran) echo "selected";?>><?php echo $ta->tahun?></option>
                  <?php } ?>
                </select>
            </div>
          </td>
          <!-- <td width="50" style="padding-left: 10px">
            <button type="submit" class="form-control btn btn-primary getTahun_ajaran" name="submit" value="Submit"><i class="glyphicon glyphicon-search"></i> Lihat Data</button>
          </td> -->
      
        </tr>
      </table>    
    </form>
    <br>
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th >Nama Pengajar</th>
          <th >Kelas</th>
          <th >Mata Pelajaran</th>
          <th > Tahun Ajaran</th>
          <?php if($this->userdata->nama_jabatan == 'Admin'){?>
          <th style="text-align: center;">Aksi</th>
        <?php } ?>
        </tr>
      </thead>
      <tbody id="data_pengajar">
       
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_tambah_pengajar; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataPengajar', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Pengajar';
  $data['url'] = 'Pengajar/import';
  echo show_my_modal('modals/modal_import', 'import-pengajar', $data);
?>

