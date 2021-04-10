
<?php
     include 'connect.php'; 
     $road_id= $_GET['road_id'];
     if(isset($_POST['save'])) {    
     $emp_id=$_POST['emp_id'];
     $area_id=$_POST['area_id'];
     /* update road line data */
     $query_update = "update road_line set emp_id='$emp_id',area_id='$area_id' where road_id='$road_id'";
     $result_update =mysqli_query($conn, $query_update);
     if($conn->error){
     die($conn->error) ;}
     echo '<meta http-equiv="refresh" content="1;url=areas-dist.php#select_area_dis">';}
     /* select  road line record */
     $query_update = "SELECT road_id,emp_id,area_id  FROM road_line  where road_id='$road_id'";
     $result = $conn->query($query_update);
    if($conn->error){
     die($conn->error);}
    // output data of each row
    $row = mysqli_fetch_assoc($result);
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
	<script src="js/modernizr.js"></script> 
    </head>
    <body >
    <?php include 'header.php'; ?>
    <div class="forms">
      <?php echo $message; ?>
                    <div class="table-users"  >
                         <!-- show slected record data -->
                         <div class="header"> تعديل بيانات التوزيع لخط السير </div>                          
                             <table cellspacing="0">
                                 <tr>                                                                                  
                                     <th>  إسم المندوب</th>
                                      <th>إسم المنطقة </th>                                                        
                                  </tr>
                                 <form action="" method="post">
                                      <tr>                       				   
                                         <td class="put">
                                              <select name="emp_id">                                
                                                       <?php
                                                         include 'connect.php'; 
                                                         /* select employe name */
                                                          $sql = "SELECT emp_id,emp_name FROM sales_emp";
                                                          $result = $conn->query($sql);                                                   
                                                          if($conn->error){                                                   
                                                          die($conn->error);}
                                                          while($row =$result->fetch_assoc()){
                                                       ?>
                                                       <?php echo $row['emp_name'];?>                                                                                                      
                                                         <option select="selected" value="<?php echo $row['emp_id'];?>">                                                   
                                                          <?php echo $row['emp_name'];?>                                                      
                                                         </option>
                                                        <?php } ?>                            
                                                  </select>
                                          </td>    
                                         <td class="put">
                                             <select name="area_id">
                                                    <?php
                                                       include 'connect.php'; 
                                                      /* select area name */
                                                       $sql = "SELECT area_id,area_name FROM areas";
                                                       $result = $conn->query($sql);                                           
                                                       if($conn->error){                                            
                                                       die($conn->error);}
                                                       while($row =$result->fetch_assoc()){
                                                    ?>
                                                     <?php echo $row['area_name'];?>                                                                                        
                                                       <option value="<?php echo $row['area_id'];?>">
                                                        <?php echo $row['area_name'];?>
                                                       </option>
                                                       <?php } ?>                            
                                                </select>
                                          </td>          			                                 
                                    </tr>                        
                                    <input type='submit' value='حفظ التغييرات'name="save" class='btn btn-primary' />
                                    <a href='areas-dist.php#select_area_dis'class='btn btn-danger'>عرض البيانات</a>                                                            
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