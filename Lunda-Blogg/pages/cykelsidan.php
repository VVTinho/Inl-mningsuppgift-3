<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>LundaBlogg av V.V.T</title>
	<link rel="stylesheet" href="../stylesheet/style.css" type="text/css"/>
	<script type="text/javascript" src="../javascript/javascript.js"></script>
</head>
<body>
	<div id="container">
		<h1>LundaBlogg</h1>
		<h5><a href="http://www.vvt-mediadesign.se" title="Vladimir">V.V.T</a> <a href="http://www.vvt-mediadesign.se" title="LundaBlog">LundaBlogg</a> <?php echo date("m/d/y");?> <h5>
		<div id="boxtop"></div>
		<div id="linkedin"> 
			<a href="http://www.linkedin.com"><img src="../images/socialnetwork/linkedin.png" width="36.6" height="36.6" border="0"></a>
		</div>
		<div id="facebook">
			<a href="http://www.facebook.com"><img src="../images/socialnetwork/facebook.png" border="0"></a>
		</div>
		<div id="page-links">   
			<a href="../pages/lundasidan.php">Lunda-Inlägg &nbsp;</a>
			<a href="../pages/kultursidan.php">Kultur-Inlägg &nbsp;</a>
			<a href="../index.php">Startsidan</a>
		</div>
		<div id="dotted-line"></div>
		<div id="content">    
			<?php
			    $self = $_SERVER['PHP_SELF']; 
			    $ipaddress = ("$_SERVER[REMOTE_ADDR]");
			    require_once ('../database/db.php');
				print "<hr width='600' size=4>"; 	    
				
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
				
			    $query = "SELECT * FROM shouts WHERE LOWER(`LundaBlogg`)='Cyklar' ORDER BY `id` DESC";
				$result = @mysql_query("$query") or die('<p class="error">Det blev fel när du försökte hämta blogg inläggen från databasen.</p>');
			        
			    ?><ul><?
				
				// Kör en While loop.
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
					
					print "<hr width='600'>"; 
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
			<br/>
			
			<?php echo "<a href=\"https://en.gravatar.com/site/signup\">Om du inte har ett Gravatar konto, skapa ett Gravatar konto</a>";?>	
		</div>
		<div id="boxbot"></div>
		<input type="button" onclick="popup()" value="Blogg-Policy">
		<a href="../login-system/logout.php">Logga ut</a>
	</div>
</body>
</html>