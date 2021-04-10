<?php
 include 'connect.php'; 
 /* delete type  record */
 $type_id = $_GET['type_id'];
 $table = 'items_type';
 $query = "DELETE FROM $table WHERE type_id=$type_id";
 $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
 header('location: type.php#select_type');
?>