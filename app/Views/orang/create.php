<?= $this->extend('layout/template') ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row">

        <div class="col-sm-8">
            <div class="card">
                <h5 class="card-header"><?= $title ?></h5>
                <div class="card-body">
                    <form method="POST" action="/orang/save">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" name="nama" value="<?= old('nama') ?>">
                                <?php if ($validation->hasError('nama')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" name="alamat" class="form-control <?= $validation->hasError('alamat') ? 'is-invalid' : '' ?>" value="<?= old('alamat') ?>">
                                <?php if ($validation->hasError('alamat')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('alamat') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection(); ?>