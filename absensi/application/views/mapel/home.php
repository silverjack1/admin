<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <?php if($this->userdata->nama_jabatan == 'Admin'){?>
      <div class="col-md-3">
      </div>
    <div class="col-md-6">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-mapel"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
   <!--  <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-mapel"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div> -->
  <?php } ?>
    <!-- <div class="col-md-3">
        <a href="<?php echo base_url('Mapel/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div> -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th width="30%">Nama Mata Pelajaran</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-mapel">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_tambah_mapel; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataMapel', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'mapel';
  $data['url'] = 'Mapel/import';
  echo show_my_modal('modals/modal_import', 'import-mapel', $data);
?>