<?php
	session_start();
	function isLogin(){
		if (isset($_SESSION['time']) && (time() - $_SESSION['time'] > 3600)) {
			session_unset();  
			session_destroy();
			return false;
		}else{
			if(isset($_SESSION['time'])){
				$_SESSION['time'] = time();
				return true;
			}
		}
		return false;
	}
	if(!isLogin()){
		header("Location: logowanie.php");
	}	
?>
