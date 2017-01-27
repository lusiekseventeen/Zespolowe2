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
	else if (isset($_POST['eid'])) 
	{
		$servername = "localhost";
		$username = "root";
		$password = "1234";
		$dbname = "events";
		$conn = new mysqli($servername, $username, $password, $dbname);

		$points = array(15, 10, 5);
		$i = 0;

		$result = $conn->query("SELECT * FROM `relacja_event_uzytkownik` WHERE czy_zatwierdzona = 1 AND event_id = ".$_POST['eid']." ORDER BY data_wyslania ASC");

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				if($i < 3)
				{
					$conn->query("UPDATE relacja_event_uzytkownik SET punkty = ".$points[$i]." WHERE uzytkownik_id = ".$row['uzytkownik_id']." AND event_id = ".$row['event_id']);
				}
				else
				{
					$conn->query("UPDATE relacja_event_uzytkownik SET punkty = 1 WHERE uzytkownik_id = ".$row['uzytkownik_id']." AND event_id = ".$row['event_id']);
				}
				$i++;
			}
		}
		$conn->query("UPDATE event SET czy_rozdane = 1 WHERE id=".$_POST['eid']);
	}
?>