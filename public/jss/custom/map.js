function initMap() {
         map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: {lat: -34.397, lng: 150.644}
        });

        var infowindow = new google.maps.InfoWindow();        
        var geocoder = new google.maps.Geocoder();
        
            google.maps.event.trigger(map, 'onload');
        

        geocodeAddress(geocoder,map,infowindow);
      }

    function geocodeAddress(geocoder, resultsMap,infowindow) {
        
        var address = document.getElementById('address').textContent;
        var company_name = document.getElementById('company_name').textContent;
        //var description = document.getElementById('Description').children[1].textContent
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });

                infowindow.setContent(company_name+" "+address);
                 marker.addListener('click', function(resultsMap) {
                    infowindow.open(resultsMap, marker);
                });

            } else {
                //alert('Address of Company cannot be verified ' + status);
            }
        });
    }