<script type="text/javascript" src="gears_init.js"></script>
<script type="text/javascript">
var geo = google.gears.factory.create('beta.geolocation');

function updatePosition(position) {
  document.write('Current lat/lon is: ' + position.latitude + ',' + position.longitude);
}

function handleError(positionError) {
  document.write('Attempt to get location failed: ' + positionError.message);
}

geo.getCurrentPosition(updatePosition, handleError);
</script>