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
	<div class='strona'>
		<div class='grupuj' id='ud'>
			<p>Stwórz event</p>
			<div class='logowanie'>
			{{FORM}}
			</div>
		</div>

EOT;

$FORM1 = <<<EOT
				<form action="upload.php" method="post" enctype="multipart/form-data">
						Select image to upload:
						<input type="file" name="fileToUpload" id="fileToUpload">
						<input type="submit" value="Upload Image" name="submit">
				</form>
EOT;
$FORM2 = <<<EOT
				<form method="POST" action="utworzevent.php" id="usrform">
					<p><b>#Tag(maksymalnie 3):</b></p><input type="text" name="tag">
					<p><b>Data zakończenia:</b></p><input type="datetime-local" name="datazak">
					<p><b>Opis:</b></p><textarea class='text' rows="4" cols="50" name="opis" form="usrform" ></textarea>
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
	$B = new Baza();
	//$B->stworzEvent($_SESSION['id'], $_POST['tag'], $_POST['datazak'],$_POST['opis'])
	
}
echo (string) str_replace("{{FORM}}", (string) $FORM1.$FORM2,  $HEADER);
//echo $HEADER;
echo $paneldolny;



echo $FOOTER;
?>	