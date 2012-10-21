<?php
	$iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
	if(stripos($_SERVER['HTTP_USER_AGENT'],"Android") && stripos($_SERVER['HTTP_USER_AGENT'],"mobile"))
	{
		$Android = true;
	}
	else if(stripos($_SERVER['HTTP_USER_AGENT'],"Android"))
	{
		$Android = false;
		$AndroidTablet = true;
	}
	else
	{
		$Android = false;
		$AndroidTablet = false;
	}
	$webOS = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
	$BlackBerry = stripos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
	$RimTablet= stripos($_SERVER['HTTP_USER_AGENT'],"RIM Tablet");
	
	
	// Gör något med denna information.
	if( $iPod || $iPhone )
	{
		// Vilken kod ska vara här.
	}
	else if($iPad)
	{
		<link rel="stylesheet" href="../stylesheet/ipad.css" type="text/css"/> <!-- Skapar en sökväg till min ipad.css. -->
	}
	else if($Android)
	{
		<link rel="stylesheet" href="../stylesheet/android.css" type="text/css"/> <!-- Skapar en sökväg till min android.css. -->
	}
	else if($AndroidTablet)
	{
        <link rel="stylesheet" href="../stylesheet/androidtablet.css" type="text/css"/> <!-- Skapar en sökväg till min androidtablet.css. -->
	}
	else if($webOS)
	{
        <link rel="stylesheet" href="../stylesheet/webos.css" type="text/css"/> <!-- Skapar en sökväg till min webos.css. -->
	}
	else if($BlackBerry)
	{
        <link rel="stylesheet" href="../stylesheet/blackberry.css" type="text/css"/> <!-- Skapar en sökväg till min blackberry.css. -->
	}
	else if($RimTablet)
	{
        <link rel="stylesheet" href="../stylesheet/blackberrytablet.css" type="text/css"/> <!-- Skapar en sökväg till min blackberrytablet.css. -->
	}
	else
	{
        // Om det inte är en mobil eller tablet enhet.
	}
?>