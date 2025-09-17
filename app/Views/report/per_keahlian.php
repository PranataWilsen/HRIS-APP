<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header bg-warning d-flex justify-content-between align-items-center">
    <h4 class="mb-0"><i class="fas fa-lightbulb me-2"></i> Laporan Pegawai per Keahlian</h4>
    <a href="/report/exportKeahlianExcel" class="btn btn-success btn-sm">
      <i class="fas fa-file-excel"></i> Export Excel
    </a>
  </div>
  <div class="card-body">
    <?php if(count($data) > 0): ?>
      <?php foreach ($data as $row): ?>
        <div class="mb-4">
          <h5 class="fw-bold text-warning">
            <i class="fas fa-star me-2"></i> <?= esc($row['keahlian']) ?>
            <span class="badge bg-info"><?= count($row['pegawai']) ?> Pegawai</span>
          </h5>
          <table class="table table-sm table-bordered table-striped mt-2">
            <thead class="table-light">
              <tr>
                <th>Nama</th>
                <th>Departemen</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($row['pegawai'] as $p): ?>
                <tr>
                  <td><?= esc($p['name']) ?></td>
                  <td><?= esc($p['departemenid']) ?></td> <!-- bisa join biar nama departemen -->
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="alert alert-warning">Belum ada data pegawai.</div>
    <?php endif; ?>
  </div>
</div>

<?= $this->endSection() ?>
