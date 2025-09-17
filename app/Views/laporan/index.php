<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Laporan Nilai Pegawai</h2>

<!-- Pegawai dengan jawaban 100% benar -->
<h3>Pegawai dengan Jawaban 100% Benar</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Pegawai ID</th>
            <th>Total Soal</th>
            <th>Jawaban Benar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($benar100 as $row): ?>
        <tr>
            <td><?= $row->pegawaiid ?></td>
            <td><?= $row->total_soal ?></td>
            <td><?= $row->jawaban_benar ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Rata-rata nilai -->
<h3>Rata-Rata Nilai Pegawai</h3>
<p><strong><?= isset($rataRata->rata_rata_nilai) ? number_format($rataRata->rata_rata_nilai, 2) : '-' ?>%</strong></p>

<!-- Total pegawai benar per pertanyaan -->
<h3>Total Pegawai Benar per Pertanyaan</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID Pertanyaan</th>
            <th>Pertanyaan</th>
            <th>Total Benar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($perSoal as $row): ?>
        <tr>
            <td><?= $row->question_id ?></td>
            <td><?= $row->pertanyaan ?></td>
            <td><?= $row->total_benar ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
