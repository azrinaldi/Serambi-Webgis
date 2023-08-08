<!-- button trigger for  Vertically Centered modal -->
<button type="button" class="btn btn-danger block float float-end" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
    <span class="bi bi-upload">  Import Data</span>
</button>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambahkan File</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action='<?= site_url($url . '/upload') ?>' method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupFile01">SHP</label>
                                <input type="file" class="form-control" id="inputGroupFile01" name="shapefile-shp" required>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupFile01">SHX</label>
                                <input type="file" class="form-control" id="inputGroupFile01" name="shapefile-shx" required>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupFile01">DBF</label>
                                <input type="file" class="form-control" id="inputGroupFile01" name="shapefile-dbf" required>
                            </div>
                            <input class="btn btn-primary float-end" type="submit" value="Upload">
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>