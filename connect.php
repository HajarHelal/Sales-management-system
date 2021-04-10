<?php

$servername = "localhost";
$username = "root";
$pword = "";
$dbname = "pr";
// Create connection
$conn = new mysqli($servername, $username, $pword, $dbname);
$conn->set_charset("UTF8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}
?>