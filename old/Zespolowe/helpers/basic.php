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
	<a href='sprawdz.php?id={{ID}}'><p>@{{ENAZWA}} <br> {{STATUS}}</p></a>
		{{MEDIA}}
		{{PIOTREKSTOPKA}}
		<p class='opis'>
		{{EOPIS}}
		</p>
	</div>
EOT;

$CZAS = "czas do: ";

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

$STOPKAPOZGLOSZENIU = <<<EOT
<div class="stopkaEvent">
	<form method="POST" action="sprawdz.php" id="usrform">
	<input style="display:none" name="idevent" value="{{IDEVENT}}">
	<input class='button'  type="submit" value="podgląd" name="podglad">
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
	
			$temp= (string) str_replace("{{ENAZWA}}", (string) $res['login'], $WYDARZENIE);
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

			if($row['czy_zakonczone'] == 1)
			{
				$temp= (string) str_replace("{{STATUS}}", "zakończone",  $temp);
				$admin = 2;
			}
			else
			{
				$temp= (string) str_replace("{{STATUS}}", (string) $CZAS.$row['data_zakonczenia'],  $temp);
			}


			$temp= (string) str_replace("{{ID}}", (string) $row['id'],  $temp);
			if($admin==0){
				$temp= (string) str_replace("{{PIOTREKSTOPKA}}", (string) $STOPKAADMIN,  $temp);
				$temp =(string) str_replace("{{IDEVENT}}", (string) $row['id'],  $temp);
			}else if ($admin==1){
				$temp= (string) str_replace("{{PIOTREKSTOPKA}}", (string) $STOPKAUZYT,  $temp);
				$temp = (string) str_replace("{{IDEVENT}}", (string) $row['id'],  $temp);
			}else {
				$temp= (string) str_replace("{{PIOTREKSTOPKA}}", (string) $STOPKAPOZGLOSZENIU,  $temp);
				$temp = (string) str_replace("{{IDEVENT}}", (string) $row['id'],  $temp);
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

function generujWydarzenie($one_row,$eventID)
{

	$servername = "localhost";
		$username = "root";
		$password = "1234";
		$dbname = "events";
		$conn = new mysqli($servername, $username, $password, $dbname);


	$WYDARZENIE = <<<EOT
	<div class='wydarzenie'>
	<p>{{ENAZWA}} <br> {{STATUS}}</p>
		{{MEDIA}}
		{{PIOTREKSTOPKA}}
		<p class='opis'>
		{{EOPIS}}
		</p>
		<div class="lista_uczestnikow">
		<p>{{WB}} udział: <br> &#9825; {{LICZBA_UCZESTNIKOW}}</p>
		{{LISTA_UCZESTNIKOW}}<br><br>
		</div>
	</div>
EOT;

	//Podgląd przez Admina
	$STOPKA_1 = <<<EOT
	<div class="stopkaEvent">
		<form method="POST" action="decide.php" id="usrform">
		<input style="display:none" name="idevent" value="{{IDEVENT}}">
		<input class='button'  type="submit" value="rozstrzygaj" name="decide">
		</form>
	</div>
EOT;

	//Podgląd przez innego użytkownia (nie bierze udziału jeszcze)
	$STOPKA_2 = <<<EOT
	<div class="stopkaEvent">
		<form method="POST" action="zglos.php" id="usrform">
		<input style="display:none" name="idevent" value="{{IDEVENT}}">
		<input class='button'  type="submit" value="Weź udział" name="join">
		</form>
	</div>
EOT;

	//Podgląd przez innego użytkownia (biorący już udział)
	$STOPKA_3 = <<<EOT
	<div class="stopkaEvent">
		Zgłoszony
	</div>
EOT;

$STOPKA_4 = <<<EOT
	<div class="stopkaEvent">
		
	</div>
EOT;

	$LISTA = <<<EOT
	<form method="POST" action="uzytkownik.php" class="users_form">
		<input style="display:none" name="uzytkownik_id" value="{{UZYT_ID}}">
		<input class='btn_ahref'  type="submit" value="{{LOGIN_UZYT}}" name="user_view">
		</form>
EOT;

$CZAS = "czas do: ";


	$row = $one_row->fetch_assoc();
	
	$temp= (string) str_replace("{{ENAZWA}}", (string) $row['login'], $WYDARZENIE);
	if(strpos(mime_content_type($row['foto_url']),'image')!==false){
		$temp= (string) str_replace("{{MEDIA}}", (string) '<img src="{{EIMG}}" alt="foto">',  $temp);
		$temp= (string) str_replace("{{EIMG}}", (string) $row['foto_url'],  $temp);
	}else{
		$temp= (string) str_replace("{{MEDIA}}", (string) $FILM,  $temp);
		$temp= (string) str_replace("{{EIMG}}", (string) $row['foto_url'],  $temp);
		$temp= (string) str_replace("{{EIMG}}", (string) $row['foto_url'],  $temp);
	}
	$temp= (string) str_replace("{{EOPIS}}", (string) $row['opis'],  $temp);
	
	$admin=2;

	if($row['uzytkownik_id']===$_SESSION['id']){
		$admin = 1;
	}else if($conn->query("SELECT * FROM `relacja_event_uzytkownik` WHERE event_id=".$eventID." AND uzytkownik_id=".$_SESSION['id'])->num_rows != 0 ){
		$admin = 3;
	}

	if($row['czy_zakonczone'] == 1)
	{
		$temp= (string) str_replace("{{STATUS}}", "zakończone",  $temp);
		if($row['uzytkownik_id']===$_SESSION['id'] && $row['czy_rozdane'] == 0)
		{
			//
		}
		else if ($row['uzytkownik_id']===$_SESSION['id'] && $row['czy_rozdane'] == 1) 
		{
			$admin = 4;
		}
		else
		{
			$admin = 4;
		}
	}
	else
	{
		$temp= (string) str_replace("{{STATUS}}", (string) $CZAS.$row['data_zakonczenia'],  $temp);
	}

	if($admin==1){
		$temp= (string) str_replace("{{PIOTREKSTOPKA}}", (string) $STOPKA_1,  $temp);
		$temp =(string) str_replace("{{IDEVENT}}", (string) $eventID,  $temp);
	}else if ($admin==2){
		$temp= (string) str_replace("{{PIOTREKSTOPKA}}", (string) $STOPKA_2,  $temp);
		$temp = (string) str_replace("{{IDEVENT}}", (string) $eventID,  $temp);
	}else if ($admin==3){
		$temp= (string) str_replace("{{PIOTREKSTOPKA}}", (string) $STOPKA_3,  $temp);
		$temp = (string) str_replace("{{IDEVENT}}", (string) $eventID,  $temp);
	}else if ($admin==4){
		$temp= (string) str_replace("{{PIOTREKSTOPKA}}", (string) $STOPKA_4,  $temp);
		$temp = (string) str_replace("{{IDEVENT}}", (string) $eventID,  $temp);
	}


	if($row['czy_rozdane'] == 1)
	{
		$usr_arr = $conn->query("SELECT uzytkownik.login, uzytkownik.id FROM uzytkownik INNER JOIN relacja_event_uzytkownik ON relacja_event_uzytkownik.uzytkownik_id = uzytkownik.id WHERE relacja_event_uzytkownik.czy_zatwierdzona = 1 AND relacja_event_uzytkownik.event_id =".$eventID." ORDER BY relacja_event_uzytkownik.punkty DESC");
	
		$users = "";
		$users_count = $usr_arr->num_rows;
		$forms = "";
		$temp_form = "";
		$k = 1;

		if ($usr_arr->num_rows > 0) 
		{
			while($row = $usr_arr->fetch_assoc()) 
			{
				$temp_form = $LISTA;
				$temp_form = (string) str_replace("{{UZYT_ID}}", (string) $row['id'],  $temp_form);
				$temp_form = (string) str_replace("{{LOGIN_UZYT}}", $k.". @".$row['login'],  $temp_form);
				$users .= $temp_form;
				$k++;
			}
		}
		else
		{
			if($admin == 4)
			{
				$users = "Nikt nie wziął udziału :(";
			}
			else
			{
				$users = "Nikt jeszcze nie wziął udziału :(";
			}
		}

		$temp = (string) str_replace("{{WB}}", (string) "Wzieli",  $temp);
		$temp = (string) str_replace("{{LICZBA_UCZESTNIKOW}}", (string) $users_count,  $temp);
		$temp = (string) str_replace("{{LISTA_UCZESTNIKOW}}", (string) $users,  $temp);
	}
	else
	{
		$usr_arr = $conn->query("SELECT uzytkownik.login, uzytkownik.id FROM uzytkownik INNER JOIN relacja_event_uzytkownik ON relacja_event_uzytkownik.uzytkownik_id = uzytkownik.id WHERE relacja_event_uzytkownik.event_id =".$eventID);
	
		$users = "";
		$users_count = $usr_arr->num_rows;
		$forms = "";
		$temp_form = "";

		if ($usr_arr->num_rows > 0) 
		{
			while($row = $usr_arr->fetch_assoc()) 
			{
				$temp_form = $LISTA;
				$temp_form = (string) str_replace("{{UZYT_ID}}", (string) $row['id'],  $temp_form);
				$temp_form = (string) str_replace("{{LOGIN_UZYT}}", "@".$row['login'],  $temp_form);
				$users .= $temp_form;
			}
		}
		else
		{
			if($admin == 4)
			{
				$users = "Nikt nie wziął udziału :(";
			}
			else
			{
				$users = "Nikt jeszcze nie wziął udziału :(";
			}
		}

		$temp = (string) str_replace("{{WB}}", (string) "Biorą",  $temp);
		$temp = (string) str_replace("{{LICZBA_UCZESTNIKOW}}", (string) $users_count,  $temp);
		$temp = (string) str_replace("{{LISTA_UCZESTNIKOW}}", (string) $users,  $temp);

	}

	return $temp;
}

function generujListeDecyzji($rows,$eventID)
{

	$servername = "localhost";
		$username = "root";
		$password = "1234";
		$dbname = "events";
		$conn = new mysqli($servername, $username, $password, $dbname);
		
	$ZGLOSZENIE = <<<EOT
	<div class="zgloszenie" style="z-index: {{Z_INDEX}}">
		{{MEDIA}}
		<p class="opis">
		{{COMMENT}}
		</p>
		<div class="decision_buttons">
			<img class="btnNo" onclick="fire_no({{APP_ID}})" src="img/no.png"/>
			<img class="btnYes" onclick="fire_yes({{APP_ID}})" src="img/yes.png"/>
		</div>
	</div>
EOT;

$BRAKZGLOSZEN = <<<EOT
	<div class="zgloszenie">
		<p class="opis">
		Brak zgłoszeń :(
		</p>
	</div>
EOT;

$PUNKTY = <<<EOT
	<div class="zgloszenie">
		<p class="opis">
		Rozdziel punkty!
		</p>
		<div class="decision_buttons">
			<img class="btnNo" onclick="fire_points({{APP_ID}})" src="img/podium.png"/>
		</div>
	</div>
EOT;

	$result = $conn->query("SELECT czy_zakonczone, czy_rozdane FROM event WHERE id=".$eventID);
	$res = $result->fetch_assoc();

	$ALL = "";
	$z_idx = $rows->num_rows;
	if ($rows->num_rows > 0) {
		while($row = $rows->fetch_assoc()) {
			$temp= (string) str_replace("{{Z_INDEX}}", (string) $z_idx,  $ZGLOSZENIE);
			$temp= (string) str_replace("{{COMMENT}}", (string) $row['comment'], $temp);
			if(strpos(mime_content_type($row['photo_url']),'image')!==false){
				$temp= (string) str_replace("{{MEDIA}}", (string) '<img src="{{EIMG}}" alt="foto">',  $temp);
				$temp= (string) str_replace("{{EIMG}}", (string) $row['photo_url'],  $temp);
			}else{
				$temp= (string) str_replace("{{MEDIA}}", (string) $FILM,  $temp);
				$temp= (string) str_replace("{{EIMG}}", (string) $row['foto_url'],  $temp);
				$temp= (string) str_replace("{{EIMG}}", (string) $row['foto_url'],  $temp);
			}
			$temp= (string) str_replace("{{APP_ID}}", (string) $row['uzytkownik_id'].",".$row['event_id'],  $temp);
			
			$ALL = $ALL.$temp;
			$z_idx--;
		}

		if($res['czy_zakonczone'] == 1 && $res['czy_rozdane'] == 0)
		{
			$ALL .= $PUNKTY;
		}
		else
		{
			$ALL .= $BRAKZGLOSZEN;
		}
	} 
	else 
	{
		if($res['czy_zakonczone'] == 1 && $res['czy_rozdane'] == 0)
		{
			$ALL= (string) str_replace("{{APP_ID}}", (string) $eventID,  $PUNKTY);
		}
		else
		{
			$ALL = $BRAKZGLOSZEN;
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
