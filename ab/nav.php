<?php
//asjade jaoks mida kasutatakse igal lehel kasutades include. andmebaasi ühendamine, bootstrap, lehe peamine disain ja menüü elemendid
$baasiaadress="localhost";
$baasikasutaja="if17";
$baasiparool="if17";
$baasinimi="if17_timjaan";
$yhendus=new mysqli($baasiaadress, $baasikasutaja, $baasiparool, $baasinimi);
$kask="";

if (!$yhendus){
 die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql = 'SELECT * FROM spordivoistlus';
$query = mysqli_query($yhendus, $sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Spordivõistlus</title>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <link type="text/css" rel="stylesheet" href="style/main.css"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <style media="screen">
      p {
        color:#c1c1c1;font-size:15px;
      }

      h1 {
        color: #eee;
      }

      h2 {
        color: #c1c1c1
      }

      li {
        color: #c1c1c1;
      }
      </style>
  </head>
  <body style="background:#FFFFFF">



	<div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">


              <li><a href="index.php">Registreerimine  <span class="sr-only">(current)</span></a></li>
              <li><a href="hupe.php">Hüpped</a></li>
              <li><a href="jooks.php">Jooks</a></li>
			        <li><a href="tulemused.php">Tulemused</a></li>
            </ul>
          </div>
 </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
