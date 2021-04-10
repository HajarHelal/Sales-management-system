<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$complaints_id=$_GET['pid'];
$sql = "delete FROM complaints where complaints_id='$complaints_id'";
 $conn->query($sql);

       if($conn->error){

           die($conn->error);
       }





    // output data of each row


    // creating new table row per record
    header('location:Complaints.php#slecet_emp');
    $conn->close();
?>