<?php
$hostname = "";
$username = "";
$password = "";
$database = "";
$port;

$conn = new mysqli($hostname, $username, $password, $database, $port);

if (!$conn) { 
  die("Falha de conexão: " . mysqli_connect_error());
}
?>