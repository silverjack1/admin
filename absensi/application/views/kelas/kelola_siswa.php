<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-12 well">
      <h3 style="display:block; text-align:center;"><i class="fa fa-location-arrow"></i> Kelola Data Siswa<br><br>Tahun Ajaran <b><?php  echo $tahun_ajaran_default;?></b></h3>
      

      <div class="box box-body">
        <form id="filter-kelas" method="POST" action="<?php echo base_url('Kelas/kelola_siswa_filter')  ?>">
          <table>
            <tr>
              <td width="250">Tahun Ajaran (Kelas Asal)</td>
              <td></td>
              <td width="200">
                <div >
                    <select id="filter-kelola-kelas-siswa" class="form-control btn btn-default" data-toggle="modal" name="tahun_ajaran">
                      <?php
                          foreach ($dataTahunAjaran as $ta) { ?>
                            <?php if($ta->id_tahun==$tahun_ajaran) { ?>
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
            </tr>
            <tr><td><br></td></tr>
            <tr>
              <td width="250">Kelas Asal</td>
              <td></td>
              <td width="200">
                <div >
                    <select id="pilihan-kelola-kelas" class="form-control btn btn-default" data-toggle="modal" name="kelas">
                                <option value="" selected>Siswa Baru</option>
                      <?php
                          foreach ($dataKelasAsal as $kelas) { ?>
                                <option value="<?php echo $kelas->id_kelas ?>"  >
                                  <?php echo $kelas->nama_kelas?>
                                </option>
                      <?php } ?>
                    </select>
                </div>
              </td>
              <td width="30" style="padding-left: 15px">
                <button type="submit" class="form-control btn btn-success getTahun_ajaran" name="submit" value="Submit"><i class="glyphicon glyphicon-search"></i> Lihat Data</button>
              </td>
            </tr>
            <tr><td></td></tr>
          </table>    
        </form>
        <br>
        <form id="form_absensi" method="POST" action="<?php echo base_url('Kelas/tambahSiswakeKelas/'.$id_ta_sesudah)?>">
          <input type="hidden" name="tahun_ajaran_sebelum" value="<?php echo $tahun_ajaran?>">
          <input type="hidden" name="tahun_ajaran_sesudah" value="<?php echo $id_ta_sesudah?>">

          
          <table id="tabel_kelola_siswa"  class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas Asal (<?php echo $tahun_ajaran_default; ?>)</th>
                <th>Kelas Baru (<?php echo $tahun_ajaran_sesudah ?>)</th>
              </tr>
            </thead>
            <tbody id="tabel-kelola-siswa">
              <?php
                $no = 1;
                  foreach ($dataSiswa as $siswa) {
                  
                  ?>
                    <tr>
                     <td><?php echo $no; ?></td>
                      <td><?php echo $siswa->NIS; ?></td>
                      <td><?php echo $siswa->nama_siswa; ?></td>
                      <td>
                        <select class="form-control" name="kelas_asal[<?php echo $siswa->NIS; ?>]">
                          <option value="">Siswa Baru</option>
                           <?php
                              foreach ($dataKelasAsal as $kelas) { ?>
                                <option value="<?php echo $kelas->id_kelas ?>" <?php if($kelas->nama_kelas==$siswa->nama_kelas_asal) echo "selected";?>>
                                  <?php echo $kelas->nama_kelas?>
                                </option>
                            <?php } ?>
                        </select>
                      </td>
                      <td style="max-width: 25px">
                        <select class="form-control" name="kelas_baru[<?php echo $siswa->NIS; ?>]">
                          <option value="">--- Pilih Kelas ---</option>
                           <?php
                              foreach ($dataKelasBaru as $kelas) { ?>
                                <option value="<?php echo $kelas->id_kelas ?>" <?php if($kelas->nama_kelas==$siswa->nama_kelas_baru) echo "selected";?>>
                                  <?php echo $kelas->nama_kelas?>
                                </option>
                            <?php } ?>
                        </select>
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
            <a href="<?php echo base_url('Kelas')?>"><button style="width: 230px;" type="button" class="btn btn-danger col-md-0"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</button></a>
          </div>
          <div class="col-md-6"></div>
          <div class="col-md-3">
              <button style="width: 230px;" type="submit" class="form-control btn btn-primary" name="save" value="Save"><i class="glyphicon glyphicon-saved"></i> Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    $('#tabel_kelola_siswa').dataTable({
      "paging": true,
      "pageLength" : 40,
      "lengthMenu" : [40, 50, 75, 100],
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      language :{
        paginate :{
          previous : "<",
          next : ">"
        },
        lengthMenu: "Menampilkan _MENU_ data",
        zeroRecords: "Tidak ada data",
        info: "Menampilkan halaman _PAGE_ dari _PAGES_",
        infoEmpty: "",
        search : "Pencarian"
      }
    });
  });
</script>