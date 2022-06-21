<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Get Current Location Google Maps Api PHP</title>
    </head>
    <body>
        <h2>Get Current Location Google Maps Api php</h2>
       
        <div class="text-center">
                            <a href="{{url('c')}}"> <button  type="submit" class="btn btn-primary">
                                       RESET 
                                   
                                </button>
                                </a>
                            </div>
        <div id="myMap" style="width:100%;height:500px;"></div>
        
        <script>
        let map, infoWindow;
        function initMap() {
          map = new google.maps.Map(document.getElementById("myMap"), {
            center: { lat: -8.4845011, lng:114.3281116},
            zoom: 7,
          });
          infoWindow = new google.maps.InfoWindow();
          const locationButton = document.createElement("button");
          locationButton.textContent = "Cari Lokasi anda saat ini";
          locationButton.classList.add("custom-map-control-button");
          map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
          locationButton.addEventListener("click", () => {
            // Try HTML5 geolocation.
        
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(
               
                
                (position) => {
                  const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                  };

                  console.log(position),
                  infoWindow.setPosition(pos);
                  map = new google.maps.Map(document.getElementById("myMap"), {
                    center: { lat: -8.4845011, lng:114.3281116},
                    zoom: 12,
                });
                
                
                  infoWindow.setContent("Lokasi Anda Saat Ini");
                  infoWindow.open(map);
                  map.setCenter(pos);
                },
                () => {
                  handleLocationError(true, infoWindow, map.getCenter());
                }
              );
            } else {
              // Browser doesn't support Geolocation
              handleLocationError(false, infoWindow, map.getCenter());
            }
          });
        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
          infoWindow.setPosition(pos);
          infoWindow.setContent(
            browserHasGeolocation
              ? "Error: The Geolocation service failed."
              : "Error: Your browser doesn't support geolocation."
          );
          infoWindow.open(map);
        }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkdyai5-p_kXTroX-gSz_mz-xeQ8Ht1iY&callback=initMap"></script>
    </body>
</html>