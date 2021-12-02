<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-location-arrow"></i> Daftar Guru Pengajar Mata Pelajaran <b><?php echo $mapel->nama_mapel; ?></b></h3>

  <div class="box box-body">
      <table id="tabel-detail" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NIP</th>
            <th>Nama</th>
            <!-- <th>Jenis Kelamin</th>
            <th>Posisi</th> -->
          </tr>
        </thead>
        <tbody id="data-pengajar">
          <?php
            foreach ($dataPengajar as $pengajar) {
              ?>
              <tr>
                <td style="min-width:230px;"><?php echo $pengajar->NIP; ?></td>
                <td><?php echo $pengajar->nama_pegawai; ?></td>
                <!-- <td><?php echo $pegawai->kelamin; ?></td>
                <td><?php echo $pegawai->posisi; ?></td> -->
              </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
  </div>

  <div class="text-right">
   <button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tutup</button>
  </div>
</div>