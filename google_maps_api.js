	var user_lat;
	var user_lon;
	var destination_AddressKey = 0;
	var site_AddressKey = 0;
	
	function preinit(addressToPersonKey) {
		destination_AddressKey = addressToPersonKey;
		initMap();
		
	}
	
	function initMap() {
		if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			} else { 
				alert("Geolocation is not supported by this browser.");
			}
	}
	
	function showPosition(position) {
		user_lat = position.coords.latitude;
		user_lon = position.coords.longitude;
		createMap();
		//calculateRoute();
		//alert("lat:" + user_lat + " lon:" + user_lon);
	}

	function createMap(addressToPerson) {
		var destinationlocation = inputData[destination_AddressKey].address;
		var userlocation = {lat: user_lat, lng: user_lon};
		//Spoof user location for Demo  38.6324350,-90.2268072
		//var userlocation = {lat: 38.6324350, lng: -90.2268072};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: userlocation
		  //center: userlocation
        });
        //var marker = new google.maps.Marker({
        //  position: destinationlocation,
        //  map: map,
		//  icon: 'Markers/red_MarkerB.png',
		//  title: 'Click for directions!'		  
        //});
		//var marker = new google.maps.Marker({
        //  position: userlocation,
        //  map: map,
		//  icon: 'Markers/blue_MarkerA.png',
		//  title: 'Your current location!'
        //});
        var directionsService = new google.maps.DirectionsService();
        var directionsRequest = {
          origin: userlocation,
          destination: destinationlocation,
          travelMode: google.maps.DirectionsTravelMode.DRIVING,
        };
        directionsService.route(
          directionsRequest,
          function(response, status)
          {
            if (status == google.maps.DirectionsStatus.OK)
            {
              new google.maps.DirectionsRenderer({
                map: map,
                directions: response
              });
            }
            else
              $("#error").append("Unable to retrieve your route<br />");
          }
        );
      }
	  
	  
	function preinit2(siteKey) {
		site_AddressKey = siteKey;
		initMap2();
	}	  
	  
	function initMap2() {
		if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition2);
			} else { 
				alert("Geolocation is not supported by this browser.");
			}
	}
	
	function showPosition2(position) {
		user_lat = position.coords.latitude;
		user_lon = position.coords.longitude;
		createMap2();
		//calculateRoute();
		//alert("lat:" + user_lat + " lon:" + user_lon);
	}

	function createMap2() {
		var destinationlocation = inputData2[site_AddressKey].address;
		var userlocation = {lat: user_lat, lng: user_lon};
		//Spoof user location for Demo  38.6324350,-90.2268072
		//var userlocation = {lat: 38.6324350, lng: -90.2268072};
        var map = new google.maps.Map(document.getElementById('map2'), {
          zoom: 15,
          center: destinationlocation
		  //center: userlocation
        });
        //var marker = new google.maps.Marker({
        //  position: destinationlocation,
        //  map: map,
		//  icon: 'Markers/red_MarkerB.png',
		//  title: 'Click for directions!'		  
        //});
		//var marker = new google.maps.Marker({
        //  position: userlocation,
        //  map: map,
		//  icon: 'Markers/blue_MarkerA.png',
		//  title: 'Your current location!'
        //});
        var directionsService = new google.maps.DirectionsService();
        var directionsRequest = {
          origin: userlocation,
          destination: destinationlocation,
          travelMode: google.maps.DirectionsTravelMode.DRIVING,
        };
        directionsService.route(
          directionsRequest,
          function(response, status)
          {
            if (status == google.maps.DirectionsStatus.OK)
            {
              new google.maps.DirectionsRenderer({
                map: map,
                directions: response
              });
            }
            else
              $("#error").append("Unable to retrieve your route<br />");
          }
        );
      }	  
