<?php	
$paneldolny = <<<EOT
	<div class='paneldolny'>
		<div><a href='index.php'><img src="img/home.png"/></a></div>
		<div><a href='szukaj.php'><img src="img/find.png"/></a></div>
		<div><a href='utworzevent.php'><img src="img/add.png"/></a></div>
		<div><a href='twojprofil.php'><img src="img/usr.png"/></a></div>
	</div>
EOT;

function generateWydarzenia($rows){
	$WYDARZENIE = <<<EOT
	<div class='wydarzenie'>
	<p>{{ENAZWA}} <br> CZAS DO {{CZAS}}</p>
		<img src="{{EIMG}}" alt="foto">
		{{PIOTREKSTOPKA}}
		<p class='opis'>
		{{EOPIS}}
		</p>
	</div>
EOT;

$BRAKWYDARZEN = <<<EOT
<div class='wydarzenie'>
	<p class='opis'>Brak wydarzeń :(</p>
</div>
EOT;
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$dbname = "events";
	$conn = new mysqli($servername, $username, $password, $dbname);	
	$ALL = "";
	if ($rows->num_rows > 0) {
		while($row = $rows->fetch_assoc()) {
			$result=$conn->query("SELECT * FROM uzytkownik WHERE id=".$row['uzytkownik_id']);
			$res = $result->fetch_assoc();
			$temp= (string) str_replace("{{CZAS}}", (string) $row['data_zakonczenia'],  $WYDARZENIE);
			$temp= (string) str_replace("{{ENAZWA}}", (string) $res['login'], $temp);
			$temp= (string) str_replace("{{EIMG}}", (string) $row['foto_url'],  $temp);
			$temp= (string) str_replace("{{EOPIS}}", (string) $row['opis'],  $temp);
			$ALL = $ALL.$temp;
		}
	} else {
		$ALL = $BRAKWYDARZEN;
	}
	return $ALL;
}

$ZDJECIEVIDEO = <<<EOT
	<button style='width:50%' class='button' onclick="document.getElementById('zdjecieid').click()">Zdjęcie</button>
	<input id="zdjecieid" type="file" accept="image/*" capture="camera" style="display:none">
	<button style='width:50%' class='button' onclick="document.getElementById('filmid').click()">Film</button>
	<input id="filmid" type="file" accept="image/*" capture="camera" style="display:none">
EOT;
?>