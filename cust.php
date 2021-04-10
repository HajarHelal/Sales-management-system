<?php
/* add new record */
include 'connect.php'; 
if (isset($_POST['save'])){
  $point_id=$_POST['point_id'];
  $customer_name=$_POST['customer_name'];
  $phone_num=$_POST['phone_num'];
  $emp_id=$_POST['emp_id'];
  $password=$_POST['password'];
  $query = "INSERT INTO customers (point_id,customer_name,phone_num,emp_id,password)
   VALUES ('$point_id','$customer_name','$phone_num','$emp_id','$password')";
  $query2="INSERT INTO app_users(phoneNumber,password,type)VALUES ('$phone_num','$password','1')";
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styls/style.css">
    <link rel="stylesheet" href="styls/style1.css">
    <link  rel="stylesheet" href="headStyle.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
	 <script src="js/modernizr.js"></script> 
   </head>
   <body id="page-top">
   <?php include 'header.php'; ?>

       <!-- add new record form -->               
   <div class="forms" >
     <div class="table-users" id="poo">
       <div class="header">إضافة عميل</div>
        <table cellspacing="0">
          <tr>
             <th>إسم النقطة التابعة العميل </th>
             <th>إسم العميل</th>
             <th>رقم الهاتف</th>
             <th>إسم المندوب الخاص بالعميل</th>
             <th>كلمة السر</th>
            </tr>
                                 
           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
               <tr>                                                   
                  <td class="put">
                     <select name="point_id">
                       <?php
                        include 'connect.php'; 
                       /* select point name */
                       $sql = "SELECT point_id,point_name FROM points";
                       $result = $conn->query($sql);
                       if($conn->error){
                       die($conn->error);}
                       while($row =$result->fetch_assoc()){
                       ?>
                       <?php echo $row['point_name'];?>

                       <option value="<?php echo $row['point_id'];?>">
                        <?php echo $row['point_name'];?>
                       </option>
                       <?php } ?>                            
                     </select>
                   </td>    
                    <td class="put"><input name="customer_name" required="" type="text"placeholder=" أدخل إسم العميل" autofocus/></td>
                    <td class="put"><input name="phone_num" required="" type="tel"placeholder=" 73 او 70 او 71 او 77" pattern="[71/73/77/70]{2}[0-9]{7}" maxlength="9"  /></td>
                    <td class="put">
                    <select name="emp_id">
                      <?php
                      include 'connect.php'; 
                       /* select emp name */
                     $sql = "SELECT emp_id,emp_name FROM sales_emp";
                     $result = $conn->query($sql);
                     if($conn->error){
                     die($conn->error);}
                     while($row =$result->fetch_assoc()){
                     ?>
                     <?php echo $row['emp_name'];?>
                      <option value="<?php echo $row['emp_id'];?>">
                        <?php echo $row['emp_name'];?>
                       </option>
                     <?php } ?>                            
                   </select>
                  </td> 
                  <td class="put"><input name="password" required="" type="number" placeholder="أدخل كلمة السر للعميل "  /></td>                 
                </tr>
                  <input type='submit' value='حفظ'name="save" class='btn btn-primary m-r-1em  '/>
                  <a href='#slecet_emp'  class='btn btn-danger'>عرض البيانات</a>
             </form>
         </table>
      </div>
    </div>
   <!-- echo a message  -->
   <?php echo $message; ?>

   <!-- show records -->
   <div id="slecet_emp" class="forms">
      <div class="table-users" id="poo">
         <div class="header"> بيانات العملاء   </div>
          <table cellspacing="0">
            <tr>
               <th>رقم العميل</th>
               <th>إسم النقطة</th>
               <th>إسم العميل</th>                                
               <th>رقم الهاتف</th> 
               <th>إسم المندوب</th>                                
               <th> كلمة السر</th>
               <th> الإعدادات</th>
              </tr>                
           <?php
         	   function getpoint_id ($point_id=""){
             include 'connect.php';   
             $values=array();
             $sql = "SELECT point_id,point_name  FROM points where point_id=' $point_id ' ";
             $result = $conn->query($sql);        
             if($result){
               while( $val=$result->fetch_assoc()){
                  $values[]=$val;}}
              return $values;}

             function getemp_id($emp_id=""){
             include 'connect.php'; 
             $values=array();
             $sql = "SELECT emp_id,emp_name FROM sales_emp where emp_id=' $emp_id ' ";
             $result = $conn->query($sql);          
             if($result){
                while( $val=$result->fetch_assoc()){
                    $values[]=$val;}}
               return $values;}

             
             $sql = "SELECT customer_id,point_id,customer_name,emp_id,phone_num,password  FROM customers";
             $result = $conn->query($sql);
             if($conn->error){
             die($conn->error);}
             if ($result->num_rows > 0) {
              // output data of each row
             while($row = $result->fetch_assoc()) {
              // creating new table row per record
             echo "<tr>";
             echo "<td>{$row["customer_id"]}</td>";
             foreach(getpoint_id ($row["point_id"]) as $point){
             echo "<td>{$point["point_name"]}</td>";  }
             echo "<td>{$row["customer_name"]}</td>"; 
             echo "<td>{$row["phone_num"]}</td>";
             foreach(getemp_id($row["emp_id"]) as $emp){
             echo "<td>{$emp["emp_name"]}</td>";  }
             echo "<td>{$row["password"]}</td>";
             echo "<td>";  
             echo "<a href='update_cust.php?pid={$row["customer_id"]}' class='button primary edit'></a>";
             // delete conformation
             echo "<a onClick=\"javascript: return confirm('هل انت متأكد من الحذف؟');\" href='delete_cust.php?pid={$row["customer_id"]}' class='button primary delete'></a>";                
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