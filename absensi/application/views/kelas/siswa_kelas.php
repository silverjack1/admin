<div class="box">
  <div class="box-header">
    <div class="col-md-12 well">
      <div class="form-msg">
        <div class="msg" style="display:none;">
          <?php echo $this->session->flashdata('msg'); ?>
        </div>
      </div>
      
      <h3 style="display:block; text-align:center;"><i class="fa fa-location-arrow col"></i> List Siswa Kelas <b><?php echo $kelas->nama_kelas; ?></b></h3>

      <div class="box box-body">
        <form id="filter-kelas" method="POST">
          <table>
            <tr>
              <td width="100">Tahun Ajaran</td>
              <td></td>
              <td width="200">
                <div >
                    <select id="filter_kelas_siswa" class="form-control btn btn-default" data-toggle="modal" name="tahun_ajaran">
                      <?php
                          //masih ngebug di option sessionnya
                          foreach ($dataTahunAjaran as $ta) { ?>
                              <option value="<?php echo $ta->id_tahun ?>" <?php if ($ta->id_tahun==$tahun_ajaran) echo "selected";?>><?php echo $ta->tahun?></option>
                      <?php } ?>
                    </select>
                </div>
              </td>
             <!--  <td width="50" style="padding-left: 10px">
                <button type="submit" class="form-control btn btn-primary getTahun_ajaran" name="submit" value="Submit"><i class="glyphicon glyphicon-search"></i> Lihat Data</button>
              </td> -->
          
            </tr>
          </table>    
        </form>
        <br>
        <table id="list-data" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>Status</th>
              <th>Tahun Ajaran</th>
              <!-- <th>Jenis Kelamin</th>
              <th>Posisi</th> -->
            </tr>
          </thead>
          <tbody id="data-siswa-kelas">

          </tbody>
        </table>
      </div>
      <a href="<?php echo base_url('Kelas')?>"><button  type="button" class="btn btn-danger col-md-0"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</button></a>
    </div>
  </div>
</div>

