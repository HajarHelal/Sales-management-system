<?php
 include 'connect.php'; 
 $emp_id=$_GET['pid'];
 /* delete user */
 $sql2 ="delete FROM app_users WHERE phoneNumber = (SELECT phone_num  from sales_emp where emp_id='$emp_id') ";
 /* delete sales employe record */
 $sql = "delete FROM sales_emp where emp_id='$emp_id'";
 $conn->query($sql2);
 $conn->query($sql);
  if($conn->error){
   die($conn->error);}
 header('location: sales-emp.php#slecet_emp');
 $conn->close();
?>