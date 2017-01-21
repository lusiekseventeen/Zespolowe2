
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
	<div class='strona'>
	<div class='logowanie'>
		<form method="POST" action="rejestracja.php">
			<p>Zarejestruj się do portalu</p>
			<p><b>Login:</b></p><input type="text" name="login">
			<p><b>Hasło:</b></p><input type="password" name="haslo">
			<p><b>Potwierdź hasło:</b></p><input type="password" name="haslo2">
			<p><b>#Tagi:</b></p><input type="text" name="tagi">
			<p><b>Facebook link</b></p><input type="text" name="facebooklink">
			<p><b>Typ konta</b></p><input type="radio" name="typ" value="1" checked style='width:25%'><b>Publiczne</b>
			<input type="radio" name="typ" value="0" style='width:25%'><b>Prywatne</b><br><br>
			<input class='button'  type="submit" value="Rejestruj" name="rejestruj">
		</form>
	</div>
	</div>
</body>
</html>

<?php
session_start();

if (isset($_POST['rejestruj']))
{
	require_once("sql/baza.php");
	$B = new Baza(); 
	$Check = $B->registerUzytkownik($_POST['login'], $_POST['haslo'], $_POST['haslo2'], $_POST['tagi'], $_POST['facebooklink'], $_POST['typ']);
	if($Check[0]===true){
		$_SESSION['login'] = $Check[1];
		$_SESSION['time'] = time();
		$_SESSION['id'] = $Check[2];
		header("Location: index.php");
	}else{
		echo $Check[1];
	}
}
?>

