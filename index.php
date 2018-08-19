<?php
include('functions.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>phpzag.com : Demo Google Maps Geocode Address with PHP</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="style.css" />  
<?php include('container.php');?>
<div class="container">	
	<h2>Google Maps Geocode Address with PHP</h2>	
	<?php
	if($_POST) { 
		// get geocode address details
		$geocodeData = getGeocodeData($_POST['searchAddress']); 
		if($geocodeData) {         
			$latitude = $geocodeData[0];
			$longitude = $geocodeData[1];
			$address = $geocodeData[2];                     
		?> 
		<div id="gmap">Loading map...</div>

		<!-- Call map, create your API_KEY - Maps Javascript API -->
		<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=API_KEY"></script>   
		<script type="text/javascript">
			// Initialize the map
			function init_map() {
				//Properties for the map
				var options = {
					zoom: 14, //Size map
					center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				//Create the map inside <div> using properties options
				map = new google.maps.Map($("#gmap")[0], options);
				//Mark the address with the default icon.
				marker = new google.maps.Marker({
					map: map,
					position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
				});
				//String of text or a DOM node to display in the info window.
				infowindow = new google.maps.InfoWindow({
					content: "<?php echo $address; ?>"
				});
				google.maps.event.addListener(marker, "click", function () {
					infowindow.open(map, marker);
				});
				infowindow.open(map, marker);
			}
			google.maps.event.addDomListener(window, 'load', init_map);
		</script> 
		<?php 
		} else {
			echo "Incorrect details to show map!";
		}
	}
	?>
	<br>	
	<div>
		<div><strong>You can enter below example address or enter any other address to see map :</strong></div>
		<!-- examples to find -->
		<div>1. Central Market Delhi</div>
		<div>2. Fortis Hospital Noida</div>
	</div>	
	<br>
	<form action="" method="post">
		<div class="row">		
			<div class="col-sm-4">	
				<div class="form-group">
					<input type='text' name='searchAddress' class="form-control" placeholder='Enter address here' />
				</div>
			</div>
			<div class="form-group">
				<input type='submit' value='Find' class="btn btn-success" />
			</div>
		</div>
	</form>	
	<div style="margin:50px 0px 0px 0px;">
		<a class="btn btn-default read-more" style="background:#3399ff;color:white" href="http://www.phpzag.com/google-maps-geocode-address-with-php/">Back to Tutorial</a>		
	</div>
</div>
<?php include('footer.php');?>