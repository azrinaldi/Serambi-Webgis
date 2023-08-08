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
                        <?= input_hidden('jalan_id', $jalan_id ?? '') ?>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Jalan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('jalan_name', $jalan_name ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Panjang Jalan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('jalan_panjang', $jalan_panjang ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Lebar Jalan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('jalan_lebar', $jalan_lebar ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Jenis Jalan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('jalan_jenis', $jenis_jalan ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Kelas Jalan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('jalan_kelas', $jalan_kelas ?? '') ?>
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