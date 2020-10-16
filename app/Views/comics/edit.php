<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<br><br>
<div class="container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $header; ?></h5>
            </div>
            <div class="modal-body">
                <form action="/comics/update/<?= $komik['id']; ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
                    <input type="hidden" name="sampulLama" value="<?= $komik['sampul']; ?>">
                    <div class="form-group">
                        <label for="judul">Comic Title</label>
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" aria-describedby="titleHelp" autocomplete="off" value="<?= (old('judul')) ? old('judul') : $komik['judul']; ?>">
                        <small id="validationServer03Feedback" class="invalid-feedback"><?= $validation->listErrors(); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="penulis">Comic Writer</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" autocomplete="off" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis']; ?>">
                    </div>
                    <div class=" form-group">
                        <label for="penerbit">Comic Pablisher</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" autocomplete="off" value="<?= (old('penerbit')) ? old('penerbit') : $komik['penerbit']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="sampul">Comic Cover</label>
                        <input type="file" class="form-control-file <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul">
                        <small id="validationServer03Feedback" class="invalid-feedback"><?= $validation->listErrors(); ?></small>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Edit Comic</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>