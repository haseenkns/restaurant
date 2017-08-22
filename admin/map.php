<?php
echo get_lat_long("Munirka,New Delhi,Delhi");
function get_lat_long($address){

    $address = str_replace(" ", "+", $address);

    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
    $json = json_decode($json);

    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    return $lat.','.$long;
}
?>
<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>

<style>
#map_wrapper {
    height: 400px;
}

#map_canvas {
    width: 100%;
    height: 100%;
}
</style>
<script language="javascript" src="javascript/jquery.js"></script>
