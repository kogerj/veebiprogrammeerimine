<?php
include 'nav.php';

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

 if(isSet($_REQUEST["reg"])){
    $kask=$yhendus->prepare(
        "INSERT INTO spordivoistlus(eesnimi, perekonnanimi) VALUES (?,?)");
	$kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
	$kask->execute();
  //echo $yhendus->error;
	$yhendus->close();
	header("Location: $_SERVER[PHP_SELF]?lisatudeesnimi=$_REQUEST[eesnimi]");
	exit();
  }


 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>aa</title>
	 <title>Displaying MySQL Data in HTML Table</title>
	 <link type="text/css" rel="stylesheet" href="style/main.css"/>
   </head>
   <body>
     <form method="GET">
       <label>Eesnimi</label><input type="text" name="eesnimi" value="">
       <label>Perekonnanimi</label><input type="text" name="perekonnanimi" value="">
       <input type="submit" name="reg" value="saada">
     </form>
     <?php
      if(isset($_REQUEST["lisatudeesnimi"])){
        echo "Lisati $_REQUEST[lisatudeesnimi]";
      }

      ?>

			<!-- TABLE TEST -->


	<table class="data-table">
		<caption class="title">Registreeritud inimesed</caption>
		<thead>
			<tr>
				<th>NO</th>
				<th>EESNIMI</th>
				<th>PEREKONNANIMI</th>


			</tr>
		</thead>
    
		<tbody>
		<?php
		
		while ($row = mysqli_fetch_array($query))
		{
			
			
			
			echo '' .'<tr>
					<td><a href="?' .$row['id'] .$row['eesnimi'] .$row['perekonnanimi'].'">' .$row['id'].'</a></td>
					<td>'.$row['eesnimi'].'</td>
					<td>'.$row['perekonnanimi'].'</td>

				</tr>' .'</a>';
				
		}?>
		</tbody>


	</table>

   </body>
 </html>
