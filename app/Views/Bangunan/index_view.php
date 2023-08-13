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
                            <th>Pemilik</th>
                            <th>No Bangunan</th>
                            <th>RT</th>
                            <th>Jumlah KK</th>
                            <th>Nama KK</th>
                            <th>IMB</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Kondisi</th>
                            <th>Sarana Air Minum</th>
                            <th>Sarana Air Limbah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getDataBangunan as $row) :    ?>
                            <tr>
                                <td>
                                    <div class="btn-group mb-1">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle me-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu border border-2" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="<?= site_url($url.'/ubah/'.$row->bangunan_id) ?>">Ubah</a>
                                                <a class="dropdown-item" href="javascript:;" data-href="<?= site_url($url.'/delete/'.$row->bangunan_id) ?>" onclick="deleteData(this)">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $row->pemilik ?></td>
                                <td><?= $row->bangunan_no ?></td> 
                                <td><?= $RTModel->getRTNameById($row->rukun_tetangga_id) ?></td>
                                <td><?= $row->kk_jml ?></td>
                                <td><?= $row->kk_name ?></td>
                                <td><?= $row->imb ?></td>   
                                <td><?= $JenisModel->getJenisNameById($row->jenis_id) ?></td>
                                <td><?= $StatusModel->getStatusNameById($row->status_id) ?></td>
                                <td><?= $KondisiModel->getKondisiNameById($row->kondisi_id) ?></td>
                                <td><?= $SAUModel->getSauNameById($row->sau_id) ?></td>
                                <td><?= $SALModel->getSalNameById($row->sal_id) ?></td>
                                <td><?= $row->keterangan ?></td>
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


