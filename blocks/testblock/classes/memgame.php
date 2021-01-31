<?php

$log_directory = './img';

$results_array = array();

$db = mysqli_connect("localhost", "root", "", "moodle"); 
  
$res=mysqli_query($db,"select * from mdl_media_animal");

while($row=mysqli_fetch_array($res)){
	$results_array[]=$row['animal_image_path'];
	$results_array[] = $row['animal_name'];
	$results_array[] = $row['animal_audio_path'];

}


//Output findings
$output = json_encode($results_array);
$output = str_replace("\\/", "/", $output);
header('Content-Type: application/json'); // THIS IS IMPORTANT! It tells Javascript that the body of the returned information is JSON.
echo $output;
		
?>
