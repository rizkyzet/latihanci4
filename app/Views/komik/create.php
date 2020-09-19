<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Data Komik</h4>
                </div>
                <div class="card-body">

                    <form action="/komik/save" method="POST">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="judul" class="col-sm-2 col-form-label"><b>Judul</b> </label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="judul" name="judul" value="<?= old('judul') ?>">
                                <div class=" text-danger">
                                    <small>
                                        <?= $validation->getError('judul') ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="penulis" class="col-sm-2 col-form-label"><b>Penulis</b> </label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="penulis" name="penulis" value="<?= old('penulis') ?>">
                                <div class=" text-danger">
                                    <small>
                                        <?= $validation->getError('penulis') ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="penerbit" class="col-sm-2 col-form-label"><b>Penerbit</b> </label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit') ?>">
                                <div class=" text-danger">
                                    <small>
                                        <?= $validation->getError('penerbit') ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sampul" class="col-sm-2 col-form-label"><b>Sampul</b> </label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="sampul" name="sampul" value="<?= old('sampul') ?>">
                                <div class=" text-danger">
                                    <small>
                                        <?= $validation->getError('sampul') ?>
                                    </small>
                                </div>
                            </div>
                        </div>




                </div>
                <div class="card-footer text-muted">
                    <div class="form-group row">
                        <div class="col-sm">
                            <button type="submit" class="btn btn-primary float-right mt">Tambah</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>