 <?php
     $picsDir = "../../Pic/";
	 $picsFileTypes = ["jpg", "jpeg", "png", "gif"];
	 $picsFiles = [];
	 
	 $allFiles = array_slice(scandir($picsDir), 2);
	 //var_dump($allFiles);
	 foreach ($allFiles as $file){
		 $fileType = pathinfo($file, PATHINFO_EXTENSION);
		 if(in_array($fileType, $picsFileTypes) == true){
			 array_push($picsFiles, $file);
	 
		 }
	 }
	 //$picsFiles = array_slice($allFiles, 2);
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