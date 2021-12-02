<a class="btn btn-primary" href="<?= base_url('siswa/tambah'); ?>" role="button">Tambah Siswa</a>
<h1>Data Siswa</h1>
<div class="row">
    <ul class="list-group">
        <?php foreach ($siswi as $sis) : ?>
            <li class="list-group-item"><?= $sis['nama']; ?>
                <a href="<?= base_url('siswa/hapus/') . $sis['id']; ?>" class="badge badge-danger float-right">Hapus</a>
                <a href="<?= base_url('siswa/detail/') . $sis['id']; ?>" class="badge badge-success float-right">Detail</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>