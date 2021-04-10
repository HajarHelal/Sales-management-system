<?php
 include 'connect.php'; 
 if (isset($_POST['save'])){
 $point_name=$_POST['point_name'];
 $location_x=$_POST['location_x'];
 $location_y=$_POST['location_y'];
 $area_id=$_POST['areas'];
 /* add new reord */ 
 $query = "INSERT INTO points (point_name,location_x,location_y,area_id)
 VALUES ('$point_name','$location_x','$location_y','$area_id')";   
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
     <div class="forms" >
      <div class="table-users" id="poo">
         <!-- add new record form -->
         <div class="header">إضافة خط سير عمل</div>                                   
         <table cellspacing="0">
             <tr>
                 <th>إسم النقطة</th>
                 <th>خطوط العرض</th>
                 <th>خطوط الطول</th>                                     
                 <th>إسم المنطقة</th>
             </tr>                                
             <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                 <tr>
                     <td class="put"><input name="point_name" required="" type="text" autofocus placeholder="أدخل  إسم النقطة" /></td>
                     <td class="put"><input name="location_x" required="" type="text"pattern="[15]{2}[.]{1}[0-9]{6}"  placeholder="**** ***.15"maxlength="9"/></td>                                  
                     <td class="put"><input name="location_y" required="" type="tel" pattern="[44]{2}[.]{1}[0-9]{6}"placeholder="*** ***.44" maxlength="9" /></td>                                      
                     <td class="put">
                       <select name="areas">
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
                 <a href='areas.php'  class='btn btn-info m-r-1em'>إضافة منطقة جديدة</a>
                 <input type='submit' value='حفظ'name="save" class='btn btn-primary m-r-1em onclick="return function(e)" '/>
                 <a href='#slecet_emp'  class='btn btn-danger'>عرض البيانات</a>
             </form>
         </table>
      </div>
    </div>
     <?php echo $message; ?>
       <!-- show records --> 
     <div id="slecet_emp" class="forms">
        <div class="table-users" id="poo">
            <div class="header"> بيانات خطوط السير </div>                           
                <table cellspacing="0">
                    <tr>
                         <th>رقم النقطة</th>
                         <th>إسم النقطة</th>
                         <th>خطوط العرض</th>
                         <th>خطوط الطول</th>                                   
                         <th>إسم المنطقة</th>
                         <th> الإعدادات</th>
                     </tr>                        
         <?php
         function getArea_id ($area_id=""){
              include 'connect.php'; 
              $values=array();
               /* select area data */ 
              $sql = "SELECT *  FROM areas where area_id=' $area_id ' ";
              $result = $conn->query($sql); 
              if($result){
              while( $val=$result->fetch_assoc()){
              $values[]=$val; }}
              return $values;}
              include 'connect.php'; 
              $sql = "SELECT point_id,point_name,location_x,location_y,area_id  FROM points";
              $result = $conn->query($sql);
              if($conn->error){
              die($conn->error);}
              if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
              // creating new table row per record
              echo "<tr>";
              echo "<td>{$row["point_id"]}</td>";
              echo "<td>{$row["point_name"]}</td>";
              echo "<td>{$row["location_x"]}</td>";
              echo "<td>{$row["location_y"]}</td>";
              foreach(getArea_id($row["area_id"]) as $area){
              echo "<td>{$area["area_name"]}</td>"; }    
              echo "<td>";
              echo "<a href='update_point.php?pid={$row["point_id"]}' class='button primary edit'></a>";
              /* delete conformation */ 
              echo "<a onClick=\"javascript: return confirm('هل انت متأكد من الحذف؟');\"  href='delete_point.php?pid={$row["point_id"]}' class='button primary delete'></a>"; 
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