<?php
  $no = 1;
  foreach ($dataKelas as $kelas) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kelas->nama_kelas; ?></td>
      <td class="text-center" style="min-width:230px;">
          <?php if($this->userdata->nama_jabatan == 'Admin'){?>
          <button class="btn btn-warning update-dataKelas" data-id="<?php echo $kelas->id_kelas; ?>"><i class="glyphicon glyphicon-repeat"></i> Ubah</button>
          <button class="btn btn-danger konfirmasiHapus-kelas" data-id="<?php echo $kelas->id_kelas; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
        <?php } ?>
          <!-- <button class="btn btn-info" <?php echo anchor('Kelas/tampilSiswaByKelas'.$kelas->id_kelas);?>><i class="glyphicon glyphicon-info-sign"></i> Detail</button> -->
          <a href="<?php echo base_url('Kelas/tampilSiswaByKelas/'.$kelas->id_kelas)?>">
          <button class="btn btn-info" ><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
          </a>
      </td>
    </tr>
    <?php
    $no++;
  }
?>