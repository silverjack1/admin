<?php
  $date = tanggal(intval($tanggal[8].$tanggal[9]), intval($tanggal[5].$tanggal[6]), intval($tanggal[0].$tanggal[1].$tanggal[2].$tanggal[3]));
?>

<div class="box">
  <div class="box-header">
    <div class="col-md-12 well">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h3 style="display:block; text-align:center;"><i class="fa fa-location-arrow"></i> Absensi Siswa Kelas <b><?php echo $kelas->nama_kelas; ?></b></h3>
      <h4 style="display:block; text-align:center; padding-top: 5px">Tahun Ajaran <?php echo $tahun_ajaran->tahun;?></h4>
      <h4 style="display:block; text-align:center; padding-top: 5px"><?php echo $date;?></h4>

      <div class="box box-body">
        <form id="form_absensi" method="POST" action="<?php echo base_url('Absensi/prosesTambah/')?>">
          <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
          <input type="hidden" name="tahun_ajaran" value="<?php echo $tahun_ajaran->id_tahun; ?>">
          <input type="hidden" name="semester" value="<?php echo $semester; ?>">  
          <table id="tabel-detail" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kehadiran</th>
                <!-- <th>Jenis Kelamin</th>
                <th>Posisi</th> -->
              </tr>
            </thead>
            <tbody id="data-siswas">
              <?php
                $no=1;
                if($dataAbsensi->num_rows()==0){
                foreach ($dataSiswa as $siswa) {
                  // if($siswa->status_siswa == 'Aktif'){
                  ?>
                  <tr>
                    <td><?= $no;?></td>
                    <td><?php echo $siswa->NIS; ?></td>
                    <td><?php echo $siswa->nama_siswa; ?></td>
                    <td style="max-width: 25px">
                      <select class="form-control" name="absensi[<?php echo $siswa->NIS; ?>]">
                          <option value="Hadir">Hadir</option>
                          <option value="Sakit">Sakit</option>
                          <option value="Ijin">Ijin</option>
                          <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                        </select>
                    </td>
                  </tr>
                  <?php
                  // }
                  $no++;
                }
              }
              else{
                foreach ($dataAbsensi->result() as $siswa) {
                  // if($siswa->status_siswa == 'Aktif'){
                  $no=1;
                  ?>
                  <tr>
                    <td><?= $no;?></td>
                    <td><?php echo $siswa->NIS; ?></td>
                    <td><?php echo $siswa->nama_siswa; ?></td>
                    <td style="max-width: 25px">
                      <select class="form-control" name="absensi[<?php echo $siswa->NIS; ?>]">
                          <option value="Hadir" <?php if($siswa->presensi=="Hadir") echo "selected";?>>Hadir</option>
                          <option value="Sakit" <?php if($siswa->presensi=="Sakit") echo "selected";?>>Sakit</option>
                          <option value="Ijin" <?php if($siswa->presensi=="Ijin") echo "selected";?>>Ijin</option>
                          <option value="Tanpa Keterangan" <?php if($siswa->presensi=="Tanpa Keterangan") echo "selected";?>>Tanpa Keterangan</option>
                        </select>
                    </td>
                  </tr>
                  <?php
                  // }
                  $no++;
                }
              }
              ?>
            </tbody>
          </table>
          <br>
          <div class="col-md-3">
            <a href="<?php echo base_url('Absensi/filter_absensi')?>"><button style="width: 230px;" type="button" class="btn btn-danger col-md-0"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</button></a>
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
  
  // function backgroundColor($id) {
  //   var name = document.getElementById($id);
  //   var value = name.options[name.selectedIndex].value;
  //   if (value == "Hadir") {
  //     document.getElementById($id).style.backgroundColor="initial";
  //   }
  //   else if (value == "Sakit") {
  //     document.getElementById($id).style.backgroundColor="#eaf04d";
  //   }
  //   else if (value == "Ijin") {
  //     document.getElementById($id).style.backgroundColor="#69e496";
  //   }
  //   else if (value == "Tanpa Keterangan") {
  //     document.getElementById($id).style.backgroundColor="#fc729f";
  //   }
  // }
</script>