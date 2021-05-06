<?php

include 'config.php';

$conn = new mysqli("$dbHost", "$dbUsername", "$dbPassword");
//check for connection error
if($conn->connect_error){
die("Could not connect". $conn->connect_error);
}
$conn->select_db("$dbName");

?>