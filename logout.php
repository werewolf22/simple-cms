<?php 
	session_start();
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(),0,time()-42000,'/');
	}
	session_destroy();
	header("location: login.php?logout=1");
	exit();
?>