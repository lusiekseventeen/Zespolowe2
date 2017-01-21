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
		<div class='headerwydarzenie'>
			<img class='profiloweimg' src="{{PIMG}}" alt="profi">
			<p>{{ENAZWA}}</p>
		</div>
		<img src="{{EIMG}}" alt="foto">
		{{PIOTREKSTOPKA}}
		<p class='opis'>
		{{EOPIS}}
		</p>
		{{Wydarzenia}}
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
			$result=$conn->query("SELECT * FROM uzytkownik WHERE id='".$id."'");
			$res = $result->fetch_assoc();
			$temp= (string) str_replace("{{PIMG}}", (string) res['profilowe_url'],  $WYDARZENIE);
			$temp= (string) str_replace("{{ENAZWA}}", (string) res['login'],  $temp);
			$temp= (string) str_replace("{{EIMG}}", (string) row['foto_url'],  $temp);
			$temp= (string) str_replace("{{EOPIS}}", (string) row['opis'],  $temp);
			$ALL += $temp;
		}
	} else {
		$ALL = $BRAKWYDARZEN;
	}
	return $ALL;
}

?>	