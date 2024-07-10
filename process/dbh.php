<?php

$servername = "";
$dBUsername = "";
$dbPassword = "";
$dBName = "";

$conn = mysqli_connect($servername, $dBUsername, $dbPassword, $dBName);

if(!$conn){
	echo "Databese Connection Failed";
}

?>