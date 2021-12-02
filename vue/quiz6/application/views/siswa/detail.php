<a class="btn btn-primary" href="<?= base_url('siswa/tambah'); ?>" role="button">Tambah Siswa</a>
<h1>Data Siswa</h1>
<div class="row">
    <ul class="list-group">
        <div class="card w-75">
            <div class="card-body">
                <h5 class="card-title">Nama Lengkap</h5>
                <p class="card-text"><?= $siswi['nama']; ?></p>
                <a href="<?= base_url('siswa'); ?>" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </ul>
</div>