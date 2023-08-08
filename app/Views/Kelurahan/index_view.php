<?= $this->extend('_layouts/index_view.php') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= $title ?></h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="float-start"><?= $page ?></div>
                <?php include 'modal_form.php' ?>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead class="text-center">
                        <tr">
                            <th width="50px">Aksi</th>
                            <th>Nama</th>
                            <th>Luas</th>
                            <th>Pusat</th>
                            <th>Jarak ke Pusat</th>
                            <th>Alamat</th>
                            <th>ID Kecamatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getData as $row) :    ?>
                            <tr>
                                <td>
                                    <div class="btn-group mb-1">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle me-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu border border-2" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="<?= site_url($url.'/ubah/'.$row->kelurahan_id) ?>">Ubah</a>
                                                <a class="dropdown-item" href="<?= site_url($url.'/delete/'.$row->kelurahan_id) ?>">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $row->kelurahan_name ?></td>
                                <td><?= $row->kelurahan_luas ?></td>
                                <td><?= $row->pusat ?></td>
                                <td><?= $row->jarak_pusat ?></td>
                                <td><?= $row->alamat ?></td>
                                <td><?= $row->kecamatan_id ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script src="/mazer/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
<?= $this->endSection() ?>


