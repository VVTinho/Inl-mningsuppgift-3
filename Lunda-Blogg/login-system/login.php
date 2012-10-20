<?php

	$host = 'localhost'; 
	$user = 'root'; 
	$password = 'root'; 
	$db = 'blog'; 
	
	$link = mysql_connect($host,$user,$password) or die('Error in Server information');

 	mysql_select_db($db,$link) or die('Can not Select Databasse');
	 
	$userName = mysql_real_escape_string($_POST['username']); // Användarnamnet skickat från formuläret. 
	$password = md5(mysql_real_escape_string($_POST['password'])); // Lösenordet skickat från formuläret med md5.
	 
	// Hämtar data från databasen. 
	$query = "select * from tbladmin where admin_usr_name='$userName' and admin_pwd='$password'";
	 
	$res = mysql_query($query); 
	 
	$rows = mysql_num_rows($res);
	
	// Om $userName och $password matchar databasen, så kommer funktionen ovan returnera 1 row.   
	if($rows==1)
	
	// Om användarnamnet och lösenordet matchar så registreras det i databasen och du länkas till index.php sidan. 
	{
		session_start();

		$_SESSION['userName']  =  $row['admin_usr_name'];
		$_SESSION['password'];
		header("location: ../index.php?apa=gorilla");
	}
	else
	{
		echo 'Data Does Not Match <br /> Re-Enter UserName and Password';
	} 
?>