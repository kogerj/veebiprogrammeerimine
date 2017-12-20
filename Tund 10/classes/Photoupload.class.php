<?php
     class Photoupload {
		/* public $testPublic;
		 private $testPrivate;*/
		 //protected
		 private $tempFile;
		 private $imageFileType;
		 private $myTempImage;
		 private $myImage;
		 
		 
		 function __construct($tempFile, $fileType){
			/* $this->testPublic = "Täitsa avalik asi!";
			 $this->testPrivate = $x;
			// echo $this->$testPrivate;*/
			$this->tempFile = $tempFile;
			$this->imageFileType = $fileType;
			
		 }
		 
		 
		 private function createImage(){
			 
			 //lähtudes failitüübist, loome pildiobjekti
				if($this->imageFileType == "jpg" or $imageFileType == "jpeg"){
					$this->myTempImage = imagecreatefromjpeg($this->tempFile);
				}
				if($this->imageFileType == "png"){
					$this->myTempImage = imagecreatefrompng($this->tempFile);
				}
				if($this->imageFileType == "gif"){
					$this->myTempImage = imagecreatefromgif($this->tempFile);
				}
			 
			 
			 
		}
		 
	 
	 public function resizePhoto($maxWidth, $maxHeight){
		 $this->createImage();
		 //originaalsuurus
				$imageWidth = imagesx($this->myTempImage);
				$imageHeight = imagesy($this->myTempImage);
				
				$sizeRatio = 1;
				if($imageWidth > $imageHeight){
					$sizeRatio = $imageWidth / $maxWidth;
				} else {
					$sizeRatio = $imageHeight / $maxHeight;
				}
				
				//muudame suurust
				$this->myImage = $this->resizeImage($this->myTempImage, $imageWidth, $imageHeight, round($imageWidth / $sizeRatio), round($imageHeight / $sizeRatio));
				
		 
		 
	    }
		private function resizeImage($image, $origW, $origH, $w, $h){
		$newImage= imagecreatetruecolor($w, $h);
		//säiletame läbipaistevuse png piltide jaoks
		imagesavealpha ($newImage, true);
		$transColor = imagecolorallocatealpha($newImage, 0,0,0,127);
		imagefill($newImage,0,0, $transColor);
		imagecopyresampled($newImage, $image, 0, 0, 0, 0, $w, $h, $origW, $origH);
		return $newImage;
	      }
	 
	 
	 
	 public function addWatermark($watermarkFile, $marginRight, $marginBottom){
		 //lisame vesimärgi
				$stamp = imagecreatefrompng($watermarkFile);
				$stampWidth = imagesx($stamp);
				$stampHeight = imagesy($stamp);
				$stampPosX = imagesx($this->myImage) - $stampWidth - $marginRight;
				$stampPosY = imagesy($this->myImage) - $stampHeight - $marginBottom;
				imagecopy($this->myImage, $stamp, $stampPosX, $stampPosY, 0, 0, $stampWidth, $stampHeight);
		 
		 
	    }
	 
	 public function addTextWatermark($text){
		 //lisame ka teksti
			$textColor = imagecolorallocatealpha($this->myImage,255,255,255,60);//0.127
			imagettftext($this->myImage,20,0,10,25,$textColor,"../../graphics/ARIALBD.TTF", $text);
				
	    }
	 
	 
	 public function savePhoto($directory, $filename){
		 $target_file = $directory .$filename;
	 //salvestame pildifaili
				if($this->imageFileType == "jpg" or $imageFileType == "jpeg"){
					if(imagejpeg($this->myImage, $target_file, 90)){
						$notice = "Fail laeti üles!";
					} else {
						$notice = "Vabandust! Faili üleslaadimisel tekkis viga!";
					}
				}
				if($this->imageFileType == "png"){
					if(imagepng($this->myImage, $target_file, 90)){
						$notice = "Fail laeti üles!";
					} else {
						$notice = "Vabandust! Faili üleslaadimisel tekkis viga!";
					}
				}
				if($this->imageFileType == "gif"){
					if(imagegif($this->myImage, $target_file, 90)){
						$notice = "Fail laeti üles!";
					} else {
						$notice = "Vabandust! Faili üleslaadimisel tekkis viga!";
					}
				}
		        return $notice;
	 }
	 
	 public function clearImages(){
		        imagedestroy($this->myTempImage);
				imagedestroy($this->myImage);
				
		 
		}
		
	public function saveOriginal(){
           $target_file= $directory .$filename;
		   if (move_uploaded_file($this->tempFile, $target_file)) {
					$notice .= "Originaalfail laeti üles! ";
					
				} else {
					$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
				}
				return $notice;


    }	
	 }//class lõppeb
	 


?>