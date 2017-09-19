 <?php
     $picsDir = "../../Pic/";
	 
	 $picsFiles = [];
	 
	 $allFiles = scandir($picsDir);
	 //var_dump($allFiles);
	 
	 $picsFiles = array_slice($allFiles, 2);
	 var_dump($picsFiles);
	 
	 $picsCount = count($picsFiles);
	 $picNumb = mt_rand(0,($picsCount -1));
	 $picsFile = $picsFiles[$picNumb]; 
	 
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title> Jaroslava Koger veebiprogrammeerimine </title>
</head>
<body>
  <h1> Foto </hl>
  <p> See leht on loodud õppetöö raames, ning ei sisalda mingit tõsiseltvõetavat sisu </p>
  <img src="<?php echo $picsDir .$picsFile; ?>" alt="Tallinna Ülikool">
  
</body>
</html>