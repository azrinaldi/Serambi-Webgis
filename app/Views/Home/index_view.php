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
    var map = L.map('map').setView([-0.4614258650409092, 100.4020295375554], 14);
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '© OpenStreetMap'
    });
    osm.addTo(map);

    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    googleStreets.addTo(map);

    googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    googleSat.addTo(map);

    var baseLayers = {
        "Satellite": googleSat,
        "Google Map": googleStreets,
        "OpenStreetMap": osm
    };
    var geojsonFeature = {
        "type": "MultiPolygon",
        "bbox": [100.42654053037614, -0.47338084927683355, 100.42666176229999, -0.47320422190968103],
        "coordinates": [
            [
                [
                    [100.42654134465674, -0.4732062804182664],
                    [100.42654098811813, -0.4732064001433094],
                    [100.42654134359283, -0.4732063936023739],
                    [100.42654134465674, -0.4732062804182664]
                ]
            ],
            [
                [
                    [100.42654134359283, -0.4732063936023739],
                    [100.42654053037614, -0.47329290808280217],
                    [100.4265512275122, -0.4732941023799219],
                    [100.42655243378344, -0.47338084927683355],
                    [100.42659522061605, -0.4733772508772706],
                    [100.42659462463249, -0.473368875414284],
                    [100.42662968703216, -0.47337066292018865],
                    [100.42662551160228, -0.4732946852520973],
                    [100.42666176229999, -0.47329527600055393],
                    [100.42665936660714, -0.47320422190968103],
                    [100.42654134359283, -0.4732063936023739]
                ]
            ]
        ]
    };
    var myLayer = L.geoJSON().addTo(map);
    myLayer.addData(geojsonFeature);

    L.control.layers(baseLayers).addTo(map);
</script>
<?= $this->endSection() ?>