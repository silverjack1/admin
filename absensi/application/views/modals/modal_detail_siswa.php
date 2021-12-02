<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-briefcase"></i> Detail Siswa<br><br><b><?php echo $siswa->nama_siswa; ?></b></h3>

  <?php
  $tanggal_lahir = tanggal(intval($siswa->tanggal_lahir[8].$siswa->tanggal_lahir[9]), intval($siswa->tanggal_lahir[5].$siswa->tanggal_lahir[6]), intval($siswa->tanggal_lahir[0].$siswa->tanggal_lahir[1].$siswa->tanggal_lahir[2].$siswa->tanggal_lahir[3]));
  ?>

  <div class="box box-body">
    <form>
      <table id="tabel-detail" class="table table-bordered table-striped">
        <tbody id="data-siswa">
              <tr>
                <td colspan="4" style="text-align: center; "> <img src="<?php echo base_url();?>assets/img/<?php echo $siswa->foto ?>" style="max-width: 200px; max-height: 160px"> 
                </td>
              </tr>  
              <tr>
                <td>NIS</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $siswa->NIS; ?>"disabled></td>
                <td>Nama</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $siswa->nama_siswa; ?>"disabled></td>
              </tr>
              <tr>
                <td>Tempat Tanggal Lahir</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $siswa->tempat_lahir.', '.$tanggal_lahir; ?> "disabled></td>

                <td>Jenis Kelamin</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php if($siswa->jenis_kelamin=='L') {echo"Laki-laki";}
                        else{echo"Perempuan";}; ?>"disabled></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $siswa->alamat; ?>"disabled></td>
                <td>Status</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $siswa->status_siswa; ?>"disabled></td>
              </tr>
               <tr>
                <td>Tahun Masuk</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $siswa->tahun_masuk; ?>"disabled></td>
                
              </tr>
        </tbody>
      </table>
    </form>
  </div>
   <div class="text-right">
  <button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tutup</button>
  </div>
</div>