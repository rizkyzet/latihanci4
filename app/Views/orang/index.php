<?= $this->extend('layout/template') ?>


<?= $this->section('content') ?>
<div class="container">
    <h1 class="mb-3">Daftar Orang</h1>
    <div class="row">
        <div class="col-2">
            <a href="/orang/create" class="btn btn-primary">Tambah Orang</a>
        </div>
        <div class="col">
            <form action="/orang" method="GET" class="form-inline mb-3 float-right">
                <input class="form-control" type="text" name="keyword" id="keyword" value="<?= $request->getVar('keyword') ?>">
                <button class="btn btn-primary ml-2 " type="submit">Cari</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php if ($session->getFlashData('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $session->getFlashData('pesan') ?>
                </div>
            <?php endif ?>
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1 + ($numberPage * ($currentPage - 1));
                    foreach ($orang as $o) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td>
                                <?= $o['nama'] ?>
                            </td>
                            <td><?= $o['alamat'] ?></td>
                            <td>
                                <a class="btn btn-warning" href="/orang/edit/<?= $o['id'] ?>">Edit</a>
                                <a class="btn btn-success" href="">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('orang', 'pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>