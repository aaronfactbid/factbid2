<?php

$username = "factbid";
$password = "Isgd^9734";
$dbname = "factbid";



// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}


?>