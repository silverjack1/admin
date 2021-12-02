<?php
  $no = 1;
  foreach ($dataSiswa as $siswa) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $siswa->NIS; ?></td>
      <td><?php echo $siswa->nama_siswa; ?></td>
      <td><?php echo $siswa->tahun_masuk; ?></td>
      <td><?php echo $siswa->status_siswa; ?></td>
      <td class="text-center" style="min-width:300px;">
        <?php if($this->userdata->nama_jabatan == 'Admin'){?>
        <a href="<?php echo base_url('Siswa/update/'.$siswa->NIS)?>">
        <button class="btn btn-warning update-dataSiswa" data-id="<?php echo $siswa->NIS; ?>"><i class="glyphicon glyphicon-repeat"></i> Ubah</button></a>
        <button class="btn btn-danger konfirmasiHapus-siswa" data-id="<?php echo $siswa->NIS; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
      <?php } ?>
        <button class="btn btn-info detail-dataSiswa" data-id="<?php echo $siswa->NIS; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>