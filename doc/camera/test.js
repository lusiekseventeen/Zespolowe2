function photo(){
	debugger;
	var canvas  = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');  
	var imgg = document.getElementById('nowy');
	var img =  new Image();
    img.src = window.URL.createObjectURL(imgg.files[0]);
    img.onload = function() {
		document.getElementById("demo1").innerHTML = img.width+" "+img.height;
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		var imgSize = scale(img.width, img.height, canvas.clientWidth, canvas.clientHeight);
		ctx.drawImage(img, 0, 0, imgSize.width, imgSize.height);
    }
	document.getElementById("demo").innerHTML = img.src;
}
function scale(imgWidth, imgHeight, canvasWidth, canvasHeight) {
    var scale = Math.min(canvasWidth / imgWidth, canvasHeight / imgHeight);
    var newWidth = imgWidth * scale;
    var newHeight = imgHeight * scale;
    return {
        width: newWidth,
        height: newHeight
    };
}
