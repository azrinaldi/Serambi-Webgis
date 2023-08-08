<?= $this->extend('_layouts/index_view.php') ?>

<?= $this->section('content') ?>

<?php
if ($getData != null) {
    extract($getData);
}
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= $page ?></h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/<?= $title ?>"><?= $title ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $page ?></a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" action="<?= site_url($url . '/save') ?>" method="POST">
                        <?= input_hidden('jumlah_id', $jumlah_id ?? '') ?>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>ID Kelurahan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('kelurahan_id', $kelurahan_id ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Jumlah PR</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('jumlah_pr', $jumlah_pr ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Jumlah LK</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('jumlah_lk', $jumlah_lk ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Tahun</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('tahun', $tahun ?? '') ?>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="justify-content-start">
                        <a href="/<?= $title ?>"><button type="button" class="btn btn-danger me-1 mb-1">Kembali</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>