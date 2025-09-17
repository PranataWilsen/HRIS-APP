<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header bg-primary text-white">
    <h4 class="mb-0">Tambah Pegawai</h4>
  </div>
  <div class="card-body">
    <form id="formPegawai" action="/pegawai/storeAjax" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="P">Pria</option>
                <option value="W">Wanita</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Departemen</label>
            <select name="departemenid" class="form-control" required>
                <option value="">-- Pilih --</option>
                <?php foreach ($departemen as $d): ?>
                    <option value="<?= $d['id'] ?>"><?= esc($d['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Keahlian</label><br>
            <?php foreach ($keahlian as $k): ?>
                <label class="me-3">
                    <input type="checkbox" name="keahlian[]" value="<?= $k['id'] ?>">
                    <?= esc($k['name']) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <button class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        <a href="/pegawai" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
  $('#formPegawai').submit(function(e){
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
        console.log(res); // 🔎 debug

        if(res.status === 'success'){
          Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: res.message ?? 'Pegawai berhasil ditambahkan!'
          }).then(() => {
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
        Swal.fire('Error', 'Server error saat menyimpan data.', 'error');
        console.error(xhr.responseText);
      }
    });
  });
});
</script>
<?= $this->endSection() ?>
