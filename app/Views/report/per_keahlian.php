<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Laporan Pegawai per Keahlian</h2>
<a href="/report/exportKeahlianExcel" class="btn btn-success mb-3">Export Excel</a>

<?php foreach ($data as $row): ?>
    <h4><?= esc($row['keahlian']) ?></h4>
    <ul>
        <?php foreach ($row['pegawai'] as $p): ?>
        <li><?= esc($p['name']) ?> (Departemen ID: <?= $p['departemenid'] ?>)</li>
        <?php endforeach; ?>
    </ul>
<?php endforeach; ?>

<?= $this->endSection() ?>
