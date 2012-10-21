<!DOCTYPE HTML>
<head> <!--  Skapar head. -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <!-- Skapar en meta charset=utf-8 för att displaya/visa bokstäverna å,ä ocoh ö. -->
	<title>LundaBlogg by V.V.T</title> <!-- Skapar en title. -->
	<link rel="stylesheet" href="../stylesheet/style.css" type="text/css"/> <!-- Skapar en sökväg till min style.css. -->
	<script type="text/javascript" src="../javascript/javascript.js"></script> <!-- Skapar en sökväg till javascript.css. -->
</head> <!-- Avslutar head. -->
<body>
	<div id="container"> <!-- Skapar en container. -->
		<h1>LundaBlogg</h1>

		<!-- Skapar länkar + vissar ut dagens datum. -->  
		<h5><a href="http://www.vvt-mediadesign.se" title="Vladimir">V.V.T</a> <a href="http://www.vvt-mediadesign.se" title="LundaBlog">LundaBlogg</a> <?php echo date("m/d/y");?></h5> 
		
		<?php 
			$files = glob("../uploadedImages/[bB]*.{jpg,png,gif,bmp}", GLOB_BRACE);
			for ($i=0; $i<count($files); $i++)
			{
				$num = $files[$i];
				echo '<img src="'.$num.'" alt="Lunda-Bilder" />'."<br/><br/><br/><br/>";
			}
		?>
		<div id="page-links"> <!--  Skapar page-links. --> 
			<a href="../imagegallary/imagesA.php">Bilder-A &nbsp;</a> <!-- Skapar en länk till imagesA.php. -->
			<a href="../imagegallery/imagesC.php">Bilder-C &nbsp;</a> <!-- Skapar en länk till imagesC.php. -->
			<a href="../imagegallery/imagesD.php">Bilder-D</a> <!-- Skapar en länk till imagesD.php. -->
		</div> <!-- Avslutar page-links. -->
		
		<a href="../uploadedImages/uploadedImages.php">Se alla bilder</a> <!-- Skapar en länk till uploadedImages.php. -->
		
		<div id="image-link"> <!--  Skapar image-link. --> 
			<a href="../index.php">Gå tillbaka till bloggen</a> <!-- Skapar en länk till index.php. -->
		</div> <!-- Avslutar image-link. -->
		
		<input type="button" onclick="popup()" value="Blogg-Policy"> <!-- Skapat en input type="button" som kör funktionen popup(). -->
		<a href="../login-system/logout.php">Logga ut</a> <!-- Skapat en länk som länkas till logut.php sidan. -->

	</div> <!-- Avslutar container. -->
</body>
</html>