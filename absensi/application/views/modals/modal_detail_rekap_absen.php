<?php
  $tanggal = date('Y-m-d');
  $date = tanggal(intval($tanggal[8].$tanggal[9]), intval($tanggal[5].$tanggal[6]), intval($tanggal[0].$tanggal[1].$tanggal[2].$tanggal[3]));
?>
<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-location-arrow"></i> Rekapitulasi Absensi <b><?php echo $kelas->nama_kelas; ?></b></h3>
  <h4 style="display:block; text-align:center;">Tahun Ajaran <?php echo $tahun_ajaran_default?><br><?php echo $date?></h4>

  <div class="box box-body">
      <table id="tabel-detail" class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kehadiran</th>
            <!-- <th>Posisi</th> -->
          </tr>
        </thead>
        <tbody id="data-rekap-absen">
          <?php
            $no = 1;
            $hadir = 0;
            $sakit = 0;
            $ijin = 0;
            $alasan = 0;
            foreach ($dataAbsensi->result() as $absensi) {
              ?>
              <tr <?php
                  if ($absensi->presensi == "Sakit") {
                    echo 'style="background-color: #eaf04d;" ';
                    $sakit++;
                  }
                  elseif($absensi->presensi == "Ijin") {
                    echo 'style="background-color: #69e496;" ';
                    $ijin++;
                  }
                  elseif($absensi->presensi == "Tanpa Keterangan") {
                    echo 'style="background-color: #fc729f;" ';
                    $alasan++;
                  }
                  elseif($absensi->presensi == "Hadir") {
                    echo 'style="background-color: initial;" ';
                    $hadir++;
                  }
                ?>>
                <td width="15px"><?php echo $no?></td>
                <td><?php echo $absensi->NIS; ?></td>
                <td><?php echo $absensi->nama_siswa; ?></td>
                <td><?php echo $absensi->presensi; ?></td>
                
              </tr>
              <?php
              $no++;
            }
          ?>
        </tbody>
      </table>
      <table class="table table-bordered">
        
        <tr>
          <th width="25%">Hadir</th>
          <th style="background-color: #eaf04d;" width="25%">Sakit</th>
          <th style="background-color: #69e496;" width="25%">Ijin</th>
          <th style="background-color: #fc729f;" width="25%">Tanpa Keterangan</th>
        </tr>
        <tr style="text-align: right;">
          <td><?php echo $hadir?></td>
          <td style="background-color: #eaf04d"><?php echo $sakit?></td>
          <td style="background-color: #69e496"><?php echo $ijin?></td>
          <td style="background-color: #fc729f"><?php echo $alasan?></td>
        </tr>
        <tr style="background-color: #dddddd">
          <td colspan="3">Jumlah Siswa</td>
          <td style="text-align: right;"><?php echo $hadir+$sakit+$ijin+$alasan?></td>
        </tr>
      </table>
  </div>

  <div class="text-right">
    <?php if($this->userdata->nama_jabatan != 'Admin' && $no > 1) {?>
    <a href="<?php echo base_url('Absensi/kehadiran/'.$kelas->id_kelas.'_'.$tanggal.'_'.$tahun_ajaran)?>">
      <button class="btn btn-warning" ><i class="glyphicon glyphicon-repeat"></i> Ubah</button>
    </a>
  <?php }?>
     <button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tutup</button>
  </div>
</div>