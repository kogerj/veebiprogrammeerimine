 <?php
   //see on kommentaar, jargmisena paar muutujat
   $myName = "Jaroslava";
   $myFamilyName = "Koger";
   //vaatame, mis kell o ja määrame päeva osa

   $monthNamesEt = ["jaanuar", "veebruar", "marts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
   //var_dump($monthNamesEt);
   //echo $monthNamesEt[1];
   

   $hourNow = date("H");
   echo $hourNow;
   $PartOfDay = " ";
   if ( $hourNow < 8 ){       
       $PartOfDay = " varajane hommik";
	}
   if ( $hourNow >= 8){
       $PartOfDay = " koolipäev";
	}
   if ( $hourNow >  17){
       $PartOfDay = " vaba aeg";
	}
   echo $PartOfDay;
   
   $timeNow = strtotime(date("d.m.y H:i:s"));
   echo $timeNow;
   $schoolDayEnd = strtotime(date("d.m.Y" ." ". "15:45"));
   $toTheEnd = $schoolDayEnd - $timeNow;
   //echo (round($toTheEnd/ 60));
   
   $myBirthyear;
   
   $ageNotice="";
   var_dump($_POST);
   if (isset($_POST["birthYear"]) ){
	   $myBirthyear = $_POST["birthYear"];
	   $myAge=date("Y") - $_POST["birthYear"];
	   //echo $myAge;
	   $ageNotice = "<p>Teie vanus on liigikaudu ". $myAge . "aastat </p>";
	   
	   $ageNotice .= "<p>Olete elanud jargnevatel aastatel:</p>";
	   $ageNotice .= "\n <ul> \n";
	   
	   $yearNow = date("Y");
	   for ($i = $myBirthyear; $i <= $yearNow; $i ++){
	      $ageNotice .="<li>" .$i ."</li> \n";
	   }
	   $ageNotice .= "</ul>";
   }  
	   //tsukell
	  /* for ($i = 0; $i < 5; $i ++) {
	   echo "ha";} */
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title> Jaroslava Koger veebiprogrammeerimine </title>
</head>
<body>
  <h1>
  <?php
       echo $myName ."  ".$myFamilyName;
  
  
   ?>
  JK Veebiprogrammeerimine</h1>
  <p> See leht on loodud õppetöö raames, ning ei sisalda mingit tõsiseltvõetavat sisu </p>

  <?php
      echo "<p>See on esimene jupp PHP abil väljastatud teksti.</p>";
	  echo "<p> Tana on ";
	  echo date("d.m.Y") . " kell lehe avamisel oli " .date("H:i:s") ;
	  echo ". </p>";
	  
  ?>
  
  <h2> Natuke aastaarvudest </h2>
  <form method ="POST">
        <label>Teie sünniaasta: </label>
		<input type="number" name ="birthyear" id="birthyear" min="1900" max="2017" value="
		<?php echo $myBirthyear; ?>">
		<input type="submit" name="submitBirthYear" value="Kinnita">
  </form>
  <?php
      if ($ageNotice !="") {
		  echo $ageNotice;
	  }
  ?>
  
</body>
</html>