<?php
  $no = 1;
  foreach ($dataWali_Kelas as $wali_kelas) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $wali_kelas->nama_pegawai; ?></td>
      <td><?php echo $wali_kelas->nama_kelas; ?></td>
      <td><?php echo $wali_kelas->tahun; ?></td>
      <?php if($this->userdata->nama_jabatan == 'Admin'){?>
      <td class="text-center" style="min-width:230px;">
          
          <button class="btn btn-warning update-dataWali_Kelas" data-id="<?php echo $wali_kelas->id_wali_kelas; ?>"><i class="glyphicon glyphicon-repeat"></i> Ubah</button>
          <button class="btn btn-danger konfirmasiHapus-wali_kelas" data-id="<?php echo $wali_kelas->id_wali_kelas; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
        
          
      </td>
      <?php } ?>
    </tr>
    <?php
    $no++;
  }
?>