<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/table-panjang.css">
<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <?php if($this->userdata->nama_jabatan == 'Admin'){?>
      <div class="col-md-3">
      </div>
    <div class="col-md-6" style="padding: 0;">
      <a href="<?php echo base_url('Siswa/tambah')?>"><button class="form-control btn btn-primary" ><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button></a>
    </div>
    <!-- <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-siswa"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div> -->
  <?php } ?>
    <!-- <div class="col-md-3">
        <a href="<?php echo base_url('Siswa/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div> -->
    
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th width="10px">#</th>
          <th>NIS</th>
          <th>Nama Siswa</th>
          <th>Tahun Masuk</th>
        
          <th>Status</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-siswa">

      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_tambah_siswa; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataSiswa', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Siswa';
  $data['url'] = 'Siswa/import';
  echo show_my_modal('modals/modal_import', 'import-siswa', $data);
?>