<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img class="card-sampul" src="/img/<?= $komik['sampul'] ?>" class="card-img" alt="sampul">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $komik['judul'] ?></h5>
                            <p class="card-text"><b>Penulis : </b> <?= $komik['penulis'] ?></p>
                            <p class="card-text"><small class="text-muted"><b>Penerbit : </b> <?= $komik['penerbit'] ?></small></p>

                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <a href="/komik/edit/<?= $komik['slug'] ?>" class="btn btn-warning w-100 mr-2">Edit</a>

                                <form class="d-inline w-100" action="/komik/<?= $komik['id'] ?>" method="POST">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger  w-100">Delete</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>