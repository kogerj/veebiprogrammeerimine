<?php
	require("../config.php");
	$database = "if17_kogejaro";

	
	//alustan sessiooni
	session_start();
	
	//sisselogimise funktsioon
	function signIn($email, $password){
		$notice = "";
		//andmebaasi ühendus
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, firstname, lastname, email, password FROM vpusers WHERE email = ?");
		$stmt->bind_param("s", trim($email));
		$stmt->bind_result($id, $firstnameFromDb, $lastnameFromDb, $emailFromDb, $passwordFromDb);
		$stmt->execute();
		
		//kontrollime vastavust
		if ($stmt->fetch()){
			$hash = hash("sha512", trim($password));
			if ($hash == $passwordFromDb){
				$notice = "Logisite sisse!";
				
				//Määran sessiooni muutujad
				$_SESSION["userId"] = $id;
				$_SESSION["firstname"] = $firstnameFromDb;
				$_SESSION["lastname"] = $lastnameFromDb;
				$_SESSION["userEmail"] = $emailFromDb;
				
				//liigume pealehele
				header("Location: main.php");
				exit();
			} else {
				$notice = "Vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$email .") ei leitud!";
		}
		$stmt->close();
		$mysqli->close();
		return $notice;
	}
	
	//kasutaja andmebaasi salvestamine
	function signUp($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword){
		//loome andmebaasiühenduse
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistame ette käsu andmebaasiserverile
		$stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		//s - string
		//i - integer
		//d - decimal
		$stmt->bind_param("sssiss", $signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
		//$stmt->execute();
		if ($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga : " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
	
	
	
	    function saveIdea ($idea, $color){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO vpuserideas(userid, idea, color) VALUES(?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("iss", $_SESSION ["userId"], $idea, $color);
		if($stmt->execute()){
			$notice = "Mõte on salvestatud!";
			
		}  else {
		 $notice= "Mõtte salvestamisel tekkis viga, " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
		return $notice; 
		}
		
		function listAllIdeas(){
			$ideasHTML = "";
			$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
			$stmt = $mysqli->prepare("SELECT idea, color FROM vpuserideas");
			$stmt->bind_result($idea, $color);
			//$stmt ->bind_param("i", $_SESSION["UserId"]);
			$stmt->execute();
			while ($stmt->fetch()){
				$ideasHTML .='<p style="background-color: ' .$color .'">' .$idea ."</p> \n";
			}
			$stmt->close();
		    $mysqli->close();
		    return $ideasHTML; 
			
		}
		    function latestIdea(){
		    $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		    $stmt = $mysqli->prepare("SELECT idea FROM vpuserideas WHERE id = (SELECT MAX(id) FROM vpuserideas)");
	     	$stmt->bind_result($idea);
	    	$stmt->execute();
		    $stmt->fetch();
		
		    $stmt->close();
		    $mysqli->close();
		    return $idea;
	     }
		
	//sisestuse testimise funktsioon
	function test_input($data){
		$data = trim($data);//eemaldab lõpust tühikud, TAB jne
		$data = stripcslashes($data);//eemaldab "\"
		$data = htmlspecialchars($data); //eemaldab keelatud märgid
		return $data;
	}
	function usersTable(){
		    $usersTable="";
	     	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		    $stmt = $mysqli ->prepare("SELECT firstname, lastname, email, birthday, gender FROM vpusers");
			$stmt->bind_result($firstname, $lastname, $email, $birthday, $gender);
			$stmt->execute();
			$usersTable .='<table border="1" style="border: 1px solid black; border-collapse: collapse">
<tr> 
 <th>eesnimi</th><th>perekonnanimi</th><th>e-posti aadress</th><th>sünnipäev</th><th>sugu</th> 
 </tr> ';
			
			while ($stmt->fetch()){
				if($gender==1) {
					$gender= "Mees";
				
				}else{$gender="Naine";

				}
			$usersTable .="<tr>";
			$usersTable .="<td>".$firstname ."</td><td>" .$lastname ."</td><td>" .$email ."</td><td>" .$birthday ."</td><td>" .$gender ."</td>"; 
		    $usersTable .="</tr>";

			//style="background-color: ' .$color .'">' .$idea ."</p> \n";	
				
			 /*echo($fistname);
			 echo($lastname);
			 echo($email);
			 echo($birthday);
			 echo($gender);*/
			}
			$usersTable.="</table>";

		    $stmt->close();
		    $mysqli->close();
		    return $usersTable;
        }
	/*$x = 4;
	$y = 9;
	echo "Esimene summa on: " .($x + $y);
	addValues();
	
	function addValues(){
		echo "Teine summa on: " .($x + $y);
		echo "Kolmas summa on: " .($GLOBALS["x"] + $GLOBALS["y"]);
		$a = 1;
		$b = 2;
		echo "Neljas summa on: " .($a + $b);
	}
	echo "Viies summa on: " .($a + $b);*/
?>