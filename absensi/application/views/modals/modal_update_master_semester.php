<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Ubah Data Semester <?php echo $dataMasterSemester->nama_semester;?></h3>

  <form id="form-update-master-semester" method="POST">
    <input type="hidden" name="id_master_semester" value="<?php echo $dataMasterSemester->id_master_semester?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <select name="id_semester" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataSemester as $semester) {
          ?>
          <option value="<?php echo $semester->id_semester; ?>" <?php if($semester->id_semester==$dataMasterSemester->id_semester) {echo "selected";}?>>
            <?php echo $semester->semester; ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <select name="id_tahun" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataTahunAjaran as $ta) {
          ?>
          <option value="<?php echo $ta->id_tahun; ?>" <?php if($ta->id_tahun==$dataMasterSemester->id_tahun) {echo "selected";}?>>
            <?php echo $ta->tahun; ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
        Tanggal Mulai
      </span>
      <input type="date" name="tanggal_mulai" class="form-control select2" aria-describedby="sizing-addon2" value="<?php echo $dataMasterSemester->tanggal_mulai?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
        Tanggal Akhir
      </span>
      <input type="date" name="tanggal_akhir" class="form-control select2" aria-describedby="sizing-addon2" value="<?php echo $dataMasterSemester->tanggal_akhir?>">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Ubah Semester</button>
      </div>
    </div>
  </form>
</div>