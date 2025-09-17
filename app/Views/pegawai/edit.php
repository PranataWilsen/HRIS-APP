<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header bg-primary text-white">
    <h4 class="mb-0">Edit Pegawai</h4>
  </div>
  <div class="card-body">
    <form id="formPegawaiEdit" action="/pegawai/updateAjax/<?= $pegawai['id'] ?>" method="post">
        <?= csrf_field() ?> <!-- ✅ Token wajib -->

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" value="<?= esc($pegawai['name']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="P" <?= $pegawai['gender']=='P'?'selected':'' ?>>Pria</option>
                <option value="W" <?= $pegawai['gender']=='W'?'selected':'' ?>>Wanita</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Departemen</label>
            <select name="departemenid" class="form-control" required>
                <option value="">-- Pilih --</option>
                <?php foreach ($departemen as $d): ?>
                    <option value="<?= $d['id'] ?>" <?= $pegawai['departemenid']==$d['id']?'selected':'' ?>>
                        <?= esc($d['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="address" class="form-control"><?= esc($pegawai['address']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Keahlian</label><br>
            <?php $selected = $pegawai['keahlian'] ? explode(',', $pegawai['keahlian']) : []; ?>
            <?php foreach ($keahlian as $k): ?>
                <label class="me-3">
                    <input type="checkbox" name="keahlian[]" value="<?= $k['id'] ?>" 
                           <?= in_array($k['id'], $selected) ? 'checked' : '' ?>>
                    <?= esc($k['name']) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <button class="btn btn-success"><i class="fas fa-save"></i> Update</button>
        <a href="/pegawai" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
  $('#formPegawaiEdit').submit(function(e){
    e.preventDefault();

    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();

    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(res){
        if(res.status === 'success'){
          Swal.fire('Berhasil', res.message, 'success').then(() => {
            window.location.href = '/pegawai';
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
        Swal.fire('Error', 'Server error saat update data.', 'error');
        console.error(xhr.responseText);
      }
    });
  });
});
</script>
<?= $this->endSection() ?>
