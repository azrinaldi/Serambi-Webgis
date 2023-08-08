<?= $this->extend('_layouts/index_view.php') ?>

<?= $this->section('content') ?>

<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<script src="/mazer/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="/mazer/assets/js/pages/dashboard.js"></script>
<?= $this->endSection() ?>