@extends('layouts.app')
@section('content')
<div class="container">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <a href="{{ route('edc-machines.index') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        #map {
            height: 300px;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
             <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by name...">
        </div>
    </div>

     <div class="row">
        <div class="col-md-6">
             <div id="map"></div>
        </div>
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($edcMachines as $machine)
                        <tr>
                            <td class="machine-name" data-latitude="{{ $machine->latitude }}" data-longitude="{{ $machine->longitude }}">
                                {{ $machine->name }}
                            </td>
                            <td>{{ $machine->latitude }}</td>
                            <td>{{ $machine->longitude }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
    <script>
         document.getElementById('searchInput').addEventListener('keyup', function() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        });
        document.addEventListener('DOMContentLoaded', function () {

            if(!L.DomUtil.get('map')._leaflet_map){
            // Initialize the map
                var map = L.map('map').setView([-6.1542, 106.7917], 15); // Default view (Jelambar)

            // Add a tile layer (you can change the provider)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            @foreach($edcMachines as $machine)
                var markerColor = "{{ $machine->status }}" === 'already exist' ? 'blue' : 'red';
                var markerIcon = L.icon({
                iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-' + markerColor + '.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],});
            var marker = L.marker([{{ $machine->latitude }}, {{ $machine->longitude }}],{icon: markerIcon}).addTo(map);
            marker.bindPopup(`
                <b>{{ $machine->name }}</b><br>
                Status: {{ $machine->status == 'already exist' ? 'Sudah Ada' : 'Belum Ada' }}<br>
                Serial Number: {{ $machine->serial_number }}<br>
                Address: {{ $machine->address }}`);
            @endforeach

            // Event delegation for clicking on machine names
            document.querySelector('table tbody').addEventListener('click', function(event) {
                if (event.target.classList.contains('machine-name')) {
                    var latitude = event.target.dataset.latitude;
                    var longitude = event.target.dataset.longitude;
                    map.setView([latitude, longitude], 17);
                }
            });
        }
        });

    </script>
</div>
@endsection

