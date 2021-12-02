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
                        <?php if($smt->id_semester==$this->session->userdata('semester_default')) { ?>
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
      <tbody id="data-laporan-absen">
      
      </tbody>
    </table>
 
  </div>
</div>



<div id="tempat-modal"></div>

