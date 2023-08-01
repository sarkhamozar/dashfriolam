<div class="row g-3">
    <div class="form-group col-12">
        <div style="height: 480px;background:transparent;">
          <div class="d-flex align-items-center">
              <div>
                  <h6 class="mb-0">Ruta del servicio</h6>
              </div>
          </div>
          <div id="map" style="width:100%;height:450px;"></div>
        </div>
    </div>
</div>

<script>
  let lat = 0;
  let lng = 0;
  var map; 
  var geocoder;
  var marker_origin;
  var marker_destin;
  let init_service = ("{{$data->id}}") ? true : false;

  function initMap() {  
    
    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer();

    navigator.geolocation.getCurrentPosition((position) => {
          lat = position.coords.latitude;
          lng = position.coords.longitude;
         
          map = new google.maps.Map(document.getElementById('map'),{
                    center: {lat: lat, lng: lng},
                    zoom: 14,
                    disableDefaultUI: true
          });
 
          if (init_service) {
            directionsRenderer.setMap(map);
            calculateAndDisplayRoute(directionsService, directionsRenderer);
          }else {
            marker_destin = new google.maps.Marker({
              position: {lat: lat, lng: lng},
              map: map,
              draggable:true,
              icon: {
                min: 2, 
                max: 100, url: "https://dash.soypideme.com/assets/img/icons/point_b.png", 
                anchor: {x: 16, y: 16}
              }
            });  

            marker_origin = new google.maps.Marker({
              position: {lat: lat, lng: lng},
              map: map,
              draggable:true,
              icon: {
                min: 2, 
                max: 100, url: "https://dash.soypideme.com/assets/img/icons/point_a.png", 
                anchor: {x: 16, y: 16}
              },
            });

            marker_origin.addListener('dragend', function(evt) {
              GetAddressToCoords(evt.latLng.lat(),evt.latLng.lng(), function(req) {
                if (req != 'fail') {
                  document.getElementById('address_origin').value = req;
                  document.getElementById('lat_orig').value =  marker_origin.position.lat();
                  document.getElementById('lng_orig').value = marker_origin.position.lng();
                }
              });
            });

            marker_destin.addListener('dragend', function(evt) {
              GetAddressToCoords(evt.latLng.lat(),evt.latLng.lng(), function(req) {
                if (req != 'fail') {
                  document.getElementById('address_destin').value = req;
                  document.getElementById('lat_dest').value = marker_destin.position.lat();
                  document.getElementById('lng_dest').value = marker_destin.position.lng();
                }
              });
            }); 
          } 
      },() => {
        handleLocationError(true, infoWindow, map.getCenter());
    });  
  }

  function calculateAndDisplayRoute(directionsService, directionsRenderer) {
    directionsService
    .route({
      origin: {
        query: document.getElementById("address_origin").value,
      },
      destination: {
        query: document.getElementById("address_destin").value,
      },
      travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
      directionsRenderer.setDirections(response);
    })
    .catch((e) => console.log("Directions request failed due to ", status));
  }

  function GetAddressToCoords(lat,lng,callback)
  { 
    const latLng = {
      lat: parseFloat(lat),
      lng: parseFloat(lng),
    };

    var geocoder = new google.maps.Geocoder;

    geocoder.geocode({location: latLng }, (results, status)=> {
      if(status == "OK"){
        if(results[0]){ 
          callback(results[0].formatted_address)
        } else{
          callback("fail");
        }
      } else{
        callback("fail");
      }
    });
  }  
 
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{$admin->ApiKey_google}}&libraries=places&callback=initMap"></script>
