var map = document.getElementById('map');
map = L.map(map);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

fetch('/api/get-data/polygon')
    .then(response => response.json())
    .then(datas => {
        var latlngs = datas.map(data => [data.koordinat_polygon.map(koor => [koor.latitude, koor.longitude])]);
        var polygon = L.polygon(latlngs).addTo(map);
        map.fitBounds(polygon.getBounds());
    });
