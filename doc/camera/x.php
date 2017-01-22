

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Capture Tests</title>
</head>
<body>

<h1>test 1 (capture attr)</h1>
<input type="file" capture="camera" accept="image/*">

<h1>test 2 (capture in acc)</h1>
<button onclick="document.getElementById('filestrue').click()">Dawaj zdjecie</button>
<input id="zdjeciekurde" type="file" accept="image/*" capture="camera" style="display:none">


<h1>test 3 (capture bool)</h1>
<input type="file" accept="image/*" capture >

<h1>test 4 (capture bool, video)</h1>
<input type="file" accept="video/*" capture="camcorder" >

</body>
</html>

/*<form action="demo_form.asp">
  <input type="file" name="pic" accept="image/*;capture=camera">
  <input type="submit">
</form>


<!DOCTYPE html>
<html>
<body>

<p>Click the button to get your coordinates.</p>

<button onclick="getLocation()">Try It</button>

<p id="demo"></p>

<script>
var x = document.getElementById("demo");

function getLocation() {
navigator.geolocation.getCurrentPosition(
    function(position) {
		debugger;
         alert("Lat: " + position.coords.latitude + "\nLon: " + position.coords.longitude);
    },
    function(error){
         alert(":( " + error.message);
    }, {
         enableHighAccuracy: true
              ,timeout : 5000
    }
);
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
}
</script>

</body>
</html>
