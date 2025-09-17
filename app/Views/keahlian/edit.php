<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header bg-warning">
    <h4 class="mb-0">Edit Keahlian</h4>
  </div>
  <div class="card-body">
    <form id="formKeahlian" action="/keahlian/updateAjax/<?= $keahlian['id'] ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Nama Keahlian</label>
            <input type="text" name="name" value="<?= esc($keahlian['name']) ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="active" class="form-control">
                <option value="1" <?= $keahlian['active']==1?'selected':'' ?>>Aktif</option>
                <option value="0" <?= $keahlian['active']==0?'selected':'' ?>>Non Aktif</option>
            </select>
        </div>
        <button class="btn btn-success"><i class="fas fa-save"></i> Update</button>
        <a href="/keahlian" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<script>
$(function(){
  $('#formKeahlian').submit(function(e){
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(res){
        if(res.status === 'success'){
          Swal.fire('Berhasil', res.message, 'success').then(() => {
            window.location.href = '/keahlian';
          });
        } else {
          $('.is-invalid').removeClass('is-invalid');
          $('.invalid-feedback').remove();
          $.each(res.errors, function(field, msg){
            $('[name="'+field+'"]').addClass('is-invalid')
              .after('<div class="invalid-feedback">'+msg+'</div>');
          });
        }
      },
      error: function(){
        Swal.fire('Oops!', 'Terjadi kesalahan server.', 'error');
      }
    });
  });
});
</script>

<?= $this->endSection() ?>
