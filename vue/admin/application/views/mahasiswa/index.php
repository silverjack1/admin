<?php if ($this->session->flashdata('flash')) : ?>
  <div class="row mt-3">
    <div class="col-md-6">
      <div class="alert alert-success alert-dismissible fade show" role="alert">Data mahasiswa
        <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="row">
  <div class="col-md-6">
    <a href="<?= base_url(); ?>mahasiswa/tambah" class="btn btn-primary">Tambah Data Mahasiswa</a>
  </div>
</div>



<div class="row mt-3">
  <div class="col-md-6">
    <form action="" method="post">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Cari data mahasiswa" aria-label="Cari data mahasiswa" aria-describedby="button-addon2" name="keyword">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
    </form>
  </div>
</div>
<h3>Daftar Mahasiswa</h3>
<?php if (empty($mahasiswa)) : ?>
  <div class="alert alert-danger" role="alert">
    Data tidak ditemukan!
  </div>
<?php endif; ?>
<ul class="list-group">
  <?php foreach ($mahasiswa as $mhs) : ?>
    <li class="list-group-item"><?= strtoupper($mhs['nama']); ?>
      <a class="badge badge-danger float-right ml-1" href="<?php base_url(); ?>mahasiswa/detail/<?= $mhs['id']; ?>">Detail</a>
      <a class="badge badge-success float-right ml-1" href="<?php base_url(); ?>mahasiswa/ubah/<?= $mhs['id']; ?>">Ubah</a>
      <a class="badge badge-primary float-right" onclick="return confirm('yakin?');" href="<?php base_url(); ?>mahasiswa/<?= $mhs['id']; ?>">Hapus</a>
    </li>
  <?php endforeach; ?>
</ul>
</div>
</div>