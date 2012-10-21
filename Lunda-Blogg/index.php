<?php
	session_start();
?>
<!DOCTYPE HTML> <!--  Skapar doctype html. -->
<head> <!--  Skapar head. -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <!-- Skapar en meta charset=utf-8 för att displaya/visa bokstäverna å,ä ocoh ö. -->
	<title>LundaBlogg by V.V.T</title> <!-- Skapar en title. -->
	<link rel="stylesheet" href="stylesheet/style.css" type="text/css"/> <!-- Skapar en sökväg till min style.css. -->
	<script type="text/javascript" src="javascript/javascript.js"></script> <!-- Skapar en sökväg till javascript.css. -->
</head> <!-- Avslutar head. -->
<body> <!-- Skapar body. -->
	<div id="container"> <!-- Skapar en container. -->
		<h1>LundaBlogg</h1>
		<!-- Skapar länkar + vissar ut dagens datum. -->  
		<h5><a href="http://www.vvt-mediadesign.se" title="Vladimir">V.V.T</a> <a href="http://www.vvt-mediadesign.se" title="LundaBlog">LundaBlogg</a> <?php echo date("m/d/y");?></h5>
		<div id="boxtop"></div>
		<div id="linkedin"> <!-- Skapar en länk till linkedin. -->
			<a href="http://www.linkedin.com"><img src="images/socialnetwork/linkedin.png" width="36.6" height="36.6" border="0"></a> <!-- Skapar en länk till linkedin.se. -->
		</div> <!-- Avslutar linkedin. -->
		<div id="facebook"> <!-- Skapar en länk till facebook. -->
			<a href="http://www.facebook.com"><img src="images/socialnetwork/facebook.png" border="0"></a>
		</div> <!-- Avslutar facebook. -->
		<div id="page-links"> <!--  Skapar page-links. --> 
			<a href="pages/lundasidan.php">Lunda-Inlägg &nbsp;</a> <!-- Skapar en länk till lundasidan.php. -->
			<a href="pages/kultursidan.php">Kultur-Inlägg &nbsp;</a> <!-- Skapar en länk till kultursidan.php. -->
			<a href="pages/cykelsidan.php">Cykel-Inlägg</a> <!-- Skapar en länk till cykelsidan.php. -->
		</div> <!-- Avslutar page-links. -->
		<div id="image-link"> <!--  Skapar image-link. --> 
			<a href="uploadedImages/uploadedImages.php">Bild-Galleri</a> <!-- Skapar en länk till lundasidan.php. -->
		</div> <!-- Avslutar image-link. -->
		<div id="dotted-line"></div>
		<div id="content"> <!--  Skapar content. -->
			<?php
				/*if(getenv('DOCUMENT_ROOT') == "Applications/MAMP/htdocs/databas/db.php")
				{ 
				  include 'database/db.php'; // kollar om du jobbar lokalt på en Mac dator.
				}
				else
				{
				  // om inte så är du på en webbserver och måste helst lägga databaskopplingsfilen i en mapp som är säker, eller inte readable för andra än owner ...
				  include('database/db.php')  
				}*/
				
				// setcookie('site_user', '<secure_hash>', time()+(3600*24*7)); // Inlogningen är slut.
				
			    $self = $_SERVER['PHP_SELF']; 
			    $ipaddress = ("$_SERVER[REMOTE_ADDR]");
			    require_once ('database/db.php'); // Skapar en sökväg till db.php.
 				
				print "<hr width='600' size=4>"; // Skapar en vit radbrytning som är 600 width och size 4.	    
				
				// Skapar mysql_connect till $mysql_hostname, $mysql_user och $mysql_password.
			    $connect = mysql_connect($mysql_hostname,$mysql_user,$mysql_password) or die('<p class="error">Det går ej att komma åt databasen just nu.</p>');
			    
				// Skapar en connect/koppling till min databas $mysql_database.
			    mysql_select_db($mysql_database,$connect) or die('<p class="error">Det går ej att komma åt databasen just nu.</p>');
				
				// Kör $sql="UPDATE shouts SET likes =  likes +1 WHERE id = '".$_POST['id']."'"; om ($_POST['Gilla']) som det är.
				if($_POST['Gilla']) 
				{	
					// Uppdatera shouts tabellen rad likes med +1
					$sql="UPDATE shouts SET likes =  likes +1 WHERE id = '".$_POST['id']."'"; 
					$result=mysql_query($sql);
				}
				
				// Checkar och ser om du har skrivit in något i fälten.
			    if(isset($_POST['send'])) 
				{
					// Om du hinte har skrivit in något i fälten så körs "Du har inte skrivit in all text".
		            if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['lund']) || empty($_POST['LundaBlogg']) || empty($_POST['post']))   
					{
		                echo('<p class="error">Du har inte skrivit in all text.</p>');
		            }
					// Om alla fält är ifyllda, kör koden nedan. 
					else 
					{
				        $name = htmlspecialchars(mysql_real_escape_string($_POST['name'])); 
				        $email = htmlspecialchars(mysql_real_escape_string($_POST['email']));
						$lund = htmlspecialchars(mysql_real_escape_string($_POST['lund']));
						$LundaBlogg = htmlspecialchars(mysql_real_escape_string($_POST['LundaBlogg']));
						$date = date("Y-m-d H:i:s"); // Skapar en variabel $date som är lika med date (år, månad, dag, timme).
				        $post = htmlspecialchars(mysql_real_escape_string($_POST['post']));
				        
						// Skickar in namn, email, date, lund = topic texten och den valda kategorin till databasen.    	
		                $sql = "INSERT INTO shouts SET name='$name', email='$email', date='$date', lund='$lund', LundaBlogg='$LundaBlogg', post='$post', ipaddress='$ipaddress';";  
		        
		                if (mysql_query($sql)) 
						{
							// Om det går att posta inlägget vissas texten nedan.
		                	echo('<p class="success">Tack för ditt inlägg!</p>');
		                } 
						else 
						{
							// Om det inte går att posta inlägget vissas texten nedan. 
		                	echo('<p class="error">Något blev fel när du försökte posta ditt inlägg</p>');
		                }
					}
				} // Avslutar if(isset($_POST['send'])) satsen.
				
				// Hämtar alla blogg inlägg från PhpMyAdmin från shouts tabellen och vissar max 8st blogg inlägg.
			    $query = "SELECT * FROM shouts ORDER BY `id` DESC LIMIT 8;";
			    $result = mysql_query($query) or die('<p class="error">Det blev fel när du försökte hämta blogg inläggen från databasen.</p>');
    			
			    ?><ul><? // Skapar en unordered list.

					// Skapar en while loop.	
				    while ($row = mysql_fetch_array($result)) 
					{
			            $ename = stripslashes($row['name']);
			            $eemail = stripslashes($row['email']);
						$ebox = stripslashes($row['lund']);
						$ecategori = stripslashes($row['LundaBlogg']);
			            $epost = stripslashes($row['post']);
						// Hämtar Gravatar bild när du fyller i din mail adress.
			            $grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5(strtolower($eemail))."&size=70";
		 				
						// Vissar ut allt inom echo parantesrena.
			            echo
						(
							'<li> <!-- Skapar en lista. -->
								<div class="datum">
									'.$row['date'].' <!-- Vissar ut datumen när inläggen är skapade -->
								</div>
								<div class="meta">
									<img src="'.$grav_url.'" alt="Gravatar" /><p>'.$ename.'</p>  <!-- Hämtar Gravatar bilden och vissar ut bilden. -->
								</div>
								<div class="shout">
									<p>'.$epost.'</p>
								</div>
								<div class="topic">
									<p>'.$ebox.'</p> <!-- Vissar ut text inlägget. -->
								</div>	
								<div class="categori">
									<p>Kategori: '.$ecategori.'</p> <!-- Vissar ut text Kategori: + den valda kategorin. -->
								</div>
							</li>' // Avsluta listan.
						);
						

						// Skapat en Gilla submit knapp.
						?>
							<h4>
							<form action="<?php echo $self?>" method="POST">
								<input type="hidden" name="id" value="<?php echo $row['id']?>"/>
								<input type = "submit" name="Gilla" value = 'Gilla'"/>
							</form>
							</h4>
							<?
							echo "<h4> <a href=\"delete/delete.php?id=$res[id]\"> Radera Inlägg</a> </h4>";
							?>
						<?
						
						echo "Antal Gilla: " .$row['likes']; // Vissar ut/echo antal 'likes' i inläggen.
						
						// Laddar upp/vissar en bild på en tumme-upp och skriver ut en text.
						if($_POST['Gilla'] && $_POST['id'] == $row['id'])
						{
							echo '<img src="images/tummen-upp.png"/>'; // Vissar ut en bild på en tumme upp.
							echo "Du har Gillat detta inlägg.";
						}

						echo "<hr width='600'>"; // Skapar en vit rand som är 600 width. 
					}

			    ?></ul><? // Avslutar unordered list.
				 echo ("<h3> Välkommen ". $_SESSION['userName'] . "</h3>");

		    ?>
						
		    <form action="<?php $self ?>" method="post"> <!-- Skapar en form. -->
			    <h2>LundaBlogg</h2>
			    <div class="fname"><label for="name"><p>Namn:</p></label><input name="name" type="text" cols="20" onkeyup="EnforceMaximumLength(this,12)"/></div>
			    <div class="femail"><label for="email"><p>Epost:</p></label><input name="email" type="text" cols="20"/></div>
				<div class="where"><label for="lund"><p>Skriv ditt blogg ämne:</p></label><input name="lund" type="text" cols="20" onkeyup="EnforceMaximumLength(this,40)"/></div>
			    <p>Starta tråden med att posta något:</p><textarea name="post" rows="5" cols="40" onkeyup="EnforceMaximumLength(this,110)"></textarea> <!-- Skapar en textarea. -->
			    </br> <!-- Skapar en radbrytning. -->
				</select><br/>
					<p>Välj kategori som du vill lägga din post i:</p>
					<!-- Skapar en dropdown meny med tre värden/value. --> 
					<select name="LundaBlogg" size="1"> <!--  Namnet på dropdown menyn + size = hur många rader som ska visas. -->
					<option value="Lund">Lund</option>
					<option value="Cyklar">Cyklar</option>
					<option value="Kultur">Kultur</option>
				</select>
				</br> <!-- Skapar en radbrytning. -->
				</br> <!-- Skapar en radbrytning. -->
				<input name="send" type="hidden"/>
				<p><input type="submit" value="skicka"/></p> <!-- Skapar en submit knapp. -->
		    </form> <!-- Avslutar en form. -->

			<!--  Skapar en form som laddar upp bilder. -->
			<form action="uploadImage/upload_file.php" method="post" enctype="multipart/form-data"> 
				<label for="file">Ladda upp en bild till Bild-Galleriet:</label>
				<input type="file" name="file" id="file" />
				<input type="submit" name="submit" value="Ladda upp"/> 
			</form> <!-- Avslutar en form. -->
			
			<br/> <!-- Skapar en radbrytning. -->
		
			<?php echo "<a href=\"https://en.gravatar.com/site/signup\">Om du inte har ett Gravatar konto, skapa ett Gravatar konto</a>";?>	<!-- Skapat en länk till Gravatar. -->
		</div> <!--  Avslutar content. -->
		<div id="boxbot"></div> <!-- Skapat en boxbot som användes i cssen (stylesheet). --> 
		<input type="button" onclick="popup()" value="Blogg-Policy"> <!-- Skapat en input type="button" som kör funktionen popup(). -->
		<a href="login-system/logout.php">Logga ut</a> <!-- Skapat en länk som länkas till login.php sidan. -->
	</div> <!--  Avslutar container. -->
</body> <!-- Avslutar body. -->
</html> <!-- Avslutar doctype html. -->