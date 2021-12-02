
<?php
  $no = 1;
  foreach ($dataPegawai as $pegawai) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $pegawai->NIP; ?></td>
      <td><?php echo $pegawai->nama_pegawai; ?></td>
      <!-- <td><?php echo $pegawai->alamat; ?></td>
      <td><?php echo $pegawai->email; ?></td>
      <td><?php echo $pegawai->status; ?></td>
      <td><img style="max-height: 100px; max-width: 100px;" class="foto-pegawai" src="<?php echo base_url(); ?>assets/img/<?php echo $pegawai->foto?>"></td> -->
      <td><?php echo $pegawai->nama_jabatan; ?></td>
      <td class="text-center" style="min-width:300px;">
        <?php if($this->userdata->nama_jabatan == 'Admin'){?>
        <a href="<?php echo base_url('Pegawai/update/'.$pegawai->NIP)?>">
          <button class="btn btn-warning" ><i class="glyphicon glyphicon-info-sign"></i> Ubah</button>
        </a>
        <!-- <button class="btn btn-warning update-dataPegawai" data-id="<?php echo $pegawai->NIP; ?>" <?php if($this->userdata->nama_jabatan != 'Admin') echo "disabled";?>><i class="glyphicon glyphicon-repeat"></i> Update</button> -->
        <button class="btn btn-danger konfirmasiHapus-pegawai" data-id="<?php echo $pegawai->NIP; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
      <?php } ?>
        <button class="btn btn-info detail-dataPegawai" data-id="<?php echo $pegawai->NIP; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>