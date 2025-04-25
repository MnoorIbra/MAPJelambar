import 'leaflet/dist/leaflet.css';
import L from 'leaflet';

const style = document.createElement('style');
style.innerHTML = `#map { height: 500px; }`;
document.head.appendChild(style);

const map = L.map('map').setView([-6.2088, 106.8456], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);

L.marker([-6.2088, 106.8456]).addTo(map);