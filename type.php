<?php
  include 'connect.php'; 
  if (isset($_POST['save'])){
  $type_name=$_POST['type_name'];
 /* add new record */   
  $query = "INSERT INTO items_type (type_name)VALUES ( '$type_name' )";
  $result = mysqli_query($conn, $query);
  echo '<meta http-equiv="refresh" content="1;">';}
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
      <div class="forms">
         <div class="table-users cust">
               <!-- add new record form -->
             <div class="header"> إضافة صنف جديد  </div>                             
               <table cellspacing="0">
                   <tr>                                                                                      
                    <th> إسم الصنف</th>
                   </tr>
                   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " method="post"> 
                      <tr>                                    
                         <td class="put"><input name="type_name" required="" type="text"placeholder="أدخل  إسم الصنف"  autofocus /></td>                                   
                      </tr>							   
                      <input type='submit' value='حفظ' name="save" class='btn btn-primary m-r-1em ' />
                      <a href='#select_type'  class='btn btn-danger'>عرض البيانات</a>                                  
                    </form>
                 </table>							
              </div>
       </div>					  
       <?php echo $message; ?>

						  <!-- show records -->
						   <div  class="forms">
                 <div class="table-users" id="select_type">
                   <div class="header"> بيانات الأصناف </div>                           
                            <table cellspacing="0">
                               <tr>
                                 <th>رقم الصنف </th>
                                  <th>إسم الصنف</th>                                                      
                                  <th> الإعدادات</th>
                               </tr>                             
                               <?php
                                 include 'connect.php'; 
                                 /* select type data */
                                 $sql = "SELECT type_id,type_name FROM items_type ";
                                 $result = $conn->query($sql);
                                 if($conn->error){
                                 die($conn->error);}
                                 if ($result->num_rows > 0) {
                                  // output data of each row
                                 while($row = $result->fetch_assoc()) {
                                  // creating new table row per record
                                 echo "<tr>";
                                     echo "<td>{$row["type_id"]}</td>";
                                     echo "<td>{$row["type_name"]}</td>";    
                                     echo "<td>";             
                                     echo "<a href='update_type.php?type_id={$row["type_id"]}' class='button primary edit'></a>";  
                                     /* delete conformation */                 
                                     echo "<a onClick=\"javascript: return confirm('هل انت متأكد من الحذف؟');\" href='delete_type.php?type_id={$row["type_id"]}' class='button primary delete'></a>";
                                     echo "</td>";
                                 echo "</tr>";}}
                                 $conn->close();
                                ?>
                     </div>
                  </div>
                             </table>
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