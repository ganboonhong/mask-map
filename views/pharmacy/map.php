<?php
use yii\helpers\Html;
?>

<?=Html::cssFile('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css')?>

<!-- https://leafletjs.com/reference-1.6.0.html -->
<?=Html::cssFile('https://unpkg.com/leaflet@1.6.0/dist/leaflet.css', [
    'rel' => 'stylesheet',
    'integrity' => 'sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==',
    'crossorigin' => ''])?>
<?=Html::cssFile('https://unpkg.com/leaflet.markercluster@1.1.0/dist/MarkerCluster.css', [
    'rel' => 'stylesheet',
])?>
<?=Html::cssFile('https://unpkg.com/leaflet.markercluster@1.1.0/dist/MarkerCluster.Default.css', [
    'rel' => 'stylesheet',
])?>

<?=Html::tag('div', '', ['id' => 'mapid', 'style' => 'height: 500px'])?>

<!-- http://leaflet.github.io/Leaflet.markercluster/#using-the-plugin -->
<?=Html::jsFile('https://unpkg.com/leaflet@1.6.0/dist/leaflet.js', [
    'integrity' => 'sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==',
    'crossorigin' => ''])?>

<?=Html::jsFile('https://unpkg.com/leaflet.markercluster@1.1.0/dist/leaflet.markercluster.js', [])?>

<?=$this->registerJsFile(
    '@web/js/pharmacy-map.js'
)?>