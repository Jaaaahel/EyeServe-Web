<?php
require 'database.php';
//We define a constant with the path to audio 
define('PATH','/recordings/');

//We store the audio file name in database
//$result = $con->query("INSERT INTO table(audio_name) VALUES('audio1.mp3')");

//To get values from database you can do this
//$audiomp3 = $con->query("SELECT audio_name FROM table WHERE audio_name = 'audio1.mp3'")->fetch_object()->audio_name;
$audiomp3 = "freaky.mp3";
//Full path to audio file
$audiomp3 = PATH . $audiomp3;

//And we create a audio element
$element = "";
$element .= "<audio controls>";
$element .= "<source src='$audiomp3' type='audio/ogg'>";
$element .= "Your browser does not support the audio element.";
$element .= "</audio>";

//Displaying audio element
echo $element;
?>