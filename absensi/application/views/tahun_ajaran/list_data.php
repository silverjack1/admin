<?php
  $no = 1;
  foreach ($dataTahun_ajaran as $tahun_ajaran) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $tahun_ajaran->tahun; ?></td>
      <td class="text-center" style="min-width:230px;">
          <?php if($this->userdata->nama_jabatan == 'Admin'){?>
          <button class="btn btn-warning update-dataTahun_ajaran" data-id="<?php echo $tahun_ajaran->id_tahun; ?>"><i class="glyphicon glyphicon-repeat"></i> Ubah</button>
          <button class="btn btn-danger konfirmasiHapus-Tahun_ajaran" data-id="<?php echo $tahun_ajaran->id_tahun; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
        <?php } ?>
          <!-- <button class="btn btn-info detail-dataTahun_ajaran" data-id="<?php echo $tahun_ajaran->id_tahun; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button> -->
      </td>
    </tr>
    <?php
    $no++;
  }
?>