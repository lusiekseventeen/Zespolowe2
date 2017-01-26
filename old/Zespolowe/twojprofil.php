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
	<a href = 'wyloguj.php' class='wylogujButton' >Wyloguj</a>
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
</div>
EOT;

echo $HEADER;
echo $paneldolny;
require_once("sql/baza.php");
$B = new Baza(); 

$B->refreshDatabase();

$result=$B->getEventsStworzonychList($_SESSION['id']);
$ALLYOUR = generateWydarzenia($result);
echo (string) str_replace("{{TWOJE}}", (string) $ALLYOUR,  $TWOJE);

$result=$B->getEventsUdzialList($_SESSION['id']);
$ALLYOUR = generateWydarzenia($result);
echo (string) str_replace("{{UDZIAL}}", (string) $ALLYOUR,  $UDZIAL);


echo $FOOTER;
?>	