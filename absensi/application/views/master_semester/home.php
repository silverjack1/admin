<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <?php if($this->userdata->nama_jabatan == 'Admin' || $this->userdata->nama_jabatan == 'Staf Tata Usaha'){?>
      <div class="col-md-3">
      </div>
    <div class="col-md-6">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-master-semester"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
   <!--  <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-mapel"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div> -->
  <?php } ?>
    
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Semester</th>
          <th>Tanggal Mulai</th>
          <th>Tanggal Selesai</th>
          <!-- <th width="30%">Nama Mata Pelajaran</th> -->
          <?php if($this->userdata->nama_jabatan == 'Admin' || $this->userdata->nama_jabatan == 'Staf Tata Usaha'){?>
          <th style="text-align: center;">Aksi</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody id="data-master-semester">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_tambah_master_semester; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataMasterSemester', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'master_semester';
  // $data['url'] = 'Mapel/import';
  // echo show_my_modal('modals/modal_import', 'import-mapel', $data);
?>