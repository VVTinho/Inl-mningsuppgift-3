<?php
	// Inkludera db.php filen.
	include("../database/db.php");
	
	// Hämtar id från databsen.
	$id = $_GET['id'];
	
	// Tar bort id från databasen.
	$result=mysql_query("DELETE FROM shouts where id=$id");
	
	// Sökväg till index.php sidan.
	header("Location:../index.php");
?>