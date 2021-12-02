<h1>Daftar Data Siswa</h1>
<a class="btn btn-primary" href="<?= base_url('siswa/tambahsiswa'); ?>">
    Tambah Siswa
</a>
<hr>
<!-- Button trigger modal -->


<table id="datasiswa" name="datasiswa" class="table table-striped table-bordered table-hover table-responsive" style="width:100%">
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA SISWA</th>
            <th>ALAMAT</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($siswa as $siswa2) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= strtoupper($siswa2['nama']); ?></td>
                <td><?= $siswa2['alamat']; ?></td>
                <td>61</td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>NO</th>
            <th>NAMA SISWA</th>
            <th>ALAMAT</th>
            <th>ACTION</th>
        </tr>
    </tfoot>
</table>