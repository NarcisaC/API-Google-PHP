<?php 
// function to geocode address details
function getGeocodeData($address) { 
    //Declaration of variables
    $address = urlencode($address);     
    //Call map, create your API_KEY - Geocoding API
    $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=API_KEY";
    //File to String
    $geocodeResponseData = file_get_contents($googleMapUrl);
    //String to JSON
    $responseData = json_decode($geocodeResponseData, true);

    //Status 200
    if ($responseData['status'] == 'OK') {
        //Check whether a variable is set or not
        $latitude = isset($responseData['results'][0]['geometry']['location']['lat']) ? $responseData['results'][0]['geometry']['location']['lat'] : "";
        $longitude = isset($responseData['results'][0]['geometry']['location']['lng']) ? $responseData['results'][0]['geometry']['location']['lng'] : "";
        $formattedAddress = isset($responseData['results'][0]['formatted_address']) ? $responseData['results'][0]['formatted_address'] : "";         
        if ($latitude && $longitude && $formattedAddress) {         
            $geocodeData = array();                         
            array_push(
                $geocodeData, 
                $latitude, 
                $longitude, 
                $formattedAddress
            );             
            return $geocodeData;             
        } else {
            return false;
        }         
    } else {
        echo "ERROR: {$responseData['status']}";
        return false;
    }
}
?>
