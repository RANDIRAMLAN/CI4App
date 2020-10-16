<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row mt-5">
        <div class="col col-sm-8 mt-5 mx-auto">
            <?php if (session()->getFlashdata('simpan')) { ?>
                <div class="alert alert-success text-center" role="alert">
                    <?= session()->getFlashdata('simpan'); ?>
                </div>
            <?php }; ?>
            <?php if (session()->getFlashdata('hapus')) { ?>
                <div class="alert alert-success text-center" role="alert">
                    <?= session()->getFlashdata('hapus'); ?>
                </div>
            <?php }; ?>
            <?php if (session()->getFlashdata('ubah')) { ?>
                <div class="alert alert-success text-center" role="alert">
                    <?= session()->getFlashdata('ubah'); ?>
                </div>
            <?php }; ?>
            <button type="button" class="mb-2 btn-light" data-toggle="modal" data-target="#myModal">
                <a href="/comics/create"><i class="fas fa-plus-circle"></i></a>
            </button>
            <!-- Table index -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Number</th>
                        <th scope="col" class="text-center">Cover</th>
                        <th scope="col" class="text-center">Title</th>
                        <th scope="col" class="text-center" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($komik as $k) { ?>
                        <tr>
                            <td class="text-center pt-5"><?= $i; ?></td>
                            <td><img src="/img/<?= $k['sampul']; ?>" alt="" class="image"></td>
                            <td class="pt-5"><?= $k['judul']; ?></td>
                            <td class="text-center pt-5">
                                <button class="btn-light">
                                    <a href="/comics/<?= $k['slug']; ?>">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                </button>
                            </td>
                            <td class="text-center pt-5">
                                <button class="btn-light">
                                    <a href="/comics/edit/<?= $k['slug']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </button>
                            </td>
                            <td class="text-center pt-5">
                                <form action="/comics/<?= $k['id']; ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn-light" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>