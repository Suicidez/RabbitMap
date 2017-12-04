<html>
    <head>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
             <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.25.3/js/jquery.tablesorter.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
          <script src="https://maps.googleapis.com/maps/api/js"></script>
  
         <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLgg33j0aex_RlorVdPmHAA2pofYf_hbs&callback=initMap&libraries=places,visualization">
    </script>
        <style>
            #map-canvas{
                width : 100%;
                height: 100%;
            }
              .phoney {
        background: -webkit-gradient(linear,left top,left bottom,color-stop(0, rgb(112,112,112)),color-stop(0.51, rgb(94,94,94)),color-stop(0.52, rgb(57,57,57)));
        background: -moz-linear-gradient(center top,rgb(112,112,112) 0%,rgb(94,94,94) 51%,rgb(57,57,57) 52%);
      }
      .phoneytext {
        text-shadow: 0 -1px 0 #000;
        color: #fff;
        font-family: Helvetica Neue, Helvetica, arial;
        font-size: 16px;
        line-height: 25px;
        padding: 4px 45px 4px 15px;
        font-weight: bold;
        background: url(../images/arrow.png) 95% 50% no-repeat;
      }
      .phoneytab {
        text-shadow: 0 -1px 0 #000;
        color: #fff;
        font-family: Helvetica Neue, Helvetica, arial;
        font-size: 18px;
        background: rgb(112,112,112) !important;
      }
        </style>
        <title>@yield('title')</title>
    </head>
  <div class="container">
          <div class="col-md-12">
  
          <div class="form-group">
      
              <div class="col-md-12" style="text-align: center">
                  <label for="" style="margin : 0 auto;">Map</label>   
              </div>
              <br>
                <div class="col-md-10"> 
                    
                    
                    <input type="text" id="searchmap" class="form-control "> 
                </div>
               
              <div class="col-md-2">      <button class="btn btn-primary form-control" onclick="SearchClick()">Search</button> </div>
                
                <br>
              <div class="col-md-12"style="height : 800px;">
                    <div id="map-canvas"></div>
              </div>
          </div>
     
        
      </div>
     
      
</div>
       
</body>
<script>
 
</script>
<script>
      var map;
      var infoWindow;
      var service;
      var locations;
      var searchBox;
      var marker;
      var markerCur;
      var markers = [];
     var Curlat,Curlng;



 
      function initMap() {
 
 map = new google.maps.Map(document.getElementById('map-canvas'),{
    center:{
    },zoom:15,
          styles: [{
            stylers: [{ visibility: 'simplified' }]
          }, {
            elementType: 'labels'
          }]
    
});

  navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            
            }


        
        map.setCenter(new google.maps.LatLng(pos['lat'],pos['lng']) );

      markerCur = new google.maps.Marker({
          map: map,
          position: pos,
        });
               Curlat = pos['lat'];
               Curlng = pos['lng'];
         
        });
        

        
    
        service = new google.maps.places.PlacesService(map);
        map.addListener('idle', performSearch);
            
      searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));



// var markerCluster = new MarkerClusterer(map, markers,
//            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
// 
//   var request = {
//    location: map.getCenter(),
//    radius: '500',
//    query: 'Google Sydney'
//  };
//  
}


            
            
             function performSearch() {
        var request = {
          bounds: map.getBounds(),
          keyword: 'best view'
        };
        
        service.radarSearch(request, callback);
      }

      function callback(results, status) {
        if (status !== google.maps.places.PlacesServiceStatus.OK) {
          console.error(status);
          return;
        }

      @if (!empty($statused))
           @foreach ($statused as $value)
                  @if (empty($value->place))
                       @continue
                   @endif
                 
       
               addMarker({{ $value->place->bounding_box->coordinates[0][2][1] }} ,{{ $value->place->bounding_box->coordinates[0][2][0] }},"{{ $value->user->profile_image_url }}",markerCur.getPosition().lat(),markerCur.getPosition().lng(),{{ $value->id }})
               
           @endforeach
       @endif    
       
      }
 
 
 function SearchClick()
 {

    var places = searchBox.getPlaces();
    var bounds = new google.maps.LatLngBounds();
    var i,place;
 
    for(i=0;place=places[i];i++)
    {
        bounds.extend(place.geometry.location);
        markerCur.setPosition(place.geometry.location);
       
    }

    Curlat = markerCur.getPosition().lat();
    Curlng = markerCur.getPosition().lng();
  
    map.fitBounds(bounds);
    map.setZoom(15);
    
    
   setMapOnAll(null);
   markers = [];
   
   alert("1");
 }
   
 function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

 function addMarker(latti,lngti,profile_image,Curlat,Curlng,id) {

var KM = 0;
       $.ajax({
       type: "get",
       url: "CheckRad",
       dataType : "html",
       data: {lat1 : Curlat,lon1 : Curlng,lat2 : latti,lon2 : lngti,unit : "K"},
       success: function (data, textStatus, jqXHR) {
       
          KM = data;
        }
    });
    alert("2")
    if (KM <= 50)
    {
  marker = new google.maps.Marker({
                  map: map,
                  position: {lat:latti , lng:lngti},
                  title: id,
                  icon: {
                    url: profile_image,
                    anchor: new google.maps.Point(10, 10),
                    scaledSize: new google.maps.Size(50, 50)
                  }
                });     
                markers.push(marker);
     }
google.maps.event.addListener(searchBox,'places_changed',function(){
   
  
});
    google.maps.event.addListener(marker,'position_changed',function(){
  
  
});
    
    
        google.maps.event.addListener(marker, 'click', function() {
   
         @if (!empty($statused))
           @foreach ($statused as $value)
                  @if (empty($value->place))
                       @continue
                   @endif
 
 
             if ("{{ $value->id }}" == id)
             {  
      marker = new google.maps.Marker({
          map: map,
          position: {lat:latti , lng:lngti},
            title:"",
          icon: {
            url: '',
          }
        });
           
   
            infoWindow = new google.maps.InfoWindow();
        
            infoWindow.setContent("<div>{{ $value->text }} <br>  When {{ $value->created_at }}</div>");
            infoWindow.open(map, marker);
               
            }
   
      
          
      
           @endforeach
       @endif    
       
          
        });
        
 }
      
//    
//    google.maps.event.addListener(searchBox,'places_changed',function(){
//        var places = searchBox.getPlaces();
//        var bounds = new google.maps.LatlngBounds();
//        var i,place;
//        for(i=0;place=places[i];i++)
//        {
//            bounds.extend(place.geometry.location);
//            maker.SetPosition(place.geometry.location);
//        }
//        map.fitBounds(bounds);
//        
//        
//    });
 
 
    
 
</script>
</html>
