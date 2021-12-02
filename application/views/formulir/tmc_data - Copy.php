<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
?>

<style>
	#map {
		width: 100%;
		height: 400px;
	}
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

<button type="button" onclick="addtositi()">add to siti</button>	
<div id='map'></div>

<script>
var cities,siti;
function addtositi(){
	L.marker([39.77, -105]).bindPopup('This is Siti.').addTo(siti);
}
$(document).ready(function(){
	cities = L.layerGroup();
	siti = L.layerGroup();

	L.marker([39.61, -105.02]).bindPopup('This is Littleton, CO.').addTo(cities),
	L.marker([39.74, -104.99]).bindPopup('This is Denver, CO.').addTo(cities),
	L.marker([39.73, -104.8]).bindPopup('This is Aurora, CO.').addTo(cities),
	L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.').addTo(siti);


	var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

	//var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
	//	streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});
	

	var map = L.map('map', {
		center: [39.73, -104.99],
		zoom: 10,
		//layers: [grayscale, cities]
	});
	
	L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

	var baseLayers = {
	//	"Grayscale": grayscale,
		//"Streets": streets
	};

	var overlays = {
		"Cities": cities,
		"Sitis" : siti
	};

	L.control.layers(null,overlays).addTo(map);
});
</script>