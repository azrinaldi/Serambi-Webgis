<script src="/mazer/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/mazer/assets/js/bootstrap.bundle.min.js"></script>

<script src="/mazer/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="/mazer/assets/js/pages/dashboard.js"></script>
<script src="/mazer/assets/js/mazer.js"></script>
<script src="/mazer/assets/js/extensions/sweetalert2.js"></script>
<script src="/mazer/assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    <?php
    if (session()->getFlashdata('info')) {
    ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('info') ?>',
            text: '<?= session()->getFlashdata('message') ?>'
        })
    <?php
    }
    ?>
    let deleteData = (thisValue) => {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang telah dihapus tidak dapat dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = thisValue.getAttribute('data-href');
            }
        })
    }
</script>