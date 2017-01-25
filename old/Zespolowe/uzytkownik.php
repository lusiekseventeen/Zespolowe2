<?php	
	require_once("sesja.php");
	require_once("helpers/basic.php");
	if($_POST['uzytkownik_id'] == $_SESSION['id'])
	{
		header("Location: twojprofil.php");
	}
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
	<p>Stworzone wydarzenia przez {{USER}}</p>
	{{TWOJE}}
</div>
EOT;

$UDZIAL = <<<EOT
<div class='grupuj' id='ud'>
	<p>Wydarzenia w których {{USER}} bierze udział</p>
{{UDZIAL}}
</div>
EOT;

echo $HEADER;
echo $paneldolny;
require_once("sql/baza.php");
$B = new Baza(); 

$TWOJE = (string) str_replace("{{USER}}", (string) $_POST['user_view'],  $TWOJE);
$UDZIAL = (string) str_replace("{{USER}}", (string) $_POST['user_view'],  $UDZIAL);

$result=$B->getEventsStworzonychList($_POST['uzytkownik_id']);
$ALLYOUR = generateWydarzenia($result);
echo (string) str_replace("{{TWOJE}}", (string) $ALLYOUR,  $TWOJE);

$result=$B->getEventsUdzialList($_POST['uzytkownik_id']);
$ALLYOUR = generateWydarzenia($result);
echo (string) str_replace("{{UDZIAL}}", (string) $ALLYOUR,  $UDZIAL);


echo $FOOTER;
?>	