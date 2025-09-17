<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Data Keahlian</h4>
    <a href="/keahlian/create" class="btn btn-success btn-sm">
      <i class="fas fa-plus"></i> Tambah Keahlian
    </a>
  </div>

  <div class="card-body">
    <?= csrf_field() ?> <!-- ✅ Token disimpan -->

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Nama</th>
          <th>Status</th>
          <th width="160">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($keahlian as $k): ?>
        <tr>
          <td><?= esc($k['name']) ?></td>
          <td>
            <span class="badge <?= $k['active'] ? 'bg-success':'bg-secondary' ?>">
              <?= $k['active'] ? 'Aktif':'Non Aktif' ?>
            </span>
          </td>
          <td>
            <a href="/keahlian/edit/<?= $k['id'] ?>" class="btn btn-sm btn-warning">
              <i class="fas fa-edit"></i> Edit
            </a>
            <button type="button" class="btn btn-sm btn-danger btnDelete" data-id="<?= $k['id'] ?>">
              <i class="fas fa-trash"></i> Hapus
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
$(document).on('click', '.btnDelete', function(){
  const id = $(this).data('id');
  const csrfName = '<?= csrf_token() ?>';
  const csrfHash = $('input[name="<?= csrf_token() ?>"]').val();

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
        url: '/keahlian/deleteAjax/' + id,
        type: 'POST', // ✅ pakai POST
        data: { [csrfName]: csrfHash }, // ✅ kirim token
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
