
let geocoder;
let distanceService;

$(document).ready(function () {
    // Initialize Google Places Autocomplete for pickup address
    var pickupInput = document.getElementById('pickup_address');
    var pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput);
    // Initialize Google Places Autocomplete for destination address
    var destinationInput = document.getElementById('destination_address');
    var destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);

    // Initialize geocoder
    geocoder = new google.maps.Geocoder();

    // Initialize Distance Matrix service
    distanceService = new google.maps.DistanceMatrixService();


    function calculateTaxes(distance) {
        var totalRate = null;
        var totalTax = null;
        $('.selected').each(function () {
            var fleetId = $(this).find('input[name="fleet_id"]').val();

            $.ajax({
                url: '/get-tax/' + fleetId, // Corrected AJAX URL
                method: 'GET',
                success: function (response) {
                    totalRate = response.rate
                    totalTax = response.tax

                    var Amount = totalRate * distance;
                    var totalAmount = Amount + totalTax;
                    $('#payment_amount').val(totalAmount);
                    $('#fleetPayable' + fleetId).text(totalAmount);

                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    }


    function calculateDistance() {
        const origin = document.getElementById('pickup_address').value;
        const destination = document.getElementById('destination_address').value;

        geocoder.geocode({ address: origin }, (results, status) => {

            if (status === "OK" && results && results.length > 0) {

                const originLatLng = results[0].geometry.location;

                geocoder.geocode({ address: destination }, (results, status) => {

                    if (status === "OK" && results && results.length > 0) {
                        const destinationLatLng = results[0].geometry.location;


                        distanceService.getDistanceMatrix({
                            origins: [originLatLng],
                            destinations: [destinationLatLng],
                            travelMode: google.maps.TravelMode.DRIVING,
                        }, (response, status) => {

                            if (status === "OK") {
                                const distanceText = response.rows[0].elements[0].distance.text;
                                calculateTaxes(parseFloat(distanceText.replace(' km', '')));
                            } else {
                                calculateTaxes(10);
                                console.error("Error: " + status);

                            }
                        });
                    } else {
                        console.error("Error: " + status);
                    }
                });
            } else {
                console.error("Error: " + status);
            }
        });
    }

    // Call calculateDistance when the pickup or destination address changes
    $('.fleet-card').click(function () {
        calculateDistance();
    });
});
