<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Bengkel Di Malang</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">

<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />

<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />

<link href="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>

<style>
	body { margin: 0; padding: 0; }
	#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>

</head>
<body>

<style>
	#inputs,
	#errors,
	#directions {
	    position: absolute;
	    width: 33.3333%;
	    max-width: 300px;
	    min-width: 200px;
	}

	#inputs {
	    z-index: 10;
	    top: 10px;
	    left: 10px;
	}

	#directions {
	    z-index: 99;
	    background: rgba(0,0,0,.8);
	    top: 0;
	    right: 0;
	    bottom: 0;
	    overflow: auto;
	}

	#errors {
	    z-index: 8;
	    opacity: 0;
	    padding: 10px;
	    border-radius: 0 0 3px 3px;
	    background: rgba(0,0,0,.25);
	    top: 90px;
	    left: 10px;
	}

</style>

<style>
.mapboxgl-popup {
	max-width: 400px;
	font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
}
</style>

<script src='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.css' type='text/css' />

<div id='map'></div>
<div id='inputs'></div>
<div id='errors'></div>
<div id='directions'>
<div id='routes'></div>
<div id='instructions'></div>
 
<script type="text/javascript">
	L.mapbox.accessToken = 'pk.eyJ1IjoiYmV5b25kY2hhbiIsImEiOiJja25kZXA5ZGQxZjdqMm9tbGptZG51eXJmIn0.hgfPQNXUpp0LRGKkztoA5A';
	var map = L.mapbox.map('map', null, {zoomControl: false})
		.setView([-7.983908, 112.621391], 15)
		.addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

	var myLayer = L.mapbox.featureLayer()
	  .loadURL('bengkel.geojson')
	  .on('ready', function() {
	    myLayer.eachLayer(function(layer) {
	      map.fitBounds(myLayer.getBounds());
	      var content = '<p><strong>' + layer.feature.properties.Name + '</strong></p>' + 
	      '<p><h1>' + layer.feature.properties.Address + '</h1></p>' + 
	      '<p><h4>' + layer.feature.properties['Phone Number'] + '</h4></p>' + 
	      '<p><h4>' + layer.feature.properties.website + '</h4></p>';
	      layer.bindPopup(content);
    });
  })
  .addTo(map);

map.attributionControl.setPosition('bottomleft');


var directions = L.mapbox.directions();

var directionsLayer = L.mapbox.directions.layer(directions)
    .addTo(map);

var directionsInputControl = L.mapbox.directions.inputControl('inputs', directions)
    .addTo(map);

var directionsErrorsControl = L.mapbox.directions.errorsControl('errors', directions)
    .addTo(map);

var directionsRoutesControl = L.mapbox.directions.routesControl('routes', directions)
    .addTo(map);

var directionsInstructionsControl = L.mapbox.directions.instructionsControl('instructions', directions)
    .addTo(map);
    
</script>
 
</body>
</html>