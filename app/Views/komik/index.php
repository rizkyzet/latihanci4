<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success mt-2" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>
            <a class="btn btn-primary my-3" href="/komik/create">Tambah Data Komik</a>
            <h1 class="mb-3">Daftar Komik</h1>
            <form action="/komik" method="GET" class="form-inline mb-3">
                <input class="form-control" type="text" name="keyword" id="keyword" value="<?= $request->getVar('keyword') ?>">
                <button class="btn btn-primary ml-2 " type="submit">Cari</button>
            </form>
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sampul</th>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1 + ($pageNumber * ($currentPage - 1));
                    foreach ($komik as $k) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td>
                                <img class="sampul" src="/img/<?= $k['sampul'] ?>" alt="">
                            </td>
                            <td><?= $k['judul'] ?></td>
                            <td>
                                <a class="btn btn-success" href="/komik/detail/<?= $k['slug'] ?>">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('komik', 'pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>