<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row mb-3">
  <div class="col-12">
    <h2 class="fw-bold"><i class="fas fa-chart-pie me-2"></i> Statistik Pegawai</h2>
    <p class="text-muted">Visualisasi data pegawai berdasarkan gender dan departemen</p>
  </div>
</div>

<div class="row">
  <!-- Pie Chart Gender -->
  <div class="col-md-6">
    <div class="card card-primary shadow-sm">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-venus-mars me-2"></i> Distribusi Gender</h3>
      </div>
      <div class="card-body">
        <canvas id="genderChart" height="200"></canvas>
      </div>
    </div>
  </div>

  <!-- Bar Chart Departemen -->
  <div class="col-md-6">
    <div class="card card-success shadow-sm">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-building me-2"></i> Pegawai per Departemen</h3>
      </div>
      <div class="card-body">
        <canvas id="deptChart" height="200"></canvas>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Label gender lebih jelas
  const genderLabels = <?= json_encode(
    array_map(fn($g) => $g === 'P' ? 'Pria' : ($g === 'W' ? 'Wanita' : $g), $genderLabels)
  ) ?>;
  const genderCounts = <?= json_encode($genderCounts) ?>;

  new Chart(document.getElementById('genderChart'), {
    type: 'pie',
    data: {
      labels: genderLabels,
      datasets: [{
        data: genderCounts,
        backgroundColor: ['#36A2EB', '#FF6384'], // Biru untuk Pria, Merah untuk Wanita
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' }
      }
    }
  });

  const deptLabels = <?= json_encode($deptLabels) ?>;
  const deptCounts = <?= json_encode($deptCounts) ?>;

  new Chart(document.getElementById('deptChart'), {
    type: 'bar',
    data: {
      labels: deptLabels,
      datasets: [{
        label: 'Jumlah Pegawai',
        data: deptCounts,
        backgroundColor: '#4BC0C0'
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
</script>

<?= $this->endSection() ?>
