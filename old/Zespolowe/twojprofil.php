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
	    <a href="./wyloguj.php"><img id="logout" src="./img/logout.png"></a>
	    <img src="./img/logo.png">
  	</div>
	<div class='strona'>
EOT;

$FOOTER = <<<EOT
		</div>
</body>
</html>
EOT;

$TWOJE = <<<EOT
<div class='grupuj' id='gr'>
	<p>Stworzone wydarzenia</p>
	{{TWOJE}}
</div>
EOT;

$UDZIAL = <<<EOT
<div class='grupuj' id='ud'>
	<p>Wydarzenia w których bierzesz udział</p>
{{UDZIAL}}
	<br>
</div>
EOT;

require_once("sql/baza.php");
$B = new Baza();

$points = $B->getPoints($_SESSION['id']);

echo (string) str_replace("{{POINTS}}", (string) $points,  $HEADER);

echo $paneldolny;

$B->refreshDatabase();

$result=$B->getEventsStworzonychList($_SESSION['id']);
$ALLYOUR = generateWydarzenia($result);
echo (string) str_replace("{{TWOJE}}", (string) $ALLYOUR,  $TWOJE);

$result=$B->getEventsUdzialList($_SESSION['id']);
$ALLYOUR = generateWydarzenia($result);
echo (string) str_replace("{{UDZIAL}}", (string) $ALLYOUR,  $UDZIAL);


echo $FOOTER;
?>	