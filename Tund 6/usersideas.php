<?php
	require("functions.php");
	
	
	//kas pole sisse loginud
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//väljalogimine
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}

		if (isset($_POST["ideaButton"])) {
		
			if(isset($_POST["idea"]) and !empty($_POST["idea"])) {
				//echo $_POST["ideaColor"];
				saveIdea($_POST["idea"], $_POST["ideaColor"]);
		
			}
		
		}
		//echo $_SESSION["UserId"];
		//print_r($_SESSION);
		$notice = listAllIdeas();
	//require("usersinfo.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Jaroslava Koger veebiprogrammeerimine</title>
</head>
<body>
	<h1>Head Mõtted</h1>
	<p>See leht on loodud õppetöö raames ning ei sisalda mingit tõsiseltvõetavat sisu.</p>
	<p><a href="?logout=1">Logi välja!</a></p>
	<p><a href="main.php">Pealeht</a></p>
	<hr>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	  <label> Hea mõte: </label>
	  <input name="idea" type="text">
	  <br>
	  <label> Möttega seotud värv: </label>
	  <input name="ideaColor" type="color">
	  <br>
	  <input name="ideaButton" type="submit" value="Salvesta mõte!" >
	  <span><?php echo $notice; ?></span>
	</form>    
	<hr>
	
</body>
</html>