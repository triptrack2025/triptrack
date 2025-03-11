<!DOCTYPE html>
<html>
<head>
<title>HTML Geolocation with Google Maps</title>
<style>
  #map {
    height: 400px;
    width: 100%;
    margin-top: 20px;
  }
</style>
</head>
<body>
<h1>HTML Geolocation with Google Maps</h1>
<p>Click the button to get your coordinates and view location on map.</p>
<button onclick="getLocation()">Try It</button>
<p id="demo"></p>
<div id="map"></div>

<script>
  const x = document.getElementById("demo");
  let map;

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }

  function showPosition(position) {
    const lat = position.coords.latitude;
    const lng = position.coords.longitude;
    x.innerHTML = `Latitude: ${lat} <br>Longitude: ${lng}`;

    const location = { lat: lat, lng: lng };
    map = new google.maps.Map(document.getElementById("map"), {
      center: location,
      zoom: 17
    });
  
    new google.maps.Marker({
      position: location,
      map: map,
      title: "You are here!"
    });
  }

  function showError(error) {
    switch(error.code) {
      case error.PERMISSION_DENIED:
        x.innerHTML = "User denied the request for Geolocation.";
        break;
      case error.POSITION_UNAVAILABLE:
        x.innerHTML = "Location information is unavailable.";
        break;
      case error.TIMEOUT:
        x.innerHTML = "The request to get user location timed out.";
        break;
      case error.UNKNOWN_ERROR:
        x.innerHTML = "An unknown error occurred.";
        break;
    }
  }

  window.onload = function() {
    const script = document.createElement("script");
    script.src = "https://maps.googleapis.com/maps/api/js";
    document.head.appendChild(script);
  };
</script>
</body>
</html>