<?php	
	require_once("sesja.php");
	require_once("helpers/basic.php");
$HEADER = 
<<<EOT
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
	<div id="bar">
		<div id="points">27&#9819;</div>
	    <a href="http://localhost/pz/Event/Zespolowe2/old/Zespolowe/wyloguj.php"><img id="logout" src="./img/logout.png"></a>
	    <img src="./img/logo.png">
  	</div>
  	<br><br><br>
	<div class='strona'>
		<div class='grupuj' id='ud'>
			<p>Stwórz event</p>
			<div class='logowanie'>
			{{FORM}}
			</div>
		</div>

EOT;

$FORM1 = <<<EOT

EOT;
$FORM2 = <<<EOT
				<form method="POST" action="utworzevent.php" id="usrform" enctype="multipart/form-data">
					<p><b>#Tag(maksymalnie 3):</b></p><input type="text" name="tag">
					<p><b>Data zakończenia:</b></p><input type="datetime-local" name="datazak">
					<p><b>Opis:</b></p><textarea class='text' rows="4" cols="50" name="opis" form="usrform" ></textarea>
					<input type="file" accept="image/*|video/*" capture="camera" name="zdjecie">
					<input class='button'  type="submit" value="Utwórz" name="utworz">
				</form>
EOT;
$FOOTER = <<<EOT
		</div>
</body>
</html>
EOT;

if(isset($_POST['utworz'])){
	require_once("sql/baza.php");
	$image = $_FILES['zdjecie'];
    $imagename = $_FILES['zdjecie']['name'];
    $imagetype = $_FILES['zdjecie']['type'];
    $imageerror = $_FILES['zdjecie']['error'];
    $imagetemp = $_FILES['zdjecie']['tmp_name'];
    $imagePath = "uploads/".$_SESSION['login']."/";
	echo $imageerror;
	if($imageerror == 0){
		if(!file_exists ( "uploads/".$_SESSION['login'] )){
			mkdir("uploads/".$_SESSION['login']);
		}
		$temp = substr($imagename, 0, strlen($imagetype)+1);
		while(file_exists($imagePath."/".$imagename)){
			 $imagename = "0".$imagename;
		}
		if(is_uploaded_file($imagetemp)) {
			if(!move_uploaded_file($imagetemp, $imagePath . $imagename)) {
				echo "Failed to move your image.";
			}
		}
		else {
			echo "Failed to upload your image.";
		}
		
		$B = new Baza();
		$x = $B->stworzEvent($_SESSION['id'], $_POST['tag'], $_POST['datazak'],$_POST['opis'],$imagePath.$imagename, null);
		
		header("Location: twojprofil.php");
	}else{
		echo "Brak zdjecia";
	}
	
}
echo (string) str_replace("{{FORM}}", (string) $FORM2,  $HEADER);

echo $paneldolny;



echo $FOOTER;
?>	