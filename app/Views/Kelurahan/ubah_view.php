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
                        <?= input_hidden('kelurahan_id', $kelurahan_id ?? '') ?>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Kelurahan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('kelurahan_name', $kelurahan_name ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Luas Kelurahan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('kelurahan_luas', $kelurahan_luas ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Marker</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('marker', $marker ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Pusat</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('pusat', $pusat ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Zoom</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('zoom', $zoom ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Jarak dari Pusat</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('jarak_pusat', $jarak_pusat ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Alamat</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('alamat', $alamat ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>ID Kecamatan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('kecamatan_id', $kecamatan_id ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Foto Kelurahan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_file('$foto', $foto ?? '') ?>
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