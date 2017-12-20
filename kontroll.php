<?php
	require("../setup.php");
	

?>



<!DOCTYPE html>
<html lang="et">
<head>
<title>Kontrolltöö variant 4</title>
</head>
<body>
<h1>Tänane päev</h1>
<form method="POST" action="/~kogejaro/veebiprogrammeerimine/setup.php">
	<select name="selLang">
		<option value="" selected disabled>Vali keel</option>
		<option value="<?php $id ?>"> <?php $language?> </option> 

	</select>
	<input type="submit" name="selectLanguage" value="kinnita valik">
</form>
</body>
</html>