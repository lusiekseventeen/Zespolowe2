<?php
	if(isset($_POST['user_id']) && isset($_POST['event_id']))
	{
		$servername = "localhost";
		$username = "root";
		$password = "foxikrl";
		$dbname = "events";
		$conn = new mysqli($servername, $username, $password, $dbname, '3308');

		if($_POST['dec'] == "yes")
		{
			$conn->query("UPDATE relacja_event_uzytkownik SET status = 1, czy_zatwierdzona = 1 WHERE uzytkownik_id = ".$_POST['user_id']." AND event_id = ".$_POST['event_id']);
			echo "Accepted";
		}
		elseif($_POST['dec'] == "no") 
		{
			$conn->query("UPDATE relacja_event_uzytkownik SET status = 1 WHERE uzytkownik_id = ".$_POST['user_id']." AND event_id = ".$_POST['event_id']);
			echo "Deleted";
		}

		
	}
?>