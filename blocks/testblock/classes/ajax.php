<?php

$filenum = 0;

$allowedExts = array("mp4","wmv","mpeg","MP4");
$temp = explode(".", $_FILES["myFile"]["name"]);
$extension = end($temp);
$imagefile= $_GET['image'];
$name = $_POST['name'];

if (
	$_FILES["myFile"]["type"] == "video/x-ms-wmv"||
	$_FILES["myFile"]["type"] == "video/x-ms-mp4"||
	$_FILES["myFile"]["type"] == "video/x-mpeg"||
	$_FILES["myFile"]["type"] == "video/mp4"
	&&
	in_array($extension, $allowedExts)
	)
  	{
		
		if(($_FILES["myFile"]["size"])<=51242880)
		{

			$fileName = $_FILES["myFile"]["name"]; // The file name
			$fileTmpLoc = $_FILES["myFile"]["tmp_name"]; // File in the PHP tmp folder
			$fileType = $_FILES["myFile"]["type"]; // The type of file it is
			$fileSize = $_FILES["myFile"]["size"]; // File size in bytes
			$fileErrorMsg = $_FILES["myFile"]["error"]; // 0 for false... and 1 for true
			
      $outputfile= "audio_dir/"+$name+".mp3" ;

 
      if (file_exists($outputfile)) {
          $outputfile = time() . "_" . $outputfile;
      } else {
          $outputfile = $outputfile;
      }
    
	 // $test = "ffmpeg -i $outputfile -ab 160k -ac 2 -ar 44100 -vn bub.wav";
      
      $output = shell_exec("ffmpeg -i $fileTmpLoc -ab 160k -ac 2 -ar 44100 -vn $outputfile");
	
      echo "sucess";
		}
		else
		{
		  echo "File size exceeds 5 MB! Please try again!";
		}
}
else
{
	echo "PHP! Not a video! ";//.$extension." ".$_FILES["uploadimage"]["type"];
	}

// $q = $_REQUEST["q"];
// $file = escapeshellcmd($q);


// $output = shell_exec("ffmpeg -i $file -ab 160k -ac 2 -ar 44100 -vn bub.wav");






?>