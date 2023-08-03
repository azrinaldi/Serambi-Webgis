<!-- button trigger for  Vertically Centered modal -->
<button type="button" class="btn btn-danger block float float-end" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
    <span class="bi bi-upload"> </span> Upload SHP
</button>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Import Form
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url($url . '/save') ?>" method="POST">
                    <?= input_hidden('bangunan_id', $bangunan_id ?? '') ?>
                    <div class="row">
                        <div class="form-group mb-3">
                            <label for="" class="mb-3">Shapefile</label>
                            <?= input_file('file', '', '', '') ?>
                        </div>
                        <div class="form-group mb-3">
                            <i class="float-start" style="font-size: 12px;"><br>Click outside form to cancel</i>
                            <button type="submit" class="btn btn-primary ml-1 float-end">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Upload</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>