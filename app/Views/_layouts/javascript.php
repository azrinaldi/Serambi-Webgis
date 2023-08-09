<script src="/mazer/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/mazer/assets/js/bootstrap.bundle.min.js"></script>

<script src="/mazer/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="/mazer/assets/js/pages/dashboard.js"></script>
<script src="/mazer/assets/js/mazer.js"></script>
<script src="/mazer/assets/js/extensions/sweetalert2.js"></script>
<script src="/mazer/assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

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
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = thisValue.getAttribute('data-href');
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }
</script>