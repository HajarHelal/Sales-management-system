<?php
 include 'connect.php'; 
 if (isset($_POST['save'])){	
 $type_id=$_POST['type_id'];
 $product_name=$_POST['product_name'];
 $unit_price=$_POST['unit_price'];
 $box_price=$_POST['box_price'];
  /* add new record */  
 $query = "INSERT INTO product (type_id,product_name,unit_price,box_price)
 VALUES ( '$type_id','$product_name', '$unit_price','$box_price')";   
 $result = mysqli_query($conn, $query);  
 echo '<meta http-equiv="refresh" content="1;url=product.php">';
 }
 isset($result) ? $message = '<p class="message" >تم الحفظ بنجاح</p>' : $message = '';
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
 <div class="forms ">
   <div class="table-users cust">
     <!-- add new record form -->
     <div class="header"> إضافة منتجات</div>                              
         <table cellspacing="0">
             <tr>                                            
							 <th> تصنيف المنتج</th>
               <th>إسم المنتج</th>                                  
               <th> سعر الوحدة</th>
               <th> سعر الكرتون</th>                              
             </tr>
             <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " method="post"> 
               <tr>                                    
                 <td class="put">
                   <select name="type_id">
                     <?php
                       include 'connect.php'; 
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
					       <td class="put"><input name="product_name" required="" type="text" placeholder="أدخل  إسم المنتج"  autofocus/></td>
                 <td class="put"><input name="unit_price" required="" placeholder="أدخل  سعر الوحدة"type="number" min="0"/></td>
                 <td class="put"><input name="box_price" required="" type="number" placeholder="أدخل  سعر الكرتون" min="0"/></td>
               </tr>
               <tr>                                     
                 <input type='submit' value='حفظ' name="save"class='btn btn-primary m-r-1em ' />
                 <a href='#select_product'  class='btn btn-danger'>عرض البيانات</a>
               </tr>
             </form>
        </table>
     </div>
   </div>			  
   <?php echo $message; ?>

   <!-- show records -->
	 <div  class="forms">
       <div class="table-users" id="select_product">
         <div class="header"> بيانات المنتجات </div>                         
           <table cellspacing="0">
             <tr>                   									  
                <th>رقم المنتج</th>
								<th>تصنيف المنتج</th>
                <th>إسم المنتج</th>
                <th>سعر الوحدة</th>
                <th>سعر الكرتون</th>
                <th> الإعدادات</th>
              </tr>                           
         <?php
            function getType_id ($type_id=""){
           include 'connect.php';  
           $values=array();
           /* select item name */
           $sql = "SELECT *  FROM items_type where type_id=' $type_id ' ";
           $result = $conn->query($sql);   
           if($result){
           while( $val=$result->fetch_assoc()){
           $values[]=$val; }}
           return $values;}
           include 'connect.php';  
           /* select products */
           $sql = "SELECT product_id, type_id ,product_name,unit_price, box_price FROM product";
           $result = $conn->query($sql);
           if($conn->error){
           die($conn->error);}
           if ($result->num_rows > 0) {
           // output data of each row
           while($row = $result->fetch_assoc()) {
           // creating new table row per record
           echo "<tr>";
           echo "<td>{$row["product_id"]}</td>";
           foreach(getType_id($row["type_id"]) as $type){
           echo "<td>{$type["type_name"]}</td>"; }
           echo "<td>{$row["product_name"]}</td>";
           echo "<td>{$row["unit_price"]}</td>";
           echo "<td>{$row["box_price"]}</td>";
           echo "<td>";
           echo "<a href='update_product.php?product_id={$row["product_id"]}' class='button primary edit'></a>";
           /* delete conformation */  
           echo "<a onClick=\"javascript: return confirm('هل انت متأكد من الحذف؟');\" href='delete_product.php?product_id={$row["product_id"]}' class='button primary delete'></a>";
           echo "</td>";
           echo "</tr>";} }
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