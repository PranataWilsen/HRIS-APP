<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Laporan Hasil Kuis Pegawai</h2>
<a href="/report/exportHasilKuisExcel" class="btn btn-success mb-3">Export Excel</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Pegawai</th>
            <th>Skor</th>
            <th>Total Soal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $d): ?>
        <tr>
            <td><?= esc($d['pegawai']) ?></td>
            <td><?= $d['score'] ?></td>
            <td><?= $d['total'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
