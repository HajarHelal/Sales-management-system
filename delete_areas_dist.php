<?php
include 'connect.php'; 
/* delete road line  record */
$road_id = $_GET['road_id'];
$table = 'road_line';
$query = "DELETE FROM $table WHERE road_id=$road_id";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
header('location: areas-dist.php#select_area_dis');
?>