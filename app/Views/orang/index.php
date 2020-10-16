<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row mt-5">
        <div class="col col-sm-12 mt-5 mx-auto">
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari ..." aria-label="Recipient's username" aria-describedby="button-addon2" name="cari">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" name="submit">Cari</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Number</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + ($page * ($currentPage - 1)); ?>
                    <?php foreach ($orang as $o) { ?>
                        <tr>
                            <td class="text-center"><?= $i; ?></td>
                            <td class=""><?= $o['nama']; ?></td>
                            <td class=""><?= $o['alamat']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php }; ?>
                </tbody>
            </table>
            <?= $pager->links('orang', 'orang_pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>