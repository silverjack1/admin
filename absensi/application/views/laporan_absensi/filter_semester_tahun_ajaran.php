<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <form id="filter-kelas" method="POST" action="<?php echo base_url('Laporan_Absensi/filter_semester_tahun_ajaran')?>">
    <table>
        <tr>
          <td width="100">Semester</td>
          <td></td>
          <td width="200">
            <div >
                <select class="form-control btn btn-default" data-toggle="modal" name="semester">
                 <?php
                      foreach ($dataSemester as $smt) { ?>
                        <?php if($smt->id_semester==$semester) { ?>
                            <option value="<?php echo $smt->id_semester ?>" selected >
                              <?php echo $smt->semester?>
                            </option>
                            <?php } else {?>
                              <option value="<?php echo $smt->id_semester ?>">
                              <?php echo $smt->semester?>
                            </option>
                            <?php } ?>                     
                  <?php } ?>
                </select>
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
                        <option value="<?php echo $ta->id_tahun ?>" <?php if($tahun_ajaran==$ta->id_tahun) echo "selected";?>><?php echo $ta->tahun?></option>
                <?php } ?>
              </select>
          </div>
        </td>
        <td width="50" style="padding-left: 10px">
          <button type="submit" class="form-control btn btn-primary getTahun_ajaran" name="submit" value="Submit"><i class="glyphicon glyphicon-search"></i> Lihat Data</button>
        </td>
    
      </tr>
    </table>    
  </form>
  </div>

  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Kelas</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-laporan-absenn">
        <?php
          $no = 1;
          foreach ($dataKelas as $kls) {
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $kls->nama_kelas; ?></td>
              <td class="text-center" style="min-width:230px;">
                  <button class="btn btn-info detail-dataLaporanAbsenFilter" data-id="<?php echo $kls->id_kelas.'/'.$semester.'/'.$tahun_ajaran; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
                   <?php if($this->userdata->nama_jabatan == 'Staf Tata Usaha') {?>
                  <a href="<?php echo base_url('Laporan_Absensi/download_pdf/'.$kls->id_kelas.'_'.$semester.'_'.$tahun_ajaran)?>" target="_blank">
                  <button class="btn btn-danger" ><i class="glyphicon glyphicon-print"></i> Cetak</button>
                  </a>
                <?php }?>
              </td>      
            </tr>
            <?php
            $no++;
          }
        ?>
      </tbody>
    </table>
    <br>
    <div class="col-md-3">
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3">
        
    </div>
  </div>
</div>

<!-- <?php echo $modal_tambah_kelas; ?> -->

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