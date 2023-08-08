<?= $this->extend('_layouts/index_view.php') ?>

<?= $this->section('content') ?>
<?php 
echo is_readable('public\uploads\BANGUNAN RT 05 EKOR LUBUK.shp') && is_file('public\uploads\BANGUNAN RT 05 EKOR LUBUK.shp')
?>
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<script src="/mazer/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="/mazer/assets/js/pages/dashboard.js"></script>
<?= $this->endSection() ?>