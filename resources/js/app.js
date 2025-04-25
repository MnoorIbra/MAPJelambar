<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDC Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <style>
        #map { height: 500px; }
    </style>
</head>
<body>
    <div id="map"></div>

    <script>
        // Initialize the map
        var map = L.map('map').setView([-6.2088, 106.8456], 13); // Centered on Jakarta, Indonesia, with zoom level 13

        // Add a tile layer (you can use other providers like Mapbox, etc.)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Add a marker to the map
        var marker = L.marker([-6.2088, 106.8456]).addTo(map);
    </script>
</body>
</html>
