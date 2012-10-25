<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<!-- Om du stannar på sidan mer än 10 min skickas du till login formuläret. --> 
	<meta http-equiv="refresh" content = "600; url=http://www.dailyinfo.se/Lunda-Blogg/login-system/login_form.php">
	<title>LundaBlogg av V.V.T</title>
	<link rel="stylesheet" href="../stylesheet/style.css" type="text/css"/>
	<script type="text/javascript" src="../javascript/javascript.js"></script>
</head>
<body>
	<div id="container"> <!-- Skapar en container. -->
		<h1>LundaBlogg</h1>
		<h5><a href="http://www.vvt-mediadesign.se" title="Vladimir">V.V.T</a> <a href="http://www.vvt-mediadesign.se" title="LundaBlog">LundaBlogg</a> <?php echo date("m/d/y");?> <h5>
		<div id="boxtop"></div>
		<div id="linkedin"> 
			<a href="http://www.linkedin.com"><img src="../images/socialnetwork/linkedin.png" width="36.6" height="36.6" border="0"></a>
		</div>
		<div id="facebook">
			<a href="http://www.facebook.com"><img src="../images/socialnetwork/facebook.png" border="0"></a>
		</div>
		<div id="page-links"> <!--  Skapar page-links. --> 
			<a href="../pages/lundasidan.php">Lunda-Inlägg &nbsp;</a>
			<a href="../pages/cykelsidan.php">Cykel-Inlägg &nbsp;</a>
			<a href="../index.php">Startsidan</a>
		</div> <!-- Avslutar page-links. -->
		<div id="image-link"> <!--  Skapar image-link. --> 
			<a href="../uploadedImages/uploadedImages.php">Bild-Galleri</a> <!-- Skapar en länk till lundasidan.php. -->
		</div> <!-- Avslutar image-link. -->
		<div id="dotted-line"></div>
		<div id="content">    
			<?php
			    $self = $_SERVER['PHP_SELF']; 
			    $ipaddress = ("$_SERVER[REMOTE_ADDR]");
			    require_once ('../database/db.php');
				print "<hr size=4>"; 	    
				
			    $connect = mysql_connect($mysql_hostname,$mysql_user,$mysql_password) or die('<p class="error">Det går ej att komma åt databasen just nu.</p>');
			    
			    mysql_select_db($mysql_database,$connect) or die('<p class="error">Det går ej att komma åt databasen just nu.</p>');
	
			    if(isset($_POST['send'])) 
				{
		            if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['lund']) || empty($_POST['LundaBlogg']) || empty($_POST['post']))   
					{
		                echo('<p class="error">Du har inte skrivit in all text.</p>');
		            } 
					else 
					{
				        $name = htmlspecialchars(mysql_real_escape_string($_POST['name'])); 
				        $email = htmlspecialchars(mysql_real_escape_string($_POST['email']));
						$lund = htmlspecialchars(mysql_real_escape_string($_POST['lund']));
						$LundaBlogg = htmlspecialchars(mysql_real_escape_string($_POST['LundaBlogg'])); 
				        $post = htmlspecialchars(mysql_real_escape_string($_POST['post']));
				            	
		                $sql = "INSERT INTO shouts SET name='$name', email='$email', lund='$lund', LundaBlogg='$LundaBlogg', post='$post', ipaddress='$ipaddress';";  
		        
		                if (@mysql_query($sql)) 
						{
		                	echo('<p class="success">Tack för ditt inlägg!</p>');
		                } 
						else 
						{
		                	echo('<p class="error">Något blev fel när du försökte posta ditt inlägg</p>');
		                }
					}
				}
				
			    $query = "SELECT * FROM shouts WHERE LOWER(`LundaBlogg`)='Kultur' ORDER BY `id` DESC";
				$result = @mysql_query("$query") or die('<p class="error">Det blev fel när du försökte hämta blogg inläggen från databasen.</p>');
			        
			    ?><ul><?
	
			    while ($row = mysql_fetch_array($result)) 
				{
		            $ename = stripslashes($row['name']);
		            $eemail = stripslashes($row['email']);
					$ebox = stripslashes($row['lund']);
					$ecategori = stripslashes($row['LundaBlogg']);
		            $epost = stripslashes($row['post']);
		            $grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5(strtolower($eemail))."&size=70";
	 				
		            echo
					(
						'<li>
							<div class="meta">
								<img src="'.$grav_url.'" alt="Gravatar" /><p>'.$ename.'</p>
							</div>
							<div class="shout">
								<p>'.$epost.'</p>
							</div>
							<div class="topic">
								<p>'.$ebox.'</p>
							</div>	
							<div class="categori">
								<p>Kategori: '.$ecategori.'</p>
							</div>
						</li>'
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
							echo "<h4> <a href=\"../delete/delete.php?id=$res[id]\"> Radera Inlägg</a> </h4>";
						?>
					<?
					
					echo "Antal Gilla: " .$row['likes']; // Vissar ut/echo antal 'likes' i inläggen.
					
					// Laddar upp/vissar en bild på en tumme-upp och skriver ut en text.
					if($_POST['Gilla'] && $_POST['id'] == $row['id'])
					{
						echo '<img src="../images/tummen-upp.png"/>'; // Vissar ut en bild på en tumme upp.
						echo "Du har Gillat detta inlägg.";
					}
					
					echo "<hr>"; 
				}
				
			    ?></ul><?
				
		    ?> 
				
		    <form action="<?php $self ?>" method="post">
			    <h2>LundaBlogg</h2>
			    <div class="fname"><label for="name"><p>Namn:</p></label><input name="name" type="text" cols="20"/></div>
			    <div class="femail"><label for="email"><p>Epost:</p></label><input name="email" type="text" cols="20"/></div>
				<div class="where"><label for="lund"><p>Skriv ditt blogg ämne:</p></label><input name="lund" type="text" cols="20"/></div>
			    <p>Starta tråden med att posta något:</p><textarea name="post" rows="5" cols="40"></textarea>
			    </br>
				</select><br/>
					<p>Välj kategori som du vill lägga din post i:</p>
					<select name="LundaBlogg" size="1">
					<option value="Lund">Lund</option>
					<option value="Cyklar">Cyklar</option>
					<option value="Kultur">Kultur</option>
				</select>
				</br>
				</br>
				<input name="send" type="hidden"/>
				<p><input type="submit" value="skicka"/></p>
		    </form>

			<!--  Skapar en form som laddar upp bilder. -->
			<form action="../uploadImage/upload_file.php" method="post" enctype="multipart/form-data"> 
				<label for="file">Ladda upp en bild till Bild-Galleriet:</label> <!--  Skapar en titel för formen. -->
				<input type="file" name="file" id="file" />
				<input type="submit" name="submit" value="Ladda upp" id="bild_button"/> <!-- Skapar en submit knapp (Ladda upp). --> 
			</form> <!-- Avslutar en form. -->

			<br/> <!-- Skapar en radbrytning. -->
			
			<?php echo "<a href=\"https://en.gravatar.com/site/signup\">Om du inte har ett Gravatar konto, skapa ett Gravatar konto</a>";?>	
		</div>
		<<div id="boxbot"><h6>Copyright 2012 vvt-mediadesign.se</h6></div> <!-- Skapat en boxbot som användes i cssen (stylesheet). --> 
		<input type="button" onclick="popup()" value="Blogg-Policy">
		<a href="../login-system/logout.php">Logga ut</a>
	</div>
</body>
</html>