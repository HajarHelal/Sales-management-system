
<?php
 include 'connect.php'; 
 $covarage_id= $_GET['covarage_id'];
 if(isset($_POST['save'])) {     
 $description=$_POST['description'];
 $percentage=$_POST['percentage'];
 /* update incentives_points_covarage data */
 $query_update  = "update incentives_points_covarage set description='$description',percentage='$percentage' where covarage_id='$covarage_id'";
 $result_update =mysqli_query($conn, $query_update);
 if($conn->error){
 die($conn->error) ;}
 echo '<meta http-equiv="refresh" content="1;url=incentives.php#select_incentives_covarage">';}
 /* select incentives_points_covarage record */
 $query_update = "SELECT covarage_id,description,percentage  FROM incentives_points_covarage  where covarage_id= '$covarage_id'";
 $result = $conn->query($query_update);
 if($conn->error){
 die($conn->error);}
 // output data of each row
 $row = mysqli_fetch_assoc($result);
 isset($result_update) ? $message = '<p class="message">تم تعديل البيانات  بنجاح</p>' : $message = '';
 $conn->close();
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
     <div class="table-users">
          <!-- show slected record data -->
          <div class="header">تعديل بيانات الحافز</div>                           
              <table cellspacing="0">
                  <tr>
                      <th>إجمالي المنافذ الفعلية خلال الشهرين</th>
					<th>(ريال)مبلغ الحافز </th>                                                                
                  </tr>
                  <form action="" method="post">
                      <tr>                               
                          <td class="put"><input name='description' readonly="readonly"   value="<?php echo $row["description"];?>"  required=""  type="text"/></td>
                          <td class="put"><input name='percentage' value="<?php echo $row["percentage"];?>"  required=""  type="number"/></td>
                      </tr>                            
                      <input type='submit' value='حفظ التغييرات'name="save" class='btn btn-primary' />
                      <a href='incentives.php#select_incentives_covarage'class='btn btn-danger'>عرض البيانات</a>                                              
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