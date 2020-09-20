<?= $this->extend('layout/template'); ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <h5 class="card-header"><?= $title ?></h5>
                <div class="card-body">
                    <form action="/orang/update" method="POST">
                        <input type="hidden" name="id" value="<?= $orang['id'] ?>">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= old('nama', $orang['nama']) ?>">
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
                                <input type="text" class="form-control <?= $validation->hasError('alamat') ? 'is-invalid' : '' ?>" name="alamat" id="alamat" value="<?= old('alamat', $orang['alamat']) ?>">
                                <?php if ($validation->hasError('alamat')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('alamat') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>