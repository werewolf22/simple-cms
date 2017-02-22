<?php
	session_start();
	function confirm_logged_in(){
		if (!isset($_SESSION['user_id'])) {
		  header("location:login.php");
          exit();
	}
	}
?>