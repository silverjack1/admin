<!--  -->
        <?php
              $no = 1;
              foreach ($dataPengajar as $pengajar) {
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td style="min-width:230px;"><?php echo $pengajar->nama_pegawai; ?></td>
                  <td><?php echo $pengajar->nama_kelas; ?></td>
                  <td><?php echo $pengajar->nama_mapel; ?></td>
                  <td><?php echo $pengajar->tahun; ?></td>
                  <?php if($this->userdata->nama_jabatan == 'Admin'){?>
                  <td class="text-center" style="min-width:230px;">
                    <button class="btn btn-warning update-dataPengajar" data-id="<?php echo $pengajar->id_pengajar; ?>"><i class="glyphicon glyphicon-repeat"></i> Ubah</button>
                    <button class="btn btn-danger konfirmasiHapus-pengajar" data-id="<?php echo $pengajar->id_pengajar; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
                  </td>
                  <?php } ?>
                  <!-- <td><?php echo $pegawai->posisi; ?></td> -->
                </tr>
                <?php
                $no++;
              }
            ?>
      