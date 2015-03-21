var expMap;
function initialize() {
	var myOptions = {
	zoom: 16,
	center: new google.maps.LatLng(51.5172,-0.1426),
	mapTypeId: google.maps.MapTypeId.ROADMAP,
	disableDefaultUI: true,
	styles: [
		{"stylers":[{"visibility": "off" }]},
		{"featureType": "road", "stylers": [{ "visibility": "on" }]},
		{"featureType": "transit.station", "stylers": [{ "visibility": "on" }]},
		{"featureType": "road", "elementType": "geometry.fill", "stylers": [{ "color": "#a5a5a5" }, { "visibility": "off" }]},
		{"featureType": "landscape", "stylers": [{ "visibility": "on" }, { "color": "#4b4b50" }]},
		{"featureType": "transit.line", "stylers": [{ "visibility": "off" }]},
		{"featureType": "road", "stylers": [{ "color": "#818185" }]},
		{"featureType": "road", "elementType": "labels.text", "stylers": [{ "visibility": "on" }, { "invert_lightness": true }, { "weight": 0.4 }, { "color": "#ffffff" }]},
		{"featureType":"water","stylers":[{ "visibility": "on" }, {"hue":"#00B6FF"}, {"saturation":4.2}, {"lightness":-63.4}, {"gamma":1}]},
		{"featureType":"poi","stylers":[{ "visibility": "off" }]}
	]
	};
	
	expMap = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	var image = (carawebsMapVars.markerImage);
	var myLatLng = new google.maps.LatLng(51.5172,-0.1426);
	var expMarker = new google.maps.Marker({
	position: myLatLng,
	map: expMap,
	icon: image
	});
	}
	
google.maps.event.addDomListener(window, "load", initialize);
google.maps.event.addDomListener(window, "resize", function() {
	var center = expMap.getCenter();
	google.maps.event.trigger(expMap, "resize");
	expMap.setCenter(center); 
});
