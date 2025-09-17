<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Statistik Pegawai</h2>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Pie Chart Gender
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

  // Bar Chart Departemen
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
