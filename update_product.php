
<?php
 include 'connect.php'; 
 $product_id= $_GET['product_id'];
 if(isset($_POST['save'])) {    
 $type_id=$_POST['type_id'];
 $product_name=$_POST['product_name'];
 $unit_price=$_POST['unit_price'];
 $box_price=$_POST['box_price'];
  /* update product data */
 $query_update = "update product set type_id='$type_id',product_name='$product_name',unit_price='$unit_price', box_price='$box_price' where product_id='$product_id'";
 $result_update =mysqli_query($conn, $query_update);
 if($conn->error){
 die ($conn->error) ;}
 echo '<meta http-equiv="refresh" content="1;url=product.php">';}
 /* select product record */
 $query_update = "SELECT product_id,type_id,product_name,unit_price,box_price  FROM product
 where product_id='$product_id'";
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
	  <script src="js/modernizr.js"></script> <!-- Modernizr -->
    </head>
   <body >
   <?php include 'header.php'; ?>
  
    <div class="forms">
    <?php echo $message; ?>
       <div class="table-users" id="poo" >
          <!-- show slected record data -->
          <div class="header"> تعديل بيانات المنتج </div>                          
             <table cellspacing="0">
                <tr>                                              
                  <th>إسم المنتج</th>
                  <th>سعر الوحدة</th>
                  <th>سعر الكرتون</th> 
                  <th>تصنيف المنتج</th>                                                        
                 </tr>
               <form action="" method="post">
                 <tr>     
                   <td class="put"><input name='product_name' value="<?php echo $row["product_name"];?>"  required=""  type="text" autofocus/></td>
                   <td class="put"><input name='unit_price' value="<?php echo $row["unit_price"];?>"  required=""  type="number" min="0"/></td>
                   <td class="put"><input name='box_price' value="<?php echo $row["box_price"];?>"  required=""  type="number" min="0"/></td>                   				   
                   <td class="put">
                     <select name="type_id">
                       <?php
                          include 'connect.php'; 
                          /* select type name */
                          $sql = "SELECT type_id,type_name FROM items_type";
                          $result = $conn->query($sql);
                         if($conn->error){
                         die($conn->error);}
                         while($row =$result->fetch_assoc()){
                       ?>
                        <?php echo $row['type_name'];?>
                       <option value="<?php echo $row['type_id'];?>">
                          <?php echo $row['type_name'];?>
                        </option>
                        <?php } ?>                            
                     </select>
                   </td>          			                               
                 </tr>                              
                  <input type='submit' value='حفظ التغييرات'name="save" class='btn btn-primary' />
                  <a href='product.php#select_product'class='btn btn-danger'>عرض البيانات</a>                                                
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