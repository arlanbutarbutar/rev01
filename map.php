<?php
if (!isset($_SESSION[""])) {
  session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
include 'superadmin/konektor.php';

$lokasi_bengkel = "SELECT * FROM lokasi_bengkel JOIN bengkel ON lokasi_bengkel.id_bengkel=bengkel.id_bengkel";
$data_lb = mysqli_query($konektor, $lokasi_bengkel);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Peta Dijkstra</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- Include peta Leaflet (JavaScript) -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
  <!-- Include Leaflet Routing Machine -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
</head>

<body>
  <!-- Tampilkan peta dengan ID 'map' -->
  <div id="map" style="height: 85vh;"></div>

  <div class="wrapper">
    <div class="container">
      <div class="row flex-row-reverse m-5">
        <div class="col-lg-7">
          <p id="shortestPath" class="mt-3 font-weight-bold">Jarak: -</p>
          <button id="findRouteButton" class="btn btn-primary btn-sm shadow border-0 mb-5">Temukan Rute Terdekat</button>
          <a href="./" class="btn btn-primary btn-sm shadow border-0 mb-5">Kembali</a>
        </div>
        <div class="col-lg-5">
          <h5 class="font-weight-bold">Hasil
            <span data-toggle="tooltip" data-placement="right" title="Hasil pencarian rute terdekat yang direkomendasikan">
              <i class="bi bi-info-circle" style="font-size: 16px;"></i>
            </span>
          </h5>
          <div class="row" id="recommendedLocations">
            <!-- Kartu-kartu lokasi akan ditampilkan di sini -->
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
    // Inisialisasi peta
    var map = L.map('map').setView([-10.1653394, 123.6243154], 14);

    // Tambahkan peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Tambahkan marker untuk setiap titik koordinat
    var markers = [
      <?php foreach ($data_lb as $rowLB) { ?>
        L.marker([<?= $rowLB['latitude'] ?>, <?= $rowLB['longitude'] ?>]).bindPopup('<?= $rowLB['nama_lokasi'] ?>'),
      <?php } ?>
    ];

    var group = L.layerGroup(markers).addTo(map);

    // Titik awal dan akhir yang akan digunakan untuk rute
    var start = null;
    var end = null;

    // Kirim data titik koordinat ke JavaScript
    var coordinates = [
      <?php foreach ($data_lb as $rowLB) { ?> {
          name: '<?= $rowLB['nama_lokasi'] ?>',
          nama_pemilik: '<?= $rowLB['nama_pemilik'] ?>',
          no_hp: '<?= $rowLB['no_hp'] ?>',
          alamat: '<?= $rowLB['alamat'] ?>',
          jam_buka: '<?= $rowLB['jam_buka'] ?>',
          jam_tutup: '<?= $rowLB['jam_tutup'] ?>',
          lat: <?= $rowLB['latitude'] ?>,
          lon: <?= $rowLB['longitude'] ?>
        },
      <?php } ?>
    ];

    // Fungsi untuk mendapatkan lokasi pengguna
    function getMyLocation() {
      if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var lat = position.coords.latitude;
          var lon = position.coords.longitude;

          // Tampilkan lokasi pengguna pada peta dengan ikon gambar
          var myLocationMarker = L.marker([lat, lon], {
            icon: L.icon({
              iconUrl: 'placeholder.png', // Ganti dengan path ke gambar Anda
              iconSize: [40, 45], // Sesuaikan ukuran ikon
              iconAnchor: [12, 41], // Sesuaikan posisi anchor ikon
            })
          }).addTo(map);

          // Tampilkan informasi lokasi pengguna pada elemen HTML
          document.getElementById("myLocation").textContent = "Lat: " + lat + ", Lon: " + lon;

          // Set tampilan peta untuk menampilkan lokasi pengguna
          map.setView([lat, lon], 13);

          // Set lokasi awal untuk rute
          start = L.latLng(lat, lon);
        });
      } else {
        console.log("Geolokasi tidak didukung di browser ini.");
      }
    }

    // Fungsi untuk menghitung jarak antara dua titik koordinat
    function calculateDistance(lat1, lon1, lat2, lon2) {
      var radlat1 = Math.PI * lat1 / 180;
      var radlat2 = Math.PI * lat2 / 180;
      var theta = lon1 - lon2;
      var radtheta = Math.PI * theta / 180;
      var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
      dist = Math.acos(dist);
      dist = dist * 180 / Math.PI;
      dist = dist * 60 * 1.1515;
      dist = dist * 1.609344; // Dalam kilometer
      return dist;
    }

    // Fungsi untuk menghitung jalur terpendek dan menampilkan jarak
    function calculateShortestPath(startLatLng, endLatLng) {
      // Inisialisasi peta rute
      var routingControl = L.Routing.control({
        waypoints: [startLatLng, endLatLng],
        routeWhileDragging: true
      }).addTo(map);

      // Hitung jalur terpendek dan tampilkan jarak
      routingControl.on('routesfound', function(e) {
        var routes = e.routes;
        if (routes.length > 0) {
          var shortestRoute = routes[0];
          var distanceInMeters = shortestRoute.summary.totalDistance;
          document.getElementById("shortestPath").textContent = "Jarak: " + distanceInMeters + " meter.";
        }
      });
    }

    var recommendedLocations = []; // Definisikan di luar fungsi untuk menjaga data

    // Fungsi untuk mencari bengkel terdekat
    function findNearestWorkshop() {
      if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var userLat = position.coords.latitude;
          var userLon = position.coords.longitude;
          var nearestWorkshops = []; // Array untuk menyimpan semua lokasi terdekat

          // Iterasi melalui data bengkel untuk mencari yang terdekat
          coordinates.forEach(function(workshop) {
            var workshopLat = workshop.lat;
            var workshopLon = workshop.lon;
            var distance = calculateDistance(userLat, userLon, workshopLat, workshopLon);
            workshop.distance = distance; // Menambahkan jarak ke setiap lokasi

            nearestWorkshops.push(workshop);
          });

          // Urutkan lokasi terdekat berdasarkan jarak
          nearestWorkshops.sort(function(a, b) {
            return a.distance - b.distance;
          });

          // Set lokasi awal untuk rute
          start = L.latLng(userLat, userLon);
          end = L.latLng(nearestWorkshops[0].lat, nearestWorkshops[0].lon);

          // Tampilkan rute ke bengkel terdekat
          calculateShortestPath(start, end);

          // Simpan semua lokasi hasil rute terdekat ke dalam array
          recommendedLocations = nearestWorkshops;

          // Tampilkan lokasi hasil rute terdekat dalam kartu
          displayRecommendedLocations(recommendedLocations);
        });
      } else {
        console.log("Geolokasi tidak didukung di browser ini.");
      }
    }

    // Fungsi untuk menampilkan lokasi hasil rute terdekat dalam kartu-kartu
    function displayRecommendedLocations(locations) {
      var locationsContainer = document.getElementById("recommendedLocations");

      // Bersihkan kontainer lokasi sebelum menambahkan yang baru
      locationsContainer.innerHTML = "";

      // Tampilkan semua lokasi hasil rute terdekat dalam kartu-kartu
      locations.forEach(function(location) {
        var cardHTML = `
      <div class="col-md-12">
        <div class="card mb-3 shadow border-0" style="width: 100%;">
          <div class="row">
            <div class="col-lg-8">
              <div class="card-body">
                <h5 class="card-title">${location.name}</h5>
                <p class="card-text mb-n1">Pemilik: ${location.nama_pemilik}</p>
                <p class="card-text mb-n1">No. Telp: ${location.no_hp}</p>
                <p class="card-text mb-n1">Alamat: ${location.alamat}</p>
                <p class="card-text mb-n1">Jam Kerja: ${location.jam_buka} - ${location.jam_tutup}</p>
              </div>
            </div>
            <div class="col-lg-4 text-center m-auto">
              <a href="https://www.google.com/maps/place/${location.lat}, ${location.lon}" class="btn btn-outline-primary rounded-circle" target="_blank"><i class="bi bi-sign-turn-right"></i></a>
              <p class="font-weight-bold">Rute</p>
            </div>
          </div>
        </div>
      </div>
    `;

        // Tambahkan kartu lokasi ke kontainer
        locationsContainer.innerHTML += cardHTML;
      });
    }

    // Panggil fungsi untuk mendapatkan lokasi pengguna
    getMyLocation();

    // Panggil fungsi untuk mencari bengkel terdekat
    document.getElementById("findRouteButton").addEventListener("click", function() {
      findNearestWorkshop();
    });
  </script>
  <script>
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
</body>

</html>