<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <!-- <div class="box-header">
    <div class="col-md-6">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-kelas"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
    <div class="col-md-3">
        <a href="<?php echo base_url('Kelas/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-kelas"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>
  </div> -->
  <!-- /.box-header -->

  <div class="box-header">
   
  </div>

  <div class="box-body">
     <form id="filter-kelas" method="POST" action="<?php echo base_url('Absensi/filter_absensi/')?>">
          <table>
            <tr>
              <td width="100">Tanggal</td>
              <td></td>
              <td width="200">
                <div >
                    <input type="date"class="form-control btn btn-default" data-toggle="modal" name="tanggal" placeholder="Pilih Tanggal" value="<?php echo $tanggal;?>">
                </div>
              </td>         
            </tr>
            <tr><td><br></td></tr>
            <tr>
              <td width="100">Tahun Ajaran</td>
              <td></td>
              <td width="200">
                <div >
                    <select class="form-control btn btn-default" data-toggle="modal" name="tahun_ajaran">
                     <?php
                          foreach ($dataTahunAjaran as $ta) { ?>
                            <?php if($ta->id_tahun==$tahun_ajaran->id_tahun) { ?>
                                <option value="<?php echo $ta->id_tahun ?>" selected >
                                  <?php echo $ta->tahun?>
                                </option>
                                <?php } else {?>
                                  <option value="<?php echo $ta->id_tahun ?>">
                                  <?php echo $ta->tahun?>
                                </option>
                                <?php } ?>                     
                      <?php } ?>
                    </select>
                </div>
              </td>  
                <td width="30" style="padding-left: 10px">
                  <button type="submit" class="form-control btn btn-success getTahun_ajaran" name="submit" value="Submit"><i class="glyphicon glyphicon-search"></i> Lihat Data</button>
              </td>        
            </tr>
          </table>    
        </form>
        <br>
    <table id="list-data" class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama kelas</th>
          
          <th>Status</th>
        
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-absensi-filter">
        <?php
          $no = 1;
          foreach ($dataKelas as $kelas) {
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $kelas->nama_kelas; ?></td>

              <?php 
                    if($kelas->status_absen != 0){
                      ?>
                        <td ><?php echo "Sudah Diabsen"; ?> </td>
              
              <?php   
                    } 
                    else { ?>
                          <td style="background-color: pink"><?php echo "Belum Diabsen"; ?> </td>
              <?php }?>
              <td class="text-center" style="min-width:230px;">
                  
                  <a href="<?php echo base_url('Absensi/kehadiran/'.$kelas->id_kelas.'_'.$tanggal.'_'.$tahun_ajaran->id_tahun)?>">
                  <button class="btn btn-success" <?php if($this->userdata->nama_jabatan == 'Admin') echo "disabled";?>><i class="glyphicon glyphicon-check" ></i> Pendataan Kehadiran</button>
                  </a>
              </td>
            </tr>
            <?php
            $no++;
          }
        ?>
      </tbody>
    </table>
  </div>
</div>



<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataKelas', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'kelas';
  $data['url'] = 'Kelas/import';
  echo show_my_modal('modals/modal_import', 'import-kelas', $data);


?>