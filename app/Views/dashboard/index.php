<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?= $totalPegawai ?></h3>
        <p>Total Pegawai</p>
      </div>
      <div class="icon"><i class="fas fa-users"></i></div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?= $totalDepartemen ?></h3>
        <p>Total Departemen</p>
      </div>
      <div class="icon"><i class="fas fa-building"></i></div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?= $totalKeahlian ?></h3>
        <p>Total Keahlian</p>
      </div>
      <div class="icon"><i class="fas fa-lightbulb"></i></div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><?= $rataNilai ?>%</h3>
        <p>Rata-rata Nilai Kuis</p>
      </div>
      <div class="icon"><i class="fas fa-chart-line"></i></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header"><h3 class="card-title">Distribusi Gender</h3></div>
      <div class="card-body">
        <canvas id="genderChart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card card-success">
      <div class="card-header"><h3 class="card-title">Pegawai per Departemen</h3></div>
      <div class="card-body">
        <canvas id="deptChart"></canvas>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Pegawai dengan Nilai 100% Benar</h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Pegawai</th>
              <th>Total Soal</th>
              <th>Jawaban Benar</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($benar100) > 0): ?>
              <?php foreach ($benar100 as $row): ?>
              <tr>
                <td><?= esc($row['pegawai']) ?></td>
                <td><?= esc($row['total_soal']) ?></td>
                <td><?= esc($row['jawaban_benar']) ?></td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="3" class="text-center">Belum ada pegawai dengan nilai 100%</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  new Chart(document.getElementById('genderChart'), {
    type: 'pie',
    data: {
      labels: <?= json_encode($genderLabels) ?>,
      datasets: [{
        data: <?= json_encode($genderCounts) ?>,
        backgroundColor: ['#36A2EB', '#FF6384']
      }]
    }
  });
  new Chart(document.getElementById('deptChart'), {
    type: 'bar',
    data: {
      labels: <?= json_encode($deptLabels) ?>,
      datasets: [{
        label: 'Jumlah Pegawai',
        data: <?= json_encode($deptCounts) ?>,
        backgroundColor: '#4BC0C0'
      }]
    }
  });
</script>

<?= $this->endSection() ?>
