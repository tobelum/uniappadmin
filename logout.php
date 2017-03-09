<?php
	session_start();
	session_destroy();
	
	// include_once("applicantsajax.php");
	
	header("Location: index.html");
?>