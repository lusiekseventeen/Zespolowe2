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
</div>
EOT;

echo $HEADER;
echo $paneldolny;
require_once("sql/baza.php");
$B = new Baza(); 
$result=$B->getEventsStworzonychList($_SESSION['id']);
$ALLYOUR = generateWydarzenia($result);
echo (string) str_replace("{{HTAG}}", (string) $ALLYOUR,  $HTAG);
echo $FOOTER;
?>	