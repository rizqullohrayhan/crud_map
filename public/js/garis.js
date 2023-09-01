var map = document.getElementById('map');
map = L.map(map);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

function degrees_to_radians(degrees) {
    return degrees * (Math.PI / 180);
}

fetch('api/get-data/garis')
    .then(response => response.json())
    .then(data => { 
        var latlong = data.map(koor => [[koor.lat_awal, koor.long_awal], [koor.lat_akhir, koor.long_akhir]]);
        var polyline = L.polyline(latlong, {color: 'red'}).addTo(map);
        map.fitBounds(polyline.getBounds());
    });
