<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Laporan Pegawai per Departemen</h2>
<a href="/report/exportDepartemenExcel" class="btn btn-success mb-3">Export Excel</a>

<?php foreach ($data as $row): ?>
    <h4><?= esc($row['departemen']) ?></h4>
    <ul>
        <?php foreach ($row['pegawai'] as $p): ?>
        <li><?= esc($p['name']) ?> (<?= $p['gender']=='P' ? 'Pria' : 'Wanita' ?>)</li>
        <?php endforeach; ?>
    </ul>
<?php endforeach; ?>

<?= $this->endSection() ?>
