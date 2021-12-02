<?php 
    $year = $dataRekap_SPP->tanggal_bayar[0].$dataRekap_SPP->tanggal_bayar[1].$dataRekap_SPP->tanggal_bayar[2].$dataRekap_SPP->tanggal_bayar[3];
    $month = $dataRekap_SPP->tanggal_bayar[5].$dataRekap_SPP->tanggal_bayar[6];
    $day = $dataRekap_SPP->tanggal_bayar[8].$dataRekap_SPP->tanggal_bayar[9];
    $tanggal = tanggal($day, $month, $year);
?>
<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-briefcase"></i> Detail Rekap SPP<br><br><b></b></h3>

  <div class="box box-body">
    <form>
      <table id="tabel-detail" class="table table-bordered table-striped">
        <tbody id="data-rekap_spp">
              <tr>
                <td colspan="4" style="text-align: center; "> <img src="<?php echo base_url();?>assets/img/<?php echo $dataRekap_SPP->foto ?>" style="max-width: 200px; max-height: 160px"> 
                </td>
              </tr>
              <tr>
                <td>Nomor Transaksi</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $dataRekap_SPP->no_transaksi; ?>"disabled></td>

                <td>Tanggal Bayar</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $tanggal; ?>"disabled></td>
              </tr>
              <tr>
                <td>NIS</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $dataRekap_SPP->NIS; ?>"disabled></td>
                <td>Nama Siswa</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $dataRekap_SPP->nama_siswa; ?>"disabled></td>
              </tr>
              <tr>
                <td>Kelas</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $dataRekap_SPP->nama_kelas; ?>"disabled></td>
                <td>Tahun Ajaran</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $dataRekap_SPP->tahun; ?>"disabled></td>
              </tr>
              <tr>
                <td>Bulan yang Dibayar</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $dataRekap_SPP->nama_bulan; ?>"disabled></td>
                <td>Nominal</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $dataRekap_SPP->nominal; ?>"disabled></td>
              </tr>
              <tr>
                <td>Penerima Pembayaran</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $dataRekap_SPP->nama_pegawai; ?>"disabled></td>
                <td>Status Pembayaran</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $dataRekap_SPP->status_pembayaran; ?>"disabled></td>
              </tr>
        </tbody>
      </table>
    </form>
  </div>

  <div class="text-right">
    

    <?php if($this->userdata->nama_jabatan == 'Staf Tata Usaha'){?>
    <a href="<?php echo base_url('Rekap_SPP/update/'.$dataRekap_SPP->no_transaksi);?>">
      <button class="btn btn-warning"><i class="glyphicon glyphicon-repeat"></i> Ubah</button>
    </a>
    <a href="<?php echo base_url('Rekap_SPP/cetak/'.$dataRekap_SPP->no_transaksi);?>" target="_blank">
            <button class="btn btn-success" ><i class="glyphicon glyphicon-print"></i> Cetak</button >
    </a>
  <?php }?>
    <button class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove"></i> Tutup</button>
  </div>
</div>