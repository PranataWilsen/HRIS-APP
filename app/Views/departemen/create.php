<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header bg-primary text-white">
    <h4 class="mb-0">Tambah Departemen</h4>
  </div>
  <div class="card-body">
    <form id="formDepartemen" action="/departemen/storeAjax" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">Nama Departemen</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        <a href="/departemen" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
  $('#formDepartemen').submit(function(e){
    e.preventDefault();

    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();

    $.ajax({
      url: $(this).attr('action'),
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(res){
        if(res.status === 'success'){
          Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: res.message ?? 'Departemen berhasil ditambahkan!'
          }).then(() => {
            window.location.href = '/departemen';
          });
        } else if(res.errors){
          $.each(res.errors, function(field, msg){
            const el = $('[name="'+field+'"]');
            el.addClass('is-invalid');
            el.after('<div class="invalid-feedback">'+msg+'</div>');
          });
        } else {
          Swal.fire('Gagal', res.message || 'Terjadi kesalahan', 'error');
        }
      },
      error: function(xhr){
        Swal.fire('Error', 'Server error saat menyimpan data.', 'error');
        console.error(xhr.responseText);
      }
    });
  });
});
</script>
<?= $this->endSection() ?>
