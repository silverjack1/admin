<?php
  $no = 1;
  foreach ($dataKelas as $kls) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kls->nama_kelas; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-info detail-dataLaporanAbsen" data-id="<?php echo $kls->id_kelas; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
           <?php if($this->userdata->nama_jabatan == 'Staf Tata Usaha') {?>
          <a href="<?php echo base_url('Laporan_Absensi/download_pdf/'.$kls->id_kelas.'_'.$semester_default.'_'.$tahun_ajaran)?>" target="_blank">
          <button class="btn btn-danger" ><i class="glyphicon glyphicon-print"></i> Cetak</button>
          </a>
        <?php }?>
      </td>   
    </tr>
    <?php
    $no++;
  }
?>