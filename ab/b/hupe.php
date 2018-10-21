<?php
include 'nav.php';
$row = mysqli_fetch_array($query);
$korgusTulemus = "";


if(isset($_POST["idInsert"])) {
	$idInsert=$_POST["idInsert"];
	echo "<meta http-equiv='refresh' content='0'>";
}

if(isSet($_REQUEST["livingvibrator"])){
   $kask=$yhendus->prepare("UPDATE spordivoistlus SET korgushupe=? WHERE id=$idInsert ");
   echo $yhendus->error;
 $kask->bind_param("i", $_POST["korgusInsert"]);
 $kask->execute();
echo "<meta http-equiv='refresh' content='0'>";
 //echo $yhendus->error;
 }

 
if(isSet($_REQUEST["tiredvibrator"])){
   $kask=$yhendus->prepare("UPDATE spordivoistlus SET kaugus=? WHERE id=$idInsert ");
   echo $yhendus->error;
 $kask->bind_param("i", $_POST["kaugusInsert"]);
 $kask->execute();
 echo "<meta http-equiv='refresh' content='0'>";
 //echo $yhendus->error;
 $yhendus->close();
 exit();
 }



$korgusHupe = $row['korgushupe'];
$kaugus = $row['kaugus'];
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>aa</title>
   </head>
   <body>
     <table class="data-table">
       <caption class="title">Registreeritud inimesed</caption>
       <thead>
         <tr>
           <th>NO</th>
           <th>EESNIMI</th>
           <th>PEREKONNANIMI</th>
           <th>KÕRGUSHÜPE(cm)</th>
           <th>KAUGUSHÜPE(cm)</th>
         </tr>
       </thead>
       <tbody>
       <?php
		  $yhendus = mysqli_connect($baasiaadress, $baasikasutaja, $baasiparool, $baasinimi);
		
         while ($row = mysqli_fetch_array($query))
         {

	 
	 /* $sql = "SELECT korgushupe FROM spordivoistlus WHERE id=$idi ";
			$tulemusKorgus = $yhendus->query($sql);
		 */ 
		 
		 if ($row['korgushupe'] >= 0) {
        $korgusHupe = $row['korgushupe'];
		$huppepikkus = "cm";
       } else {
        $korgusHupe = "sooritamata";
		$huppepikkus = "";
       }

	 	
        if ($row['kaugus'] >= 0) {
          $kaugus = $row['kaugus'];
		  $huppepikkus = "cm";
         } else {
          $kaugus = "sooritamata";
		  $huppepikkus = "";
         }
		
         echo '' .'<tr>
             <td>'.$row['id'].'</td>
             <td>'.$row['eesnimi'].'</td>
             <td>'.$row['perekonnanimi'].'</td>
             <td><a class="col-md-6" data-toggle="collapse" href="#korgusInsert1">' .$korgusHupe .'</a><span class="col-md-6">'.$huppepikkus.'</span></td>
             <td><a class="col-md-6" data-toggle="collapse" href="#kaugusInsert1">'.$kaugus.'</a><span class="col-md-6">'.$huppepikkus.'</span></td>
           </tr>';

       }
	   
	   
	   $yhendus->close();
	   ?>
       </tbody>
     </table>
     <div class="container">
       <div class="collapse" id="korgusInsert1">
         <form method="POST">
           <label>ID: </label><input name="idInsert" type="text"></input>
           <label>Kõrgus(cm): </label><input name="korgusInsert" type="text"></input>
           <input type="submit" name="livingvibrator" value="saada"></input>
         </form>
       </div>
       <div class="collapse" id="kaugusInsert1">
         <form method="POST">
           <label>ID: </label><input name="idInsert" type="text"></input>
           <label>Kaugus(cm): </label><input name="kaugusInsert" type="text"></input>
           <input type="submit" name="tiredvibrator" value="saada"></input>
         </form>
       </div>
     </div>


   </body>
 </html>
