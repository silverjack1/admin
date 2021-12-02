<div class="container mt-4">
<div class="row">
<div class="col-lg-6">
<?php Flasher::flash(); ?>
</div>
</div>

<div class="row mb-3">
<div class="col-lg-6">
<button type="button" class="btn btn-primary tampilModalTambah" data-toggle="modal" data-target="#formModal">
  Tambah data mahasiswa
</button>

</div>
</div>

<div class="row mb-3">
<div class="col-lg-6">
<form action="<?= BASEURL; ?>/mahasiswa/cari" method="post">
<div class="input-group">
  <input type="text" class="form-control" placeholder="cari mahasiswa.." autocomplete="off" name="keyword" id="keyword">
  <div class="input-group-append">
    <button class="btn btn-primary" type="submit" id="tombolCari">Cari</button>
  </div>
</div>

</form>

</div>
</div>

<div class="row">
<div class="col-lg-6">
<h3 class="mt-2">Daftar Mahasiswa</h3>
<ul class="list-group">
<?php foreach ( $data['mhs'] as $mhs ) : ?>
  <li class="list-group-item"><?= $mhs['nama']; ?> 
  
  <a class="badge badge-danger badge-pill float-right ml-1" href="<?= BASEURL; ?>/mahasiswa/hapus/<?=$mhs['id'];?>" onclick="return confirm('Yakin?');">Hapus</a>
  <a class="badge badge-success badge-pill float-right ml-1 tampilModalUbah" href="<?= BASEURL; ?>/mahasiswa/ubah/<?=$mhs['id'];?>" data-toggle="modal" data-target="#formModal" data-id="<?= $mhs['id']; ?>">Ubah</a>
  <a class="badge badge-primary badge-pill float-right ml-1" href="<?= BASEURL; ?>/mahasiswa/detail/<?=$mhs['id'];?>">Detail</a></li>
  <?php endforeach; ?>
  </ul>


</div>

</div>

</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="<?= BASEURL; ?>/mahasiswa/tambah" method="post">
       <input type="hidden" name="id" id="id">
       <div class="form-group">
    <label for="nama">Nama</label>
    <input type="teks" class="form-control" id="nama" name="nama">
    <div class="form-group">
    <label for="nrp">NRP</label>
    <input type="number" class="form-control" id="nrp" name="nrp">
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email">
    <div class="form-group">
      <label for="jurusan">Jurusan</label>
      <select id="jurusan" class="form-control" name="jurusan">
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="PGSD">PGSD</option>
                <option value="Kedokteran">Kedokteran</option>
      </select>
    </div>
 
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
      </div>
    </div>
  </div>
</div>