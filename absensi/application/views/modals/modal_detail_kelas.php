<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-location-arrow"></i> List Siswa Kelas <b><?php echo $kelas->nama_kelas; ?></b></h3>

  <div class="box box-body">
    <form id="filter-kelas" method="POST">
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
  </form>
      <table id="tabel-detail" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Tahun Ajaran</th>
            <!-- <th>Jenis Kelamin</th>
            <th>Posisi</th> -->
          </tr>
        </thead>
        <tbody id="data-siswa">
          <?php
            foreach ($dataSiswa as $siswa) {
              ?>
              <tr>
                <td style="min-width:230px;"><?php echo $siswa->NIS; ?></td>
                <td><?php echo $siswa->nama_siswa; ?></td>
                <td><?php echo $siswa->tahun; ?></td>
                <!-- <td><?php echo $pegawai->kelamin; ?></td>
                <td><?php echo $pegawai->posisi; ?></td> -->
              </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
  </div>

  <div class="text-right">
    <button class="btn btn-danger" data-dismiss="modal"> Close</button>
  </div>
</div>

<?php
// if (isset($_POST["submit"])){  
//     // echo trim($_POST["tahun_ajaran"]);
//     $this->session->set_userdata('tahun_ajaran', trim($_POST["tahun_ajaran"]));
//     echo $this->session->userdata('tahun_ajaran');
    
// }
?>