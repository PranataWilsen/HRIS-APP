<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card text-center">
  <div class="card-header bg-info text-white">
    <h4>Hasil Kuis</h4>
  </div>
  <div class="card-body">
    <p class="fs-4">Skor Anda:</p>
    <h2 class="fw-bold text-success"><?= $score ?>/<?= $total ?></h2>
    <a href="/quiz" class="btn btn-primary mt-3"><i class="fas fa-redo"></i> Kerjakan Lagi</a>
  </div>
</div>

<?= $this->endSection() ?>
