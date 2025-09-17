<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header bg-success text-white">
    <h4 class="mb-0">Kuis Pegawai</h4>
  </div>
  <div class="card-body">

    <form method="post" action="/quiz/submit">

      <!-- Pilih Pegawai -->
      <div class="mb-3">
        <label class="form-label"><strong>Pilih Pegawai</strong></label>
        <select name="pegawaiid" class="form-control" required>
          <option value="">-- Pilih Pegawai --</option>
          <?php if (!empty($pegawai)): ?>
            <?php foreach ($pegawai as $p): ?>
              <option value="<?= $p['id'] ?>"><?= esc($p['name']) ?></option>
            <?php endforeach; ?>
          <?php else: ?>
            <option disabled>(Belum ada pegawai)</option>
          <?php endif; ?>
        </select>
      </div>

      <hr>

      <!-- Pertanyaan -->
      <?php if (!empty($questions)): ?>
        <?php foreach ($questions as $q): ?>
          <div class="mb-4">
            <strong><?= esc($q['question']) ?></strong><br>
            <?php foreach ($q['answers'] as $a): ?>
              <label class="me-3">
                <input type="checkbox" name="answers[<?= $q['id'] ?>][]" value="<?= $a['id'] ?>">
                <?= esc($a['text']) ?>
              </label>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p><em>Tidak ada pertanyaan aktif.</em></p>
      <?php endif; ?>

      <button class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit</button>
    </form>

  </div>
</div>

<?= $this->endSection() ?>
