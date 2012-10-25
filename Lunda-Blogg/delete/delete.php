<?php
	// Inkludera db.php filen.
	include("../database/db.php");
	
	// $id = hämtar/$_GET id.
	$id = $_GET['id'];
	
	// Tar bort inlägg från databasen.
	$result=mysql_query("DELETE FROM shouts WHERE id=$id");
	
	// Sökväg till index.php sidan.
	header("Location:../index.php");
?>