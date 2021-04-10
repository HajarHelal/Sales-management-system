<?php
 include 'connect.php'; 
 /* delete product  record */
 $product_id = $_GET['product_id'];
 $table = 'product';
 $query = "DELETE FROM $table WHERE product_id=$product_id";
 $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
 header('location: product.php#select_product');
?>