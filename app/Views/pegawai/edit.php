<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header bg-primary text-white">
    <h4 class="mb-0">Edit Pegawai</h4>
  </div>
  <div class="card-body">
    <form id="formPegawai" action="/pegawai/updateAjax/<?= $pegawai['id'] ?>" method="post">
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
            <?php 
            $selected = $pegawai['keahlian'] ? explode(',', $pegawai['keahlian']) : [];
            foreach ($keahlian as $k): ?>
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
  $('#formPegawai').submit(function(e){
    e.preventDefault();

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
            text: res.message ?? 'Data berhasil diupdate!'
          }).then(() => {
            window.location.href = '/pegawai';
          });
        } else if(res.status === 'error'){
          // reset error lama
          $('.is-invalid').removeClass('is-invalid');
          $('.invalid-feedback').remove();

          // tampilkan error baru
          $.each(res.errors, function(field, msg){
            const el = $('[name="'+field+'"]');
            el.addClass('is-invalid');
            el.after('<div class="invalid-feedback">'+msg+'</div>');
          });
        }
      },
      error: function(){
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Terjadi kesalahan saat update data.'
        });
      }
    });
  });
});
</script>
<?= $this->endSection() ?>
