
<?php
 include 'connect.php'; 
 if (isset($_POST['save'])) {
 $emp_name=$_POST['emp_name'];
 $phone_num=$_POST['phone_num'];
 $password=$_POST['password'];
 /* add new record */
 $query = "INSERT INTO sales_emp (emp_name, phone_num,password)
 VALUES ( '$emp_name', '$phone_num','$password')";
 $query2="INSERT INTO app_users(phoneNumber,password,type)VALUES ('$phone_num','$password','2')";
 $result = mysqli_query($conn, $query);
 $result2=mysqli_query($conn,$query2);
 echo '<meta http-equiv="refresh" content="1;">';
 }
 isset($result) ? $message = '<p class="message">تم الحفظ بنجاح</p>' : $message = '';
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
    <link  rel="stylesheet" href="headStyle.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styls/style.css">
    <link rel="stylesheet" href="styls/style1.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/modernizr.js"></script>
    </head>
   <body  >
     <?php include 'header.php'; ?>
      <div class="forms">
       <div class="table-users">
           <!-- add new record form -->
            <div class="header">إضافة مندوبين</div>
               <table cellspacing="0">
                 <tr>
                   <th>إسم المندوب</th>                              
                   <th>رقم الهاتف</th>
                   <th>كلمة السر </th>
                 </tr>                       
                 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                   <tr>                           
                     <td class="put"><input name="emp_name"  required="" type="text" placeholder=" أدخل إسم المندوب"  autofocus /></td>
                     <td class="put"><input name="phone_num" required="" type="tel"placeholder=" 73 او 70 او 71 او 77" pattern="[77/71/70/73]{2}[0-9]{7}" maxlength="9"/></td>
                     <td class="put"><input name="password" required="" type="number" placeholder="أدخل كلمة السر للمندوب " /></td>                                
                   </tr>                 
                        <input type='submit' value='حفظ' name="save"class='btn btn-primary m-r-1em ' />
                        <a href='#slecet_emp'  class='btn btn-danger'>عرض البيانات</a>                                                        
                   </form>                           
                </table>
             </div>
         </div>
              <?php echo $message; ?>
              <!-- show records -->
              <div id="slecet_emp" class="forms">
               <div class="table-users">
                 <div class="header"> بيانات المندوبين </div>                           
                    <table cellspacing="0">
                      <tr>                            
                         <th>رقم المندوب</th>
                         <th>إسم المندوب</th>
                         <th>رقم الهاتف</th>
                         <th>كلمة السر</th>
                          <th> الإعدادات</th>
                       </tr>                            
         <?php
           include 'connect.php'; 
           $sql = "SELECT emp_id,emp_name, phone_num,password FROM sales_emp ";
           $result = $conn->query($sql);
           if($conn->error){
           die($conn->error);}
           if ($result->num_rows > 0) {
           // output data of each row
           while($row = $result->fetch_assoc()) {

           // creating new table row per record
           echo "<tr>";
           echo "<td>{$row["emp_id"]}</td>";
           echo "<td>{$row["emp_name"]}</td>";
           echo "<td>{$row["phone_num"]}</td>";
           echo "<td>{$row["password"]}</td>";
           echo "<td>";           
           echo "<a href='update_sales_emp.php?pid={$row["emp_id"]}' class='button primary edit'></a>";
           // delete conformation
           echo "<a onClick=\"javascript: return confirm('هل انت متأكد من الحذف؟');\" href='delete_sales_emp.php?pid={$row["emp_id"]}' class='button primary delete'></a>";
           echo "</td>";
           echo "</tr>";}}
           $conn->close();              
         ?>
       </div>
    </div>
    <!-- scroll to top -->                      
    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
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