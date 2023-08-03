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
                        <?= input_hidden('bangunan_id', $bangunan_id ?? '') ?>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Bangunan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('bangunan_name', $bangunan_name ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Pemilik</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('pemilik', $pemilik ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Nomor Bangunan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('bangunan_no', $bangunan_no ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Jumlah KK</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('kk_jml', $kk_jml ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Nama KK</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('kk_name', $kk_name ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>IMB</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('imb', $imb ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Jenis Bangunan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('jenis_id', $jenis_id ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Status Bangunan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('status_id', $status_id ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Kondisi Bangunan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('kondisi_id', $kondisi_id ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>SAU</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('sau_id', $sau_id ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>SAL</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('sal_id', $sal_id ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>GeoJSON</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <?= input_text('geojson', $geojson ?? '') ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Foto Bangunan</label>
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