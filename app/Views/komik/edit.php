<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit Data Komik</h4>
                </div>
                <div class="card-body">

                    <form action="/komik/change/" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <input type="hidden" name="id" value='<?= $komik['id'] ?>'>
                        <input type="hidden" name="slug" value="<?= $komik['slug'] ?>">
                        <input type="hidden" name="sampulLama" id="sampulLama" value="<?= $komik['sampul'] ?>">
                        <div class="form-group row">
                            <label for="judul" class="col-sm-2 col-form-label"><b>Judul</b> </label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="judul" name="judul" value="<?= old('judul', $komik['judul']) ?>">
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
                                <input type="text" class="form-control" id="penulis" name="penulis" value="<?= old('penulis', $komik['penulis']) ?>">
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
                                <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit', $komik['penerbit']) ?>">
                                <div class=" text-danger">
                                    <small>
                                        <?= $validation->getError('penerbit') ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sampul" class="col-sm-2 col-form-label"><strong>Sampul</strong></label>
                            <div class="col-sm-2">
                                <img src="/img/default.png" class="img-thumbnail img-preview">
                            </div>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input <?= $validation->hasError('sampul') ? 'is-invalid' : '' ?>" id="sampul" name="sampul" onchange="previewImg()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('sampul') ?>
                                    </div>
                                    <label class="custom-file-label" for="sampul">Pilih Gambar..</label>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="card-footer text-muted">
                    <div class="form-group row">
                        <div class="col-sm">
                            <button type="submit" class="btn btn-primary float-right mt">Ubah</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>