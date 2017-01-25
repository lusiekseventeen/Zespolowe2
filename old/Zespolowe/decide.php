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
	<div class='strona'>
EOT;

$FOOTER = <<<EOT
		</div>
</body>
</html>
EOT;


echo $HEADER;
echo $paneldolny;

require_once("sql/baza.php");

$eventID = "";
if(isset($_GET['id']))
{
	$eventID = $_GET['id'];
}
else
{
	$eventID = $_POST['idevent'];
}

$B = new Baza(); 
$result=$B->getApplies($eventID);
$eventView = generujListeDecyzji($result,$eventID);

echo $eventView;
echo $FOOTER;
?>	