// https://raw.githubusercontent.com/kiang/pharmacies/master/json/points.json
document.getElementById('mapid').style.width = window.innerWidth + 'px';
document.getElementById('mapid').style.height = window.innerHeight + 'px';

var map = L.map('mapid').setView([25.021274, 121.55643], 15);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://mapbox.com">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiYmJyb29rMTU0IiwiYSI6ImNpcXN3dnJrdDAwMGNmd250bjhvZXpnbWsifQ.Nf9Zkfchos577IanoKMoYQ'
}).addTo(map);

var markers = L.markerClusterGroup();
reloadData();

function reloadData() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '../static/pharmacy/mask-stock.json');
    xhr.send();
    xhr.onload = function () {
        let data = JSON.parse(xhr.responseText);
        let length = Object.keys(data).length;

        const markerHtmlStyles = `
  width: 3rem;
  height: 3rem;
  display: block;
  left: -1.5rem;
  top: -1.5rem;
  position: relative;
  border-radius: 3rem 3rem 0;
  transform: rotate(45deg);
  border: 1px solid #FFFFFF`

        for (let i = 1; i < length; i++) {
            let store = data[i];
            let coordinates = store['geometry']['coordinates'];

            if (!coordinates) {
                continue;
            }
            let name = store[1];
            let address = store[2];
            let phone = store[3];
            let adult = store[4];
            let child = store[5];
            let updatedAt = store[6];
            let color;

            if (adult + child == 0) {
                color = 'red';
            } else if (adult == 0) {
                color = 'yellow';
            } else {
                color = '#7FFF00'; // green
            }

            let icon = L.divIcon({
                className: "my-custom-pin",
                iconAnchor: [0, 24],
                labelAnchor: [-6, 0],
                popupAnchor: [0, -36],
                html: `<span style="${markerHtmlStyles}; background-color: ${color};"></span>
            <span style="color: blue; top: -1rem; right: -0.2rem; position: absolute">成:${adult}</span>
            <span style="color: blue; top: 0.5rem; right: -0.2rem; position: absolute">孩:${child}</span>
            `
            })
            let marker = L.marker([coordinates[1], coordinates[0]], { icon: icon });

            marker.bindPopup(`
        <b>藥局: ${name}</b>
        </br>
        <b>地址: ${address}</b>
        </br>
        </br>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">電話</th>
                <th scope="col">成人</th>
                <th scope="col">小孩</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>${phone}</td>
                <td>${adult}</td>
                <td>${child}</td>
            </tr>
            </tbody>
        </table>
        <p>更新時間: ${updatedAt}</p>
      `).openPopup();

            markers.addLayer(marker);
        }
    }

    map.addLayer(markers);
}

// reload every 10 minutes
setInterval(function () {
    markers.clearLayers();
    reloadData();
}, 10 * 60)

var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
};

function success(pos) {
    var crd = pos.coords;
    map.setView([crd.latitude, crd.longitude], 15);
    let marker = L.marker([crd.latitude, crd.longitude]).bindPopup('當前位置')
    map.addLayer(marker);
}

function error(err) {
    alert('無法取得當前位置');
    console.warn(`ERROR(${err.code}): ${err.message}`);
}

navigator.geolocation.getCurrentPosition(success, error, options);