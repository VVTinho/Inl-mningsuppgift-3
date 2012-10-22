<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <!-- Skapar en meta charset=utf-8 för att displaya/visa bokstäverna å,ä ocoh ö. -->
	<link rel="stylesheet" href="../stylesheet/style.css" type="text/css"/> <!-- Skapar en sökväg till min style.css. -->
	<title>Registrera dig:</title>
</head>
<body>
	<div id="container"> <!-- Skapar en container. -->
		<h1>LundaBlogg</h1>
		<h4>Registreringsformulär:</h4>
		<form id="form1" name="form1" method="post" action="../login-system/registration_script.php">
			Användarnamn:
			<input type="text" name="txtUser" id="txtUser"/>
			Lösenord:
			<input type="password" name="txtPassword" id="txtPassword"/>
			<input type="submit" name="btnRegister" id="btnRegister" value="Registrera dig"/>
		</form>
	</div> <!-- Avslutar container. -->
</body>
</html>