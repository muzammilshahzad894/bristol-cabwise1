$(document).ready(function() {
    // Initialize Google Places autocomplete for pickup address
    var pickupInput = document.getElementById('pickup_address');
    var pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput);

    // Initialize Google Places autocomplete for destination address
    var destinationInput = document.getElementById('destination_address');
    var destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);

    // Calculate distance between pickup and destination addresses
    function calculateDistance() {
      var origin = pickupInput.value;
      var destination = destinationInput.value;

      var service = new google.maps.DistanceMatrixService();
      service.getDistanceMatrix({
        origins: [origin],
        destinations: [destination],
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.METRIC,
      }, function(response, status) {
          console.log(status)

        if (status === 'OK') {
          console.log()
          var distance = response.rows[0].elements[0].distance.value; // Distance in meters
          var distanceInKm = distance / 1000; // Convert distance to kilometers

          // Calculate amount based on distance and selected fleet rate
          var selectedFleetRate = parseFloat($('#fleetDropdown').val());
          var paymentAmount = distanceInKm * selectedFleetRate;
          $('#payment_amount').val(paymentAmount.toFixed(2)); 
        } else {

          console.error('Error:', status);
        }
      });
    }

    // Listen for changes in pickup and destination addresses
    pickupAutocomplete.addListener('place_changed', calculateDistance);
    destinationAutocomplete.addListener('place_changed', calculateDistance);
  });