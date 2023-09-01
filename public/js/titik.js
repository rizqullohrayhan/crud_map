// Map Leaflet
var map = document.getElementById('map');
map = L.map(map);

map.locate({setView: true, maxZoom: 16});

let tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

function onLocationFound(e) {
    var radius = e.accuracy;

    L.marker(e.latlng).addTo(map)
        .bindPopup("You are within " + radius + " meters from this point").openPopup();

    L.circle(e.latlng, radius).addTo(map);
}

map.on('locationfound', onLocationFound);

// Menampilkan marker berdasarkan koordinat dari database
fetch('/api/get-data/titik')
    .then(response => response.json())
    .then(koordinat => {
        koordinat.forEach(data => {
            L.marker([data.latitude, data.longitude])
                .addTo(map)
                .bindPopup(data.keterangan);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

map.on('click', function(e) {
    document.getElementById('latitude').value = e.latlng.lat;
    document.getElementById('longitude').value = e.latlng.lng;
});