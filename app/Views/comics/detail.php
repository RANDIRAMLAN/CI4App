<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row mt-5">
        <div class="card mb-3 mt-5 mx-auto" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="/img/<?= $komik['sampul']; ?>" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $komik['judul']; ?></h5>
                        <p class="card-text"> <b><?= $komik['slug']; ?> </b>is a manga series by <B><?= $komik['penulis']; ?></B> which is the first to become an anime series.
                            This comic was published by <b><?= $komik['penerbit']; ?></b>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>