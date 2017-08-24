
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

     var componentForm = {

        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        
      };

	function initAutoComplete(){

		var options = {
						componentRestrictions: {country: 'ng'}
					};

		var autocompleteInput = document.getElementById('pac-input');
		var autocomplete2 = document.getElementById('browse-input');
		//map.controls[google.maps.ControlPosition.TOP_RIGHT].push(autocompleteInput);
		var autocomplete = new google.maps.places.Autocomplete(autocompleteInput,options);
		autocomplete.addListener('place_changed',function(){
			var place = autocomplete.getPlace();
			console.log(place.address_components);
            fillInAddress(autocomplete);
		})

		// var auto = new google.maps.places.Autocomplete(autocomplete2,options);
		// auto.addListener('place_changed',function(){
		// 	var place = auto.getPlace();
		// 	console.log(place.address_components);
    //         fillInAddress(auto);
		// })
	}
	/***End of Google Map and Autocomplete */


      function fillInAddress(autocomplete) {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();


        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
            
          }
        }
      }
