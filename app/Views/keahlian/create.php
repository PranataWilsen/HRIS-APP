<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header bg-primary text-white">
    <h4 class="mb-0">Tambah Keahlian</h4>
  </div>
  <div class="card-body">
    <form id="formKeahlianCreate" action="/keahlian/storeAjax" method="post">
        <?= csrf_field() ?> <!-- ✅ wajib -->

        <div class="mb-3">
            <label class="form-label">Nama Keahlian</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        <a href="/keahlian" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
  $('#formKeahlianCreate').submit(function(e){
    e.preventDefault();

    // reset error lama
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();

    $.ajax({
      url: $(this).attr('action'),
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(res){
        console.log(res); // debug

        if(res.status === 'success'){
          Swal.fire('Berhasil', res.message, 'success').then(() => {
            window.location.href = '/keahlian';
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
