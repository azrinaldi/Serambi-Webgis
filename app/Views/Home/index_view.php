<?= $this->extend('_layouts/index_view.php') ?>

<?= $this->section('content') ?>

<div id="map"></div>
<?= $this->endSection() ?>
<?= $this->section('style') ?>
<style>
    #map {
        height: 90vh;
        width: 100%;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
    var map = L.map('map').setView([-0.46976943859169573, 100.40106421776511], 14);
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '© OpenStreetMap'
    });
    osm.addTo(map);

    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });

    googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });

    var baseLayers = {
        "Satellite": googleSat,
        "Google Map": googleStreets,
        "OpenStreetMap": osm
    };

    var geojsonbangunan = [<?php foreach ($getDataBangunan as $value) : ?><?= $value->geojson ?>,<?php endforeach ?>];
    var bangunan = L.geoJSON(geojsonbangunan);
    var geojsonkecamatan = [<?php foreach ($getDataKecamatan as $value) : ?><?= $value->geojson ?>,<?php endforeach ?>];
    var kecamatan = L.geoJSON(geojsonkecamatan,{color: "#ff0000"});
    var overlays = {
        "Layer Kecamatan": kecamatan,
        "Layer Bangunan": bangunan
    };
    L.control.layers(baseLayers, overlays).addTo(map);
</script>
<?= $this->endSection() ?>