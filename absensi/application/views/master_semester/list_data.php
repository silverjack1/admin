<?php
  $no = 1;
  foreach ($dataMasterSemester as $ms) {
    ?>
    <tr>
      <?php 
          $year = $ms->tanggal_mulai[0].$ms->tanggal_mulai[1].$ms->tanggal_mulai[2].$ms->tanggal_mulai[3];
          $month =$ms->tanggal_mulai[5].$ms->tanggal_mulai[6];
          $day = $ms->tanggal_mulai[8].$ms->tanggal_mulai[9];
          $tanggal_mulai = tanggal($day, $month, $year);


          $year = $ms->tanggal_akhir[0].$ms->tanggal_akhir[1].$ms->tanggal_akhir[2].$ms->tanggal_akhir[3];
          $month = $ms->tanggal_akhir[5].$ms->tanggal_akhir[6];
          $day = $ms->tanggal_akhir[8].$ms->tanggal_akhir[9];
          $tanggal_akhir = tanggal($day, $month, $year);
      ?>
      <td><?php echo $no; ?></td>
      <td><?php echo $ms->nama_semester; ?></td>
      <td><?php echo $tanggal_mulai; ?></td>
      <td><?php echo $tanggal_akhir; ?></td>
      <?php if($this->userdata->nama_jabatan == 'Admin' || $this->userdata->nama_jabatan == 'Staf Tata Usaha'){?>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataMasterSemester" data-id="<?php echo $ms->id_master_semester; ?>"><i class="glyphicon glyphicon-repeat"></i> Ubah</button>
          <button class="btn btn-danger konfirmasiHapus-master_semester" data-id="<?php echo $ms->id_master_semester; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
      </td>
      <?php } ?>
    </tr>
    <?php
    $no++;
  }
?>