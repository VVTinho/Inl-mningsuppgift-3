<?php
	$mysql_hostname = "localhost"; // Kör servern lokalt.
	$mysql_user = "root"; // Användare.
	$mysql_password = "root"; // Ska alltid stå 'root' om du kör  MAMP (mac).
	$mysql_database = "blog"; // Namnet på din databas.
	
	// Kör koppling till databasen och om du inte kommer åt din databas, så körs 'or die'
	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps något gick fel ...");
	mysql_select_db($mysql_database, $bd) or die("Opps något gick fel ...");
?> 