<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Tahun Akademik</h4>
                <form action="<?= base_url('/admin/tahun_akademik/save') ?>" method="post" class="forms-sample">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="text" class="form-control <?= (validation_show_error('tahun')) ? 'is-invalid' : ''; ?>" id="tahun" name="tahun" value="<?= old('tahun'); ?>" placeholder="Tahun">
                        <div class="invalid-feedback">
                            <?= validation_show_error('tahun'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control <?= (validation_show_error('semester')) ? 'is-invalid' : ''; ?>" id="semester" name="semester">
                            <option value="">Pilih Semester</option>
                            <option value="Gasal" <?= old('semester') == 'Gasal' ? 'selected' : '';  ?>>Gasal</option>
                            <option value="Genap" <?= old('semester') == 'Genap' ? 'selected' : '';  ?>>Genap</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('semester'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="aktif">Aktif</label>
                        <select class="form-control <?= (validation_show_error('aktif')) ? 'is-invalid' : ''; ?>" id="aktif" name="aktif">
                            <option value="">Pilih Aktif</option>
                            <option value="0" <?= old('aktif') == '0' ? 'selected' : '';  ?>>0</option>
                            <option value="1" <?= old('aktif') == '1' ? 'selected' : '';  ?>>1</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('aktif'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>