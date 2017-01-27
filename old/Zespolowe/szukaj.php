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
		<div id="points">{{POINTS}}&#9819;</div>
	    <a href="http://localhost/pz/Event/Zespolowe2/old/Zespolowe/wyloguj.php"><img id="logout" src="./img/logout.png"></a>
	    <img src="./img/logo.png">
  	</div>
  	<br><br><br><br>
	<div class='strona'>
EOT;

$FOOTER = <<<EOT
		</div>
</body>
</html>
EOT;

$TWOJE = <<<EOT
<div class='grupuj' id='gr'>
	<p>Dostepne #Tagi</p>
	{{TWOJE}}
</div>
EOT;

$UDZIAL = <<<EOT
<div class='grupuj' id='ud'>
	<p>Popularne #Tagi po ilości wydarzeń</p>
{{UDZIAL}}
</div>
EOT;

require_once("sql/baza.php");
$B = new Baza(); 

$B->refreshDatabase();

if(isset($_POST['dodaj'])){
	$B->joinUsetToTag($_SESSION['id'],$_POST['tag']);
}

$points = $B->getPoints($_SESSION['id']);

echo (string) str_replace("{{POINTS}}", (string) $points,  $HEADER);

echo $paneldolny;

$result=$B->getWolneTagi($_SESSION['id']);
$ALLYOUR = generateTagList($result);
echo (string) str_replace("{{TWOJE}}", (string) $ALLYOUR,  $TWOJE);
echo $FOOTER;
?>	