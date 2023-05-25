<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Jadwal Ujian</h4>
                <form action="<?= base_url('/admin/jadwal_ujian/update/' . $jadwal_ujian['id_jadwal_ujian']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_jadwal_ujian" value="<?= $jadwal_ujian['id_jadwal_ujian']; ?>">
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <select class="form-control <?= (validation_show_error('prodi')) ? 'is-invalid' : ''; ?>" id="prodi" name="prodi">
                            <option value="">Pilih Program Studi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <?php if ($p['prodi'] != 'Non Teknik') : ?>
                                    <option value="<?= $p['id_prodi']; ?>" <?= (old('id_prodi', $jadwal_ujian['id_prodi']) == $p['id_prodi']) ? 'selected' : ''; ?>>
                                        <?= $p['prodi']; ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('prodi'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control <?= (validation_show_error('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="kelas" data-value="<?= old('kelas') ?>">
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('kelas'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dosen">Dosen</label>
                        <input type="text" class="form-control" id="dosen" name="dosen" value="" placeholder="Dosen" readonly>
                    </div>
                    <div class="form-group">
                        <label for="ruang_ujian">Ruang Ujian</label>
                        <select class="form-control <?= (validation_show_error('ruang_ujian')) ? 'is-invalid' : ''; ?>" id="ruang_ujian" name="ruang_ujian">
                            <option value="">Pilih Ruang Ujian</option>
                            <?php foreach ($ruang_ujian as $r) : ?>
                                <option value="<?= $r['id_ruang_ujian']; ?>" <?= (old('id_ruang_ujian', $jadwal_ujian['id_ruang_ujian']) == $r['id_ruang_ujian']) ? 'selected' : ''; ?>>
                                    <?= $r['ruang_ujian']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('ruang_ujian'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" class="form-control <?= (validation_show_error('jumlah_peserta')) ? 'is-invalid' : ''; ?>" id="jumlah_peserta" name="jumlah_peserta" value="<?= old('jumlah_peserta', $jadwal_ujian['jumlah_peserta']); ?>" placeholder="Jumlah Peserta">
                        <div class="invalid-feedback">
                            <?= validation_show_error('jumlah_peserta'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="datetime-local" class="form-control <?= (validation_show_error('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= old('tanggal', $jadwal_ujian['tanggal']); ?>" placeholder="Tanggal">
                        <div class="invalid-feedback">
                            <?= validation_show_error('tanggal'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="datetime-local" class="form-control <?= (validation_show_error('jam_mulai')) ? 'is-invalid' : ''; ?>" id="jam_mulai" name="jam_mulai" value="<?= old('jam_mulai', $jadwal_ujian['jam_mulai']); ?>" placeholder="Jam Mulai">
                        <div class="invalid-feedback">
                            <?= validation_show_error('jam_mulai'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="datetime-local" class="form-control <?= (validation_show_error('jam_selesai')) ? 'is-invalid' : ''; ?>" id="jam_selesai" name="jam_selesai" value="<?= old('jam_selesai', $jadwal_ujian['jam_selesai']); ?>" placeholder="Jam Selesai">
                        <div class="invalid-feedback">
                            <?= validation_show_error('jam_selesai'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>

                <script>
                    $(document).ready(function() {
                        let id_prodi = $('select[name=prodi]').val();
                        let id_kelas = $('select[name=kelas]').val();
                        console.log('prodi', id_prodi)
                        console.log('kelas', id_prodi)
                        if (id_prodi !== '') {
                            getKelas(id_prodi)
                        }
                        if (id_kelas !== '') {
                            getDosen(id_kelas)
                        }

                    })

                    function getKelas(id_prodi) {
                        if (id_prodi !== '') {
                            let id_kelas = $('select[name=kelas]').data('value');
                            $.ajax({
                                url: window.location.origin + '/api/kelas/' + id_prodi,
                                type: 'GET',
                                success: function(response) {
                                    let options = `<option value="">Pilih Kelas</option>`
                                    for (const data of response) {
                                        options += `<option value="${data.id_kelas}" ${id_kelas == data.id_kelas ? 'selected' : ''}>${data.matkul} - ${data.kelas}</option>`
                                    }
                                    $('select[name=kelas]').html(options)
                                },
                            })
                        }

                    }

                    function getDosen(id_kelas) {
                        if (id_kelas !== '') {
                            let id_dosen = $('select[name=dosen]').data('value');
                            $.ajax({
                                url: window.location.origin + '/api/dosen/' + id_kelas,
                                type: 'GET',
                                success: function(response) {
                                    $('input[name=dosen]').val(response.data)
                                },
                            })
                        }

                    }

                    $('select[name=prodi]').on('change', function() {
                        getKelas(this.value)
                    })

                    $('select[name=kelas]').on('change', function() {
                        getDosen(this.value)
                    })
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>