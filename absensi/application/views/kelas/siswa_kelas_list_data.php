 <?php
 $no=1;

  foreach ($dataSiswa as $siswa) {
        ?>
    <tr>
      <td><?= $no;?></td>
      <td style="min-width:230px;"><?php echo $siswa->NIS; ?></td>
      <td><?php echo $siswa->nama_siswa; ?></td>
      <td><?php echo $siswa->status_siswa; ?></td>
      <td><?php echo $siswa->tahun; ?></td>
      <!-- <td><?php echo $pegawai->kelamin; ?></td>
      <td><?php echo $pegawai->posisi; ?></td> -->
    </tr>
    <?php
    $no++;
  }
?>