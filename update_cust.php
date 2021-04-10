
<?php
 include 'connect.php'; 
 /* update applicaton user data */
 $customer_id= $_GET['pid'];
 if(isset($_POST['save'])) {    
 $point_id=$_POST['point_id'];
 $customer_name=$_POST['customer_name'];
 $phone_num=$_POST['phone_num'];
 $emp_id=$_POST['emp_id'];
 $password=$_POST['password'];
 /* update user data*/
 $query_update2 = "update app_users set phoneNumber='$phone_num',password='$password'  
   WHERE phoneNumber = (SELECT phone_num  from customers where customer_id='$customer_id') ";
 $result_update2 =mysqli_query($conn, $query_update2);
 /* update customer record */
 $query_update = "update customers set point_id='$point_id',customer_name='$customer_name',phone_num='$phone_num', emp_id='$emp_id' ,password='$password' where customer_id='$customer_id'";
 $result_update =mysqli_query($conn, $query_update);
    if($conn->error){
     die($conn->error) ;}
   echo '<meta http-equiv="refresh" content="1;url=cust.php">';}

   /* select customer record  */
 $query = "SELECT customer_id,point_id,customer_name,phone_num,emp_id,password  FROM customers
  where customer_id='$customer_id'";
 $result = mysqli_query($conn, $query);
    if($conn->error){
     die($conn->error);}
    // output data of each row
  $row = mysqli_fetch_assoc($result);
  $pid=$row["point_id"];
  $cname=$row["customer_name"];
  $ph=$row["phone_num"];
  $pw=$row["password"];
  $emp=$row["emp_id"];
  isset($result_update) ? $message = '<p class="message">تم تعديل البيانات  بنجاح</p>' : $message = '';
?>

<!DOCTYPE html>
 <html lang="ar">
   <!-- Basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">      
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0">	 
   <!-- Site Metas -->
   <title>نظام إدارة مندوبي المبيعات </title>  
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- Site Icons -->
   <link rel="shortcut icon" href="images/salesLogo.png" type="image/x-icon" />
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- Site CSS -->
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="styls/style.css">
   <link rel="stylesheet" href="styls/style1.css">
   <link  rel="stylesheet" href="headStyle.css">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/custom.css">
	 <script src="js/modernizr.js"></script> <!-- Modernizr -->

   </head>
   <body >
   <?php include 'header.php'; ?>
   <div class="forms">
     <?php echo $message; ?>
       <div class="table-users" id="poo" >
         <!-- show slected record data -->
         <div class="header">تعديل بيانات العميل </div>
           <table cellspacing="0">
               <tr>
               <th>إسم النقطة</th>                                                                              
               <th>إسم العميل</th>                                                             
               <th>رقم الهاتف</th>
               <th>إسم المندوب</th>
               <th> كلمة السر</th>                                                      
               </tr>
               <form action="" method="post">
                 <tr>  
                   <td class="put">
                       <select name="point_id" >
                         <?php
                           include 'connect.php'; 
                           /* show point name */
                           $sql = "SELECT point_id,point_name FROM points";
                           $result = mysqli_query($conn, $sql); 
                           if($conn->error){
                           die($conn->error);}
                           while($row =$result->fetch_assoc()){
                          ?>
                         <?php echo $row['point_name'];?>
                         <option value="<?php echo $pid;?>">
                          <?php echo $row['point_name'];?>
                          </option>
                          <?php } ?>                            
                       </select>
                     </td>   
                   <td class="put"><input name='customer_name' value="<?php echo$cname;?>"  required=""  type="text" autofocus/></td>
                   <td class="put"><input name="phone_num" value="<?php echo $ph;?>"  required=""   type="tel"pattern="[71/73/77/70]{2}[0-9]{7}" maxlength="9"/></td>
                   <td class="put">
                       <select name="emp_id">
                         <?php
                         include 'connect.php'; 
                         /* show employe name */
                         $sql = "SELECT emp_id,emp_name FROM sales_emp";
                         $result = $conn->query($sql);
                         if($conn->error){
                         die($conn->error);}
                         while($row =$result->fetch_assoc()){
                         ?>
                         <?php echo $row['emp_name'];?>
                         <option value="<?php echo $emp?>">
                          <?php echo $row['emp_name'];?>
                         </option>
                          <?php } ?>                            
                       </select>
                     </td>    
                   <td class="put"><input name="password" required="" type="number" value="<?php echo $pw;?>"  /></td>   
                 </tr>                       
                  <input type='submit' value='حفظ التغييرات'name="save" class='btn btn-primary' />
                  <a href='cust.php#slecet_emp'class='btn btn-danger'>عرض البيانات</a>                                                                  
                </form>         
             </table>
         </div>                          
    </div>

    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
	   <!-- Camera Slider -->
	  <script src="js/jquery.mobile.customized.min.js"></script>
	  <script src="js/jquery.easing.1.3.js"></script> 
	  <script src="js/parallaxie.js"></script>
	  <script src="js/headline.js"></script>
	  <script src="js/owl.carousel.js"></script>
	  <script src="js/jquery.nicescroll.min.js"></script>
	  <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>

  </body>
</html>