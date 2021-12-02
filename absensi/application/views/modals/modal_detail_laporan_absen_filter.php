<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-location-arrow"></i> Laporan Absensi <b><?php echo $kelas->nama_kelas; ?></b></h3>
  <h4 style="display:block; text-align:center;">Semester <?php echo $semester->semester?> Tahun Ajaran <?php echo $tahun_ajaran->tahun?></h4>

  <div class="box box-body">
      <table id="tabel-detail" class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Hadir</th>
            <th>Sakit</th>
            <th>Ijin</th>
            <th>Tanpa Keterangan</th>
          </tr>
        </thead>
        <tbody id="data-laporan-absen">
         <?php
            $no = 1;
            foreach ($dataLaporanAbsen->result() as $laporan) {
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $laporan->NIS; ?></td>
                <td><?php echo $laporan->nama_siswa; ?></td>
                <td><?php echo $laporan->hadir; ?></td>
                <td><?php echo $laporan->sakit; ?></td>
                <td><?php echo $laporan->ijin; ?></td>
                <td><?php echo $laporan->alasan; ?></td>     
              </tr>
              <?php
              $no++;
            }
          ?>
        </tbody>
      </table>
  </div>

  <div class="text-right">
   <button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tutup</button>
  </div>
</div>