<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$db = "accholder";
// Create a database connection
$con = mysqli_connect($server, $username, $password, $db);
?>