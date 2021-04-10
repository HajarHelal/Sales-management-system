<?php
 include 'connect.php'; 
 /* delete area  record */
 $area_id=$_GET['pid'];
 $sql = "delete FROM areas where area_id='$area_id'";
 $conn->query($sql);
 if($conn->error){
 die($conn->error);}
 header('location: areas.php#slecet_emp');
 $conn->close();
?>