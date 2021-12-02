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
          
          <a href="<?php echo base_url('Absensi/kehadiran/'.$kelas->id_kelas.'_'.$tanggal.'_'.$tahun_ajaran)?>">
          <button class="btn btn-success" <?php if($this->userdata->nama_jabatan == 'Admin') echo "disabled";?>><i class="glyphicon glyphicon-check" ></i> Pendataan Kehadiran</button>
          </a>
      </td>
    </tr>
    <?php
    $no++;
  }
?>

