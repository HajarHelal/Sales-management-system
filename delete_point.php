<?php
 include 'connect.php'; 
 /* delete point  record */
 $point_id=$_GET['pid'];
 $sql = "delete FROM points where point_id='$point_id'";
 $conn->query($sql);
 if($conn->error){
 die($conn->error);}
 header('location: point.php#slecet_emp');
 $conn->close();
?>