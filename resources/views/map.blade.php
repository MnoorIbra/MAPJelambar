@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Peta Persebaran Mesin EDC</h2>
    
    <div id="map" style="height: 600px; width: 100%;"></div>
</div>

@section('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Default center on Indonesia
        const map = L.map('map').setView([-2.5489, 118.0149], 5);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Add markers for each EDC machine
        @foreach($machines as $machine)
            const marker{{ $machine->id }} = L.marker([{{ $machine->latitude }}, {{ $machine->longitude }}]).addTo(map)
                .bindPopup(`
                    <b>{{ $machine->name }}</b><br>
                    SN: {{ $machine->serial_number }}<br>
                    Alamat: {{ $machine->address }}<br>
                    Status: {{ ucfirst($machine->status) }}
                `);
                
            @if($machine->status == 'active')
                marker{{ $machine->id }}.setIcon(L.icon({
                    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                }));
            @elseif($machine->status == 'maintenance')
                marker{{ $machine->id }}.setIcon(L.icon({
                    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-orange.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                }));
            @else
                marker{{ $machine->id }}.setIcon(L.icon({
                    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                }));
            @endif
        @endforeach
        
        // Add button to add new machine
        const addButton = L.easyButton({
            position: 'topright',
            leafletClasses: true,
            states: [{
                stateName: 'add-machine',
                icon: 'fa-plus',
                title: 'Tambah Mesin Baru',
                onClick: function(btn, map) {
                    window.location.href = "{{ route('edc-machines.create') }}";
                }
            }]
        }).addTo(map);
    });
</script>
@endsection
@endsection