<div class="card mb-3" style="max-width: 18rem;">
    <div class="card-header"><?= $judul; ?></div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama Siswa</label>
                <input type="text" class="form-control" name="nama" id="nama" aria-describedby="nama">
                <?php if (validation_errors()) : ?>
                    <small id="nama" class="form-text alert-danger"><?= validation_errors(); ?></small>
                <?php endif; ?>
            </div>

            <button type="submit" name="tambah">Tambah</button>
        </form>
    </div>
</div>