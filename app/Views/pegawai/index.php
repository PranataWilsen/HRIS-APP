<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Data Pegawai</h4>
    <a href="/pegawai/create" class="btn btn-success btn-sm">
      <i class="fas fa-plus"></i> Tambah Pegawai
    </a>
  </div>

  <div class="card-body">
    <?= csrf_field() ?> <!-- ✅ simpan token di halaman -->

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Nama</th>
          <th>Gender</th>
          <th>Departemen</th>
          <th>Alamat</th>
          <th>Keahlian</th>
          <th>Status</th>
          <th width="200">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pegawai as $p): ?>
        <tr>
          <td><?= esc($p['name']) ?></td>
          <td><?= $p['gender'] === 'P' ? 'Pria' : 'Wanita' ?></td>
          <td><?= esc($p['departemen']) ?></td>
          <td><?= esc($p['address']) ?></td>
          <td>
            <?php $ids = $p['keahlian'] ? explode(',', $p['keahlian']) : []; ?>
            <?php foreach ($ids as $id): ?>
              <span class="badge bg-info me-1"><?= $keahlianMap[$id] ?? $id ?></span>
            <?php endforeach; ?>
          </td>
          <td>
            <span class="badge <?= $p['active'] ? 'bg-success':'bg-secondary' ?>">
              <?= $p['active'] ? 'Aktif' : 'Non Aktif' ?>
            </span>
          </td>
          <td>
            <a href="/pegawai/edit/<?= $p['id'] ?>" class="btn btn-sm btn-warning">
              <i class="fas fa-edit"></i> Edit
            </a>
            <button type="button" 
                    class="btn btn-sm <?= $p['active'] ? 'btn-danger':'btn-success' ?> btnToggle" 
                    data-id="<?= $p['id'] ?>" 
                    data-status="<?= $p['active'] ?>">
              <i class="fas <?= $p['active'] ? 'fa-ban' : 'fa-check' ?>"></i>
              <?= $p['active'] ? 'Nonaktifkan' : 'Aktifkan' ?>
            </button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).on('click', '.btnToggle', function(){
  const id = $(this).data('id');
  const currentStatus = $(this).data('status');
  const csrfName = '<?= csrf_token() ?>';
  const csrfHash = $('input[name="<?= csrf_token() ?>"]').val();

  Swal.fire({
    title: currentStatus ? 'Nonaktifkan pegawai ini?' : 'Aktifkan pegawai ini?',
    text: currentStatus 
          ? "Pegawai akan dinonaktifkan, tapi datanya tetap tersimpan."
          : "Pegawai akan diaktifkan kembali.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: currentStatus ? '#d33' : '#28a745',
    cancelButtonColor: '#6c757d',
    confirmButtonText: currentStatus ? 'Ya, Nonaktifkan' : 'Ya, Aktifkan',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/pegawai/toggleActive/' + id,
        type: 'POST',
        data: { [csrfName]: csrfHash },
        dataType: 'json',
        success: function(res){
          if(res.status === 'success'){
            Swal.fire('Berhasil!', res.message, 'success').then(() => {
              location.reload();
            });
          } else {
            Swal.fire('Error', res.message ?? 'Gagal mengubah status', 'error');
          }
        },
        error: function(xhr){
          console.error(xhr.responseText);
          Swal.fire('Error', 'Terjadi kesalahan server', 'error');
        }
      });
    }
  });
});
</script>
<?= $this->endSection() ?>
