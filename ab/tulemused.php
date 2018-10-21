<?php
include 'nav.php';
$row = mysqli_fetch_array($query);
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Lõpptulemused</title>
   </head>
   <body>

     <table class="data-table">
   		<caption class="title">Võistlejate tulemused</caption>
   		<thead>
   			<tr>
   				<th>NO</th>
   				<th>EESNIMI</th>
   				<th>PEREKONNANIMI</th>
          <th>KÕRGUSHÜPE (cm)</th>
          <th>KAUGUSHÜPE (cm)</th>
          <th>100M (sek)</th>
          <th>1000M (sek)</th>

   			</tr>
   		</thead>

   		<tbody>
<?php

$korgusHupe = $row['korgushupe'];
$kaugus = $row['kaugus'];
$sada = $row['100m'];
$tuhat = $row['1000m'];

while ($row = mysqli_fetch_array($query)){
  if ($row['korgushupe'] >= 0) {
     $korgusHupe = $row['korgushupe'];
 $huppepikkus = "cm";
    } else {
     $korgusHupe = "sooritamata";
 $huppepikkus = "";
    }


     if ($row['kaugus'] >= 0) {
       $kaugus = $row['kaugus'];
   $huppepikkus2 = "cm";
      } else {
       $kaugus = "sooritamata";
   $huppepikkus2 = "";
      }

    if ($row['100m'] >= 0) {
       $sada = $row['100m'];
   $jooksuaeg = "sek";
      } else {
       $sada = "sooritamata";
   $jooksuaeg = "";
      }


       if ($row['1000m'] >= 0) {
         $tuhat = $row['1000m'];
     $jooksuaeg2 = "cm";
        } else {
         $tuhat = "sooritamata";
     $jooksuaeg2 = "";
        }



   			echo '' .'<tr>
   					<td>' .$row['id'].'</td>
   					<td>'.$row['eesnimi'].'</td>
   					<td>'.$row['perekonnanimi'].'</td>
            <td><span class="col-md-6">'.$korgusHupe.'</span><span class="col-md-6">'.$huppepikkus.'</span></td>
            <td><span class="col-md-6">'.$kaugus.'</span><span class="col-md-6">'.$huppepikkus2.'</span></td>
            <td><span class="col-md-6">'.$sada.'</span><span class="col-md-6">'.$jooksuaeg.'</span></td>
            <td><span class="col-md-6">'.$tuhat.'</span><span class="col-md-6">'.$jooksuaeg2.'</span></td>

   				</tr>';

}?>
   		</tbody>


   	</table>
   </body>
 </html>
