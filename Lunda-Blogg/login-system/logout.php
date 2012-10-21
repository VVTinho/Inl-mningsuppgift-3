<?php
	session_start();
	session_destroy();
	
	// Skapar en sökväg till login_form.php när man loggar ut.  
	header("location: ../login-system/login_form.php"); 
?>