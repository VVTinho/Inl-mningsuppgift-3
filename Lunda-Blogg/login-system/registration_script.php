<?php
	$host = 'localhost';
	$user = 'root';
	$password = 'root';
	$database = 'blog';
	 
	$conn = mysql_connect($host,$user,$password) or die('Server Information is not Correct'); 
	mysql_select_db($database,$conn) or die('Database Information is not correct');
	  
	$userName = mysql_real_escape_string($_POST['txtUser']);
	 
	$password = mysql_real_escape_string($_POST['txtPassword']);
	 
	// Kryptera lösenordet med md5.
	$password = md5(mysql_real_escape_string ($password));
	 
	if(isset($_POST['btnRegister']))
	{
		$query = "insert into tbladmin(admin_usr_name,admin_pwd)values('$userName','$password')";
		$res = mysql_query($query);
		header('location: ../login-system/success_register.php');
	}
?>