<?php
  $no = 1;
  foreach ($dataKelas as $kelas) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kelas->nama_kelas; ?></td>
      <td class="text-center" style="min-width:230px;">
          
          <button class="btn btn-info detail-dataRekapAbsen" data-id="<?php echo $kelas->id_kelas; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
          
          </a>
      </td>
    </tr>
    <?php
    $no++;
  }
?>