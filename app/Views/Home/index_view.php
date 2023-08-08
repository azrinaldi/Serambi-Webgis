<?= $this->extend('_layouts/index_view.php') ?>

<?= $this->section('content') ?>
<div id="map"></div>
<?= $this->endSection() ?>
<?= $this->section('style') ?>
<style>
    #map {
        height: 90vh;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
    var map = L.map('map').setView([-0.4614258650409092, 100.4020295375554], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    L.geoJSON(geojson).addTo(map);
</script>
<script src="/mazer/assets/js/pages/dashboard.js"></script>
<?= $this->endSection() ?>