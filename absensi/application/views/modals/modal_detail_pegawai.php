<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-briefcase"></i> Detail Pegawai<br><br><b><?php echo $pegawai->nama_pegawai; ?></b></h3>

  <div class="box box-body">
    <form>
      <table id="tabel-detail" class="table table-bordered table-striped">
        <tbody id="data-pegawai">
              <tr>
                <td colspan="4" style="text-align: center; "> <img src="<?php echo base_url();?>assets/img/<?php echo $pegawai->foto ?>" style="max-width: 200px; max-height: 160px"> 
                </td>
              </tr>
              <tr>
                <td>NIP</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $pegawai->NIP; ?>"disabled></td>
                <td>Nama</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $pegawai->nama_pegawai; ?>"disabled></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $pegawai->alamat; ?>"disabled></td>
                <td>Email</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $pegawai->email; ?>"disabled></td>
              </tr>
              <tr>
                <td>Status</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $pegawai->status; ?>"disabled></td>
                <td>Jabatan</td>
                <td style="min-width:230px;"><input type="text" class="form-control" value="<?php echo $pegawai->nama_jabatan; ?>"disabled></td>
              </tr>
        </tbody>
      </table>
    </form>
  </div>

  <div class="text-right">
   <button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tutup</button>
  </div>
</div>