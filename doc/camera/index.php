<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Test</title>
	
</head>

<body>
<style>
	label.cameraButton {
  margin: 1em 0;

  /* Styles to make it look like a button */
  padding: 0.5em;
  border: 2px solid #666;
  border-color: #EEE #CCC #CCC #EEE;
  background-color: #DDD;
  width:50 px;
}

/* Look like a clicked/depressed button */
label.cameraButton:active {
  border-color: #CCC #EEE #EEE #CCC;
}
#nowy {
    visibility: hidden;
	width:50 px;
}
#siema {
    width:50 px;
}
/* This is the part that actually hides the 'Choose file' text box for camera inputs */
label.cameraButton input[accept*="camera"] {
  display: none;
}
</style>
<script src="test.js">
</script>
	<br>
	
  <label class="cameraButton" onchange="photo()">SNAP PHOTO
    <input type="file" accept="image/*" capture="camera"> id="nowy"></label>
	<p id="demo"></p>
	<p id="demo1"></p>
	<canvas id="canvas" width="640" height="480"></canvas>

</body>

</html>