<?php
// Foursquare login stage 1, build url and redirect
  require_once('secrets/foursquare.php'); //defines CLIENT_ID & SECRET
  require_once('library/FoursquareAPI.class.php');

  $venueid='4d14b5da816af04db6043ec2';
  $foursquare = new FoursquareAPI(CLIENT_ID,CLIENT_SECRET);
  $location="Vilafranca del Penedès, Spain";
  list($lat,$lng) = $foursquare->GeoLocate($location);
  echo "lat:".$lat."\nlong:".$lng;
  $params = array("ll"=>"$lat,$lng");
  $response = $foursquare->GetPublic("venues/search",$params);
  print_r($response);
  $venues = json_decode($response);
  print_r($venues);
  echo "\n";
  ?>