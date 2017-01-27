	<?php
class Baza{
	function __construct(){ 
		$servername = "localhost";
		$username = "root";
		$password = "foxikrl";
		$dbname = "events";
		$conn = new mysqli($servername, $username, $password, $dbname, '3308');
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}	 
		$this->DB = $conn;
	}
	function filtruj($zmienna){
		if(get_magic_quotes_gpc())
			$zmienna = stripslashes($zmienna);
		return htmlspecialchars(trim($zmienna));
	}
	
	function isLoginInDB($Login){
		$login = $this->filtruj($Login);
		$result= $this->DB->query("SELECT * FROM uzytkownik WHERE login='".$login."'");
		return $result->num_rows!==0;
	}
	
	function tagowanieUzyt($usr, $tags){
		foreach ($tags as &$tag) {
			$result = $this->DB->query("SELECT * FROM `tag` WHERE nazwa like '".$tag."'");
			if($result->num_rows===0){
				$result = $this->DB->query("INSERT INTO `tag`(`nazwa`) VALUES ('".$tag."')");
				$result = $this->DB->query("SELECT * FROM `tag` WHERE nazwa like '".$tag."'");
			}
			$row1 = $result->fetch_assoc();
			$this->DB->query("INSERT INTO `relacja_tag_uzytkownik`(`uzytkownik_id`, `tag_id`) VALUES (".$usr.",".$row1['id'].")");
		}
	}
	
	function tagowanieEvent($event, $tags){
		foreach ($tags as &$tag) {
			$result = $this->DB->query("SELECT * FROM `tag` WHERE nazwa like '".$tag."'");
			if($result->num_rows===0){
				$result = $this->DB->query("INSERT INTO `tag`(`nazwa`) VALUES ('".$tag."')");
				$result = $this->DB->query("SELECT * FROM `tag` WHERE nazwa like '".$tag."'");
			}
			$row1 = $result->fetch_assoc();
			$this->DB->query("INSERT INTO `relacja_event_tag`(`event_id`, `tag_id`) VALUES (".$event.",".$row1['id'].")");
		}
	}
	
	function getTags($str){
		preg_match_all('/#([^\s]+)/', $str, $matches);
		return $matches[1];
	}
	
	function registerUzytkownik($login, $pass, $pass2, $tag, $fl, $typ){
		$login = $this->filtruj($login);
		$pass = $this->filtruj($pass);
		$pass2 = $this->filtruj($pass2);
		$tag = $this->filtruj($tag);
		$fl = $this->filtruj($fl);
		$typ = $this->filtruj($typ);
		if($login==="" || $pass==="" || $pass2==="" || $tag==="" || $typ==="" ){
			return [false,"Wszystkie pola są wymagane"];
		}
		if($pass!==$pass2){
			return [false,"Podałeś dwa inne hasła"];
		}
		if($this->isLoginInDB($login)){
			return [false,"Login zajęty"];
		}
		
		$tags = $this->getTags($tag);
		
		$hashtags = implode(',', $tags);
		$this->DB->query("INSERT INTO uzytkownik (login, haslo, opis, facebook_link, typ) VALUES ('".$login."', '".$pass."', '".$hashtags."', '".$fl."',".$typ.")");
		$result= $this->DB->query("SELECT * FROM uzytkownik WHERE login='".$login."'");
		$row1 = $result->fetch_assoc();
		$this->tagowanieUzyt($row1['id'], $tags);

		
		return [true, $login, $row1['id']];		
	}
	
	function zaloguj($login, $haslo){
		$login = $this->filtruj($login);
		$haslo = $this->filtruj($haslo);
		$result = $this->DB->query("SELECT * FROM uzytkownik WHERE login = '".$login."' AND haslo='".$haslo."'");
		if($result->num_rows===0){
			return [false,"Złe dane"];
		}
		$row1 = $result->fetch_assoc();
		return [true, $login, $row1['id'] ];
	}
	function getEventsStworzonychList($usrID){
		return $this->DB->query("SELECT * FROM event WHERE uzytkownik_id=".$usrID." ORDER BY data_utowrzenia DESC");
	}
	function getEventsUdzialList($usrID){
		return $this->DB->query("Select event.* from event INNER JOIN relacja_event_uzytkownik ON event.id = relacja_event_uzytkownik.event_id where relacja_event_uzytkownik.uzytkownik_id = ".$usrID);
	}
	function getEventsUserTagsList($usrID){
		return $this->DB->query("Select event.* from event INNER JOIN relacja_event_tag ON event.id = relacja_event_tag.event_id INNER JOIN relacja_tag_uzytkownik ON relacja_tag_uzytkownik.tag_id = relacja_event_tag.tag_id where relacja_tag_uzytkownik.uzytkownik_id = ".$usrID);
	}
	function stworzEvent($usrID, $tag, $datazak, $opis, $zdje){		
		$tag = $this->filtruj($tag);
		$datazak = $this->filtruj($datazak);
		$opis = $this->filtruj($opis);
		if($tag==="" || $datazak==="" || $opis==="" ){
			return [false,"Wszystkie pola są wymagane"];
		}
		$x = $this->DB->query("INSERT INTO `event`(`foto_url`, `uzytkownik_id`, `opis`, `data_utowrzenia`, `data_zakonczenia`, `czy_zakonczone`, `czy_sponsorowane`) VALUES ('".$zdje."',".$usrID.",'".$opis."','".Date("Y-m-d H:i:s")."','".$datazak."',0,0)");
		if(!$x)
			return [false, "blad bazy"];
		else{
			$id = $this->DB->insert_id;
			$tags = $this->getTags($tag);
			$this->tagowanieEvent($id, $tags);
		}
	}

	function dodajZgloszenie($usrID, $eventID, $com, $data, $zdje){		
		$com = $this->filtruj($com);
		echo $usrID;
		echo $com;
		echo $data;
		echo $zdje;
		if($com===""){
			return [false,"Wszystkie pola są wymagane"];
		}
		$x = $this->DB->query("INSERT INTO `relacja_event_uzytkownik`(`uzytkownik_id`, `event_id`, `photo_url`, `comment`) VALUES (".$usrID.",".$eventID.",'".$zdje."','".$com."')");
		if(!$x)
			return [false, "blad bazy"];
	}

	function getWolneTagi($userId){
		return $this->DB->query("SELECT * FROM tag WHERE tag.id NOT IN (SELECT tag.id FROM tag INNER JOIN relacja_tag_uzytkownik ON tag.id = relacja_tag_uzytkownik.tag_id WHERE relacja_tag_uzytkownik.uzytkownik_id = ".$userId.")");
	}
	function joinUsetToTag($user, $tag){
		$this->DB->query("INSERT INTO `relacja_tag_uzytkownik`(`uzytkownik_id`, `tag_id`) VALUES (".$user.",".$tag.")");
	}

	function getSingleEvent($id){
		return $this->DB->query("SELECT event.uzytkownik_id, uzytkownik.login, event.opis, event.foto_url, event.data_zakonczenia, event.czy_zakonczone, event.czy_rozdane FROM event, uzytkownik WHERE event.id = ".$id." AND event.uzytkownik_id = uzytkownik.id");
	}

	function getApplies($id){
		return $this->DB->query("SELECT * FROM `relacja_event_uzytkownik` WHERE event_id = ".$id." AND status = 0 ORDER BY data_wyslania ASC");
	}

	function refreshDatabase(){
		return $this->DB->query("UPDATE event SET czy_zakonczone = 1 WHERE NOW() > data_zakonczenia");
	}

	function getPoints($id){
		$row = $this->DB->query("SELECT SUM(punkty) as pkt FROM relacja_event_uzytkownik WHERE uzytkownik_id =".$id);
		$x = $row->fetch_assoc();
		return $x['pkt'];
	}
		
}
?>