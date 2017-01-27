<?php	
	require_once("sesja.php");
	require_once("helpers/basic.php");
$HEADER = 
<<<EOT
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="script/decide.js"></script>
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

require_once("sql/baza.php");
$B = new Baza(); 

$B->refreshDatabase();
$points = $B->getPoints($_SESSION['id']);

echo (string) str_replace("{{POINTS}}", (string) $points,  $HEADER);

echo $paneldolny;

$eventID = "";
if(isset($_GET['id']))
{
	$eventID = $_GET['id'];
}
else
{
	$eventID = $_POST['idevent'];
}

$result=$B->getApplies($eventID);
$eventView = generujListeDecyzji($result,$eventID);

echo $eventView;
echo $FOOTER;
?>	