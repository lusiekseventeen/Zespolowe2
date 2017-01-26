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
  	<br>
	<div class='strona'>
EOT;

$FOOTER = <<<EOT
		</div>
</body>
</html>
EOT;

$HTAG = <<<EOT
<div class='grupuj' id='gr'>
	<p>Obserwowane #tagi</p>
	{{HTAG}}
	<br>
</div>
EOT;

echo $HEADER;
echo $paneldolny;
require_once("sql/baza.php");
$B = new Baza(); 

$B->refreshDatabase();

$result=$B->getEventsUserTagsList($_SESSION['id']);
$ALLYOUR = generateWydarzenia($result);
echo (string) str_replace("{{HTAG}}", (string) $ALLYOUR,  $HTAG);
echo $FOOTER;
?>	