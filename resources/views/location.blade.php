<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        let map; // Global variable for map instance

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0
                });
            } else {
                document.getElementById("address").innerText = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            let latitude = position.coords.latitude.toFixed(6);
            let longitude = position.coords.longitude.toFixed(6);

            document.getElementById("coords").innerText = `Latitude: ${latitude}, Longitude: ${longitude}`;

            // Initialize or update the map at the user location
            if (!map) {
                map = L.map('map').setView([latitude, longitude], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
            } else {
                map.setView([latitude, longitude], 15);
            }

            // Add marker with popup
            let marker = L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Fetching address...')
                .openPopup();

            // Fetch address from OpenStreetMap Nominatim API
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`)
                .then(response => response.json())
                .then(data => {
                    let address = data.display_name;
                    document.getElementById("address").innerText = `Address: ${address}`;
                    marker.bindPopup(address).openPopup();
                })
                .catch(error => {
                    console.error("Error fetching address:", error);
                    document.getElementById("address").innerText = "Could not fetch address.";
                });
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    document.getElementById("address").innerText = "User denied the request for Geolocation.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    document.getElementById("address").innerText = "Location information is unavailable.";
                    break;
                case error.TIMEOUT:
                    document.getElementById("address").innerText = "The request to get user location timed out.";
                    break;
                case error.UNKNOWN_ERROR:
                    document.getElementById("address").innerText = "An unknown error occurred.";
                    break;
            }
        }
    </script>
</head>
<body>
    <h2>User Location</h2>
    <button onclick="getLocation()">Get My Address</button>
    <p id="coords"></p>
    <p id="address"></p>
    <div id="map" style="width: 100%; height: 400px;"></div>
</body>
</html>