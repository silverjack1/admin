<div class="row mt-3">
<div class="col-md-6">
<div class="card">
  <h5 class="card-header">Tambah Data Mahasiswa</h5>
  <div class="card-body">
  <form action="" method="post">
  
  <div class="form-group">
    <label for="nama">Nama</label>
    <input type="text" name="nama" class="form-control" id="nama" >
    <small class="form-text text-danger"><?= form_error('nama'); ?></small>
  </div>
  <div class="form-group">
    <label for="nrp">NRP</label>
    <input type="texts" class="form-control" id="nrp" name="nrp">
    <small class="form-text text-danger"><?= form_error('nrp'); ?></small>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email">
    <small class="form-text text-danger"><?= form_error('email'); ?></small>
  </div>
  <div class="form-group">
      <label for="jurusan">Jurusan</label>
      <select id="jurusan" class="form-control" name="jurusan">
        <?php foreach($jurusan as $j) : ?>
      <option value="<?= $j; ?>"><?= $j; ?></option>
       <?php endforeach; ?>
      </select>
    </div>
<button type="submit" name="tambah" class="btn btn-primary float-right">Tambah Data</button>
</form>
  </div>
</div>


</div>
</div>