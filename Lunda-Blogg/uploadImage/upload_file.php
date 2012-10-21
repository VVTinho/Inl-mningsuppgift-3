<?php 
	error_reporting(0);
	
	$change="";
	$abc="";
	
	// Filluppladning maxstorlek 10Mb. 
	define ("MAX_SIZE","10000");
	function getExtension($str) 
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	
	 $errors=0;
	  
	 if($_SERVER["REQUEST_METHOD"] == "POST")
	 {
	 	$image =$_FILES["file"]["name"];
		$uploadedfile = $_FILES['file']['tmp_name'];
	     
	 	if ($image) 
	 	{
	 		$filename = stripslashes($_FILES['file']['name']);
	 	
	  		$extension = getExtension($filename);
	 		$extension = strtolower($extension);
			
			
	 		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
	 		{
			
	 			$change='<div class="msgdiv">Odefinerad bild fil</div> ';
	 			$errors=1;
	 		}
	 		else
	 		{
	 			$size=filesize($_FILES['file']['tmp_name']);
	
	
				if ($size > MAX_SIZE*1024)
				{
					$change='<div class="msgdiv">För stor fil!</div> ';
					$errors=1;
				}
		
		
				if($extension=="jpg" || $extension=="jpeg" )
				{
					$uploadedfile = $_FILES['file']['tmp_name'];
					$src = imagecreatefromjpeg($uploadedfile);
				}
	
				else if($extension=="png")
				{
					$uploadedfile = $_FILES['file']['tmp_name'];
					$src = imagecreatefrompng($uploadedfile);
				}
				
				else 
				{
					$src = imagecreatefromgif($uploadedfile);
				}
		
				echo $scr;
		
				list($width,$height)=getimagesize($uploadedfile);

				// Storleken på bilderna som vissas.		
				$newwidth=600;
				$newheight=($height/$width)*$newwidth;
				$tmp=imagecreatetruecolor($newwidth,$newheight);
				
				// Storleken på thumbs bilderna.
				$newwidth1=100;
				$newheight1=($height/$width)*$newwidth1;
				$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
		
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		
				imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
		
				$filename = "../uploadedImages/". $_FILES['file']['name'];

				$filename1 = "../uploadedImages/thumbs/small". $_FILES['file']['name']; 
		
				imagejpeg($tmp,$filename,100);
		
				imagejpeg($tmp1,$filename1,100);
				
				imagedestroy($src);
				imagedestroy($tmp);
				imagedestroy($tmp1);
				
				// Funkar ej.
				// $sql="INSERT INTO images SET images=1"; 
				// $result=mysql_query($sql);
			}
		}
	
	} // Avslutar första if öppnigen if($_SERVER["REQUEST_METHOD"] == "POST"). 
	
	// Om inga fel har uppståt, printa meddelandet.   
	if(isset($_POST['Submit']) && !$errors) 
	{
		// mysql_query("update {$prefix}users set img='$big',img_small='$small' where user_id='$user'");
		$change=' <div class="msgdiv">Bilden har laddats upp!</div>';
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	<meta content="en-us" http-equiv="Content-Language">
	<link rel="stylesheet" href="../stylesheet/style.css" type="text/css"/> <!-- Skapar en sökväg till min style.css. -->
	<title>Ladda upp bilder till Bild-Galleriet</title>    
</head>
<body> <!--  Skapar body. -->
	<div id="container"> <!-- Skapar en container. -->	
		<div align="center" id="err">
			<?php echo $change; ?>  
		</div>
    
		<div id="posts">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $filename; ?>" />  &nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $filename1; ?>"/>
		<form method="post" action="" enctype="multipart/form-data" name="form1">
			Bild:<input size="25" name="file" type="file" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10pt" class="box"/>
			<input type="submit" id="mybut" value="skicka" name="Submit"/>	
			Bildens maxstorlek: 10Mb
 
			Du har laddat upp din bild! Välj en ny bild att ladda upp.

			<div id="dotted-line"></div>

			<div id="page-links"> <!--  Skapar page-links. --> 
				<a href="../index.php">Gå tillbaka till Startsidan &nbsp;</a> <!-- Skapar en länk till lundasidan.php. -->
				<a href="../uploadedImages/uploadedImages.php">Gå tillbaka till Bild-Galleriet</a> <!-- Skapar en länk till BildGalleriet -->
			</div> <!-- Avslutar page-links. -->
			
		</form> 		  
	</div> <!-- Avslutar container. -->          
</body> <!--  Avslutar body. -->
</html>   