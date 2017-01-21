<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
	<div class='strona'>
	<div class='logowanie'>
		<form method="POST" action="logowanie.php">
		<p>Zaloguj się do portalu</p>
		<p><b>Login:</b></p><input type="text" name="login">
		<p><b>Hasło:</b></p><input type="password" name="haslo">
		<input class='button'  type="submit" value="Zaloguj" name="zalogujsie">
		<a class='button' href="rejestracja.php"> Rejestruj </a>
		</form>
	</div>
	</div>
</body>
</html>

<?php
session_start();

if(isset($_POST['zalogujsie']))
{
	require_once("sql/baza.php");
	$B = new Baza(); 
	$Check = $B->zaloguj($_POST['login'], $_POST['haslo']);
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
