<?php

session_start();
?>
<html>
<head>  <!--  Skapar head. -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <!-- Skapar en meta charset=utf-8 för att displaya/visa bokstäverna å,ä ocoh ö. -->
	<link rel="stylesheet" href="../stylesheet/style.css" type="text/css"/> <!-- Skapar en sökväg till min style.css. -->
	<title>LundaBlogg by V.V.T</title> <!-- Skapar en title. -->
</head> <!-- Avslutar head. -->
<body>
	<div id="container"> <!-- Skapar en container. -->
		<h1>LundaBlogg</h1>
		<form id="form1" name="form1" method="post" action="../login-system/login.php">
			<h4>Inloggning för medlemmar</h4>
			<br/> <!-- Skapar en radbrytning. -->
			<br/> <!-- Skapar en radbrytning. -->
			Användarnamn:
			<input type="text" name="username" id="username" />
			Lösenord:
			<input type="password" name="password" id="password" />
			<colspan="2" align="center">
			<input type="submit" name="btnSubmit" id="btnSubmit" value="Log In" /> 
		</form>          
		<br/> <!-- Skapar en radbrytning. -->
		<a href="../login-system/registration_form.php">Registrera dig:</a> 
	</div> <!-- Avslutar container. -->
</body>
</html>