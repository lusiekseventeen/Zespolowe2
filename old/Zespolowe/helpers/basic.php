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
		{{MEDIA}}
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

$STOPKAADMIN = <<<EOT
<div class="stopkaEvent">
	<form method="POST" action="sprawdz.php" id="usrform">
	<input style="display:none" name="idevent" value="{{IDEVENT}}">
	<input class='button'  type="submit" value="Sprawdź" name="sprawdz">
	</form>
</div>
EOT;



$STOPKAUZYT = <<<EOT
<div class="stopkaEvent">
	<form method="POST" action="zglos.php" id="usrform">
	<input style="display:none" name="idevent" value="{{IDEVENT}}">
	<input class='button'  type="submit" value="Weź udział" name="zglos">
	</form>
</div>
EOT;
$FILM = <<<EOT
<video style="width:100%" controls>
   <source src="{{EIMG}}" type="video/mp4">
   <source src="{{EIMG}}" type="video/ogg">
</video>
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
			if(strpos(mime_content_type($row['foto_url']),'image')!==false){
				$temp= (string) str_replace("{{MEDIA}}", (string) '<img src="{{EIMG}}" alt="foto">',  $temp);
				$temp= (string) str_replace("{{EIMG}}", (string) $row['foto_url'],  $temp);
			}else{
				$temp= (string) str_replace("{{MEDIA}}", (string) $FILM,  $temp);
				$temp= (string) str_replace("{{EIMG}}", (string) $row['foto_url'],  $temp);
				$temp= (string) str_replace("{{EIMG}}", (string) $row['foto_url'],  $temp);
			}
			$temp= (string) str_replace("{{EOPIS}}", (string) $row['opis'],  $temp);
			$admin=1;	
			if($row['uzytkownik_id']===$_SESSION['id']){
				$admin = 0;
			}else if($conn->query("SELECT * FROM `relacja_event_uzytkownik` WHERE event_id=".$row['id']." AND uzytkownik_id=".$_SESSION['id'])->num_rows != 0 ){
				$admin = 2;
			}
			if($admin==0){
				$temp= (string) str_replace("{{PIOTREKSTOPKA}}", (string) $STOPKAADMIN,  $temp);
				$temp =(string) str_replace("{{IDEVENT}}", (string) $row['id'],  $temp);
			}else if ($admin==1){
				$temp= (string) str_replace("{{PIOTREKSTOPKA}}", (string) $STOPKAUZYT,  $temp);
				$temp = (string) str_replace("{{IDEVENT}}", (string) $row['id'],  $temp);
			}else {
				$temp= (string) str_replace("{{PIOTREKSTOPKA}}", (string) "",  $temp);
			}
			$ALL = $ALL.$temp;
		}
	} else {
		$ALL = $BRAKWYDARZEN;
	}
	return $ALL;
}

function generateTagList($rows){
	$TAGELEMENT = <<<EOT
<div class="stopkaEvent">
	<form method="POST" action="szukaj.php" id="usrform">
	<input style="display:none" name="tag" value="{{IDEVENT}}">
	<input class='button'  type="submit" value="{{NAZWA}}" name="dodaj">
	</form>
</div>
EOT;
	$ALL = "";
	if ($rows->num_rows > 0) {
		while($row = $rows->fetch_assoc()) {
			$temp = (string) str_replace("{{IDEVENT}}", (string) $row['id'],  $TAGELEMENT);
			$temp =(string) str_replace("{{NAZWA}}", (string) $row['nazwa'],  $temp);
			$ALL = $ALL.$temp;
		}
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