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
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Nama</th>
          <th>Gender</th>
          <th>Departemen</th>
          <th>Alamat</th>
          <th>Keahlian</th>
          <th>Status</th>
          <th width="160">Aksi</th>
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
            <?php 
              $ids = explode(',', $p['keahlian']);
              foreach ($ids as $id) {
                echo "<span class='badge bg-info me-1'>".($keahlianMap[$id] ?? $id)."</span>";
              }
            ?>
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
            <button type="button" class="btn btn-sm btn-danger btnDelete" data-id="<?= $p['id'] ?>">
              <i class="fas fa-trash"></i> Hapus
            </button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
$(document).on('click', '.btnDelete', function(){
  const id = $(this).data('id');

  Swal.fire({
    title: 'Yakin hapus?',
    text: "Data ini tidak bisa dikembalikan!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/pegawai/deleteAjax/' + id,
        method: 'DELETE',
        dataType: 'json',
        success: function(res){
          if(res.status === 'success'){
            Swal.fire('Terhapus!', res.message, 'success').then(() => {
              location.reload();
            });
          } else {
            Swal.fire('Error', res.message ?? 'Gagal menghapus', 'error');
          }
        },
        error: function(){
          Swal.fire('Error', 'Terjadi kesalahan server', 'error');
        }
      });
    }
  });
});
</script>

<?= $this->endSection() ?>
