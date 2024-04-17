<?php
$server = "localhost:3307";
$user = "root";
$pass = "";
$database = "libraria";
$conn = mysqli_connect($server, $user, $pass, $database);
if(!$conn)
	die("Lidhja nuk u krye: ". mysqli_connect_error());
?>