<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Pengawas</h4>
<div class="template-demo">
    <a href="/admin/pengawas/create" class="btn btn-primary btn-icon-text">
        <i class="ti-plus btn-icon-prepend"></i>
        Tambah
    </a>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="pengawas" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pengawas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($pengawas as $p) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $p['nip']; ?></td>
                                    <td><?= $p['pengawas']; ?></td>
                                    <td>
                                        <a href="/admin/pengawas/edit/<?= $p['id_pengawas']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <button data-id="<?= $p['id_pengawas']; ?>" data-model="pengawas" type="submit" class="btn btn-danger btn-rounded btn-icon delete">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <script src="/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>

                    <script>
                        $(document).ready(function() {
                            $('#pengawas').DataTable();
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>