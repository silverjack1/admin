<?php
  $no = 1;
  foreach ($dataMapel as $mapel) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $mapel->nama_mapel; ?></td>
      <td class="text-center" style="min-width:230px;">
          <?php if($this->userdata->nama_jabatan == 'Admin'){?>
          <button class="btn btn-warning update-dataMapel" data-id="<?php echo $mapel->id_mapel; ?>"><i class="glyphicon glyphicon-repeat"></i> Ubah</button>
          <button class="btn btn-danger konfirmasiHapus-mapel" data-id="<?php echo $mapel->id_mapel; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
        <?php } ?>
          <button class="btn btn-info detail-dataMapel" data-id="<?php echo $mapel->id_mapel; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>