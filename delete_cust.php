<?php
 include 'connect.php'; 
 $customer_id=$_GET['pid'];
 /* delete as a user */
 $sql2 ="delete FROM app_users WHERE phoneNumber = (SELECT phone_num  from customers where customer_id='$customer_id') ";
 $conn->query($sql2);
 /* delete customer record */
 $sql = "delete FROM customers where customer_id='$customer_id'";
 $conn->query($sql);
  if($conn->error){
     die($conn->error);}
    header('location: cust.php#slecet_emp');
 $conn->close();
?>