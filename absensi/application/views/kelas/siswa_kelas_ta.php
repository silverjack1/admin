<div class="box">
  <div class="box-header">
    <div class="col-md-12 well">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h3 style="display:block; text-align:center;"><i class="fa fa-location-arrow"></i> List Siswa Kelas <b><?php echo $kelas->nama_kelas; ?></b></h3>

      <div class="box box-body">
        <form id="filter-kelas" method="POST" action="<?php echo base_url('Kelas/selectSiswaTAKelas/'.$kelas->id_kelas)?>">
          <table>
            <tr>
              <td width="100">Tahun Ajaran</td>
              <td></td>
              <td width="200">
                <div >
                    <select class="form-control btn btn-default" data-toggle="modal" name="tahun_ajaran">
                      <?php
                          foreach ($dataTahunAjaran as $ta) { ?>
                            <?php if($ta->id_tahun==$id_tahun) { ?>
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
              <td width="50" style="padding-left: 10px">
                <button type="submit" class="form-control btn btn-primary getTahun_ajaran" name="submit" value="Submit"><i class="glyphicon glyphicon-search"></i> Lihat Data</button>
              </td>
          
            </tr>
          </table>    
        </form>
        <br>
        <table id="tabel-detail" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>Tahun Ajaran</th>
              <!-- <th>Jenis Kelamin</th>
              <th>Posisi</th> -->
            </tr>
          </thead>
          <tbody id="data-siswas">
            <?php
            $no=1;
              foreach ($dataSiswaByKelasTA as $siswa) {
                
                ?>
                <tr>
                  <td><?= $no;?></td>
                  <td style="min-width:230px;"><?php echo $siswa->NIS; ?></td>
                  <td><?php echo $siswa->nama_siswa; ?></td>
                  <td><?php echo $siswa->tahun; ?></td>
                  <!-- <td><?php echo $pegawai->kelamin; ?></td>
                  <td><?php echo $pegawai->posisi; ?></td> -->
                </tr>
                <?php
                $no++;
              }
            ?>
          </tbody>
        </table>
      </div>
      <a href="<?php echo base_url('Kelas')?>"><button  type="button" class="btn btn-danger col-md-0"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</button></a>
    </div>
  </div>
</div>

<?php
// if (isset($_POST["submit"])){  
//     // echo trim($_POST["tahun_ajaran"]);
//     $this->session->set_userdata('tahun_ajaran', trim($_POST["tahun_ajaran"]));
//     echo $this->session->userdata('tahun_ajaran');
    
// }
?>

<script type="text/javascript">
  $(document).ready(function () {
    $('#tabel-detail').dataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
  
</script>