<?php
include 'nav.php';

//võtab row väärtuseks andmebaasis oleva info massiivina(array)
$row = mysqli_fetch_array($query);



if(isset($_POST["idInsert"])) {
	$idInsert=$_POST["idInsert"];
	echo "<meta http-equiv='refresh' content='0'>";
}
//uuenda 100m välja, lõpus lehe refresh
if(isSet($_REQUEST["livingvibrator"])){
   $kask=$yhendus->prepare("UPDATE spordivoistlus SET 100m=? WHERE id=$idInsert ");
   echo $yhendus->error;
 $kask->bind_param("d", $_POST["sadaInsert"]);
 $kask->execute();
echo "<meta http-equiv='refresh' content='0'>";
 //echo $yhendus->error;
 }

//uuenda 1000m välja, lõpus lehe refresh, ühenduse sulgemine
if(isSet($_REQUEST["tiredvibrator"])){
   $kask=$yhendus->prepare("UPDATE spordivoistlus SET 1000m=? WHERE id=$idInsert ");
   echo $yhendus->error;
 $kask->bind_param("d", $_POST["tuhatInsert"]);
 $kask->execute();
 echo "<meta http-equiv='refresh' content='0'>";
 //echo $yhendus->error;
 $yhendus->close();
 exit();
 }



$tuhat = $row['1000m'];
$sada = $row['100m'];
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Jooksutulemused</title>
   </head>
   <body>


     <table class="data-table">
       <caption class="title">Registreeritud inimesed</caption>
       <thead>
         <tr>
           <th>NO</th>
           <th>EESNIMI</th>
           <th>PEREKONNANIMI</th>
           <th>100M (sek)</th>
           <th>1000M (sek)</th>
         </tr>
       </thead>
       <tbody>
       <?php
     $yhendus = mysqli_connect($baasiaadress, $baasikasutaja, $baasiparool, $baasinimi);
//peamine loop, mille true oleku korral laseb baasi andmeid sisestada
while ($row = mysqli_fetch_array($query)) {

//sooritamata ja ühiku kuvamine
    if ($row['100m'] >= 0) {
        $sada = $row['100m'];
   $jooksuaeg = "cm";
       } else {
        $sada = "sooritamata";
   $jooksuaeg = "";
       }

//sooritamata ja ühiku kuvamine. jooksuaeg2 sest vastasel juhul ei kuvataks ühikuid kui 100m tulemus puudu
        if ($row['1000m'] >= 0) {
          $tuhat = $row['1000m'];
     $jooksuaeg2 = "cm";
         } else {
          $tuhat = "sooritamata";
     $jooksuaeg2 = "";
         }

//tabelisse tulemuste kuvamine
         echo '' .'<tr>
             <td>'.$row['id'].'</td>
             <td>'.$row['eesnimi'].'</td>
             <td>'.$row['perekonnanimi'].'</td>
             <td><a class="col-md-6" data-toggle="collapse" href="#sadaInsert1">' .$sada .'</a><span class="col-md-6">'.$jooksuaeg.'</span></td>
             <td><a class="col-md-6" data-toggle="collapse" href="#tuhatInsert1">'.$tuhat.'</a><span class="col-md-6">'.$jooksuaeg2.'</span></td>
           </tr>';
}


    $yhendus->close();
    ?>
       </tbody>
     </table>
     <div class="container">

       <!-- collapse kast andmete sisestamiseks kui klõpsatakse tulemusel -->
       <div class="collapse" id="sadaInsert1">
         <form method="POST">
           <label>ID: </label><input name="idInsert" type="text"></input>
           <label>100M (sek): </label><input name="sadaInsert" type="text"></input>
           <input type="submit" name="livingvibrator" value="saada"></input>
         </form>
       </div>
        <!-- collapse kast andmete sisestamiseks kui klõpsatakse tulemusel -->
       <div class="collapse" id="tuhatInsert1">
         <form method="POST">
           <label>ID: </label><input name="idInsert" type="text"></input>
           <label>1000M (sek): </label><input name="tuhatInsert" type="text"></input>
           <input type="submit" name="tiredvibrator" value="saada"></input>
         </form>
       </div>
     </div>
   </body>
 </html>
