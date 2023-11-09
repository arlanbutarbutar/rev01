<?php if (!isset($_SESSION[""])) {
   session_start();
}
if (isset($_SESSION['data-user'])) {
   header("Location: superadmin/");
   exit();
} ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Geocoding Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
      function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            savePosition,
            positionError,
            { timeout: 10000 }
          );
        } else {
          //Geolocation is not supported by this browser
        }
      }

      // handle the error here
      function positionError(error) {
        var errorCode = error.code;
        var message = error.message;

        alert(message);
      }

      function savePosition(position) {
        document.getElementById("lat").innerHTML = position.coords.latitude;
        document.getElementById("long").innerHTML = position.coords.longtitude;
      }
    </script>
  </head>
  <body>
    <button onclick="getLocation();">Get My Location</button>
    <span id="lat"></span>
    <span id="long"></span>
  </body>
</html>
