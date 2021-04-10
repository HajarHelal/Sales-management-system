<?php
 include 'connect.php'; 
 if (isset($_POST['save'])){	
 $emp_id=$_POST['emp_id'];
 $area_id=$_POST['area_id'];
 /* add new reord */ 
 $query = "INSERT INTO road_line (emp_id,area_id)
 VALUES ( '$emp_id','$area_id')";   
 $result = mysqli_query($conn, $query);  
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
	<script src="js/modernizr.js"></script> 
    </head>
    <body id="page-top">
      <?php include 'header.php'; ?>
     <div class="forms">
        <div class="table-users cust">
           <!-- add new record form -->
            <div class="header"> إسناد خط السير للمندوبين </div>                                
                <table cellspacing="0">
                     <tr>                                                          
					    <th>  إسم المندوب</th>
                         <th>إسم المنطقة </th>                                                                                                                                         
                     </tr>
                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " method="post"> 
                          <tr>                                    
                              <td class="put">  
                                   <select name="emp_id">
                                      <?php
                                      include 'connect.php'; 
                                      /* select emloye name */
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
                          </tr>                            
                           <tr>                                       
                               <input type='submit' value='حفظ' name="save"class='btn btn-primary m-r-1em ' />
                               <a href='#select_area_dis'  class='btn btn-danger'>عرض البيانات</a>
                              </tr>
                      </form>
                </table>
        </div>                                                        
        </div>							  
         <?php echo $message; ?>

         <!-- show records --> 
            <div  class="forms">
                <div class="table-users" id="select_area_dis">
                    <div class="header"> بيانات خطوط السير </div>                           
                         <table cellspacing="0">
                            <tr>                                                    
                                 <th>  رقم خط السير </th>
                                 <th>  إسم المندوب</th>
                                 <th>إسم المنطقة </th>                                                                     
                                 <th> الإعدادات</th>
                             </tr>
                             <?php
                                 function getSalesEmp_id ($emp_id=""){
                                 include 'connect.php'; 
                                  $values=array();
                                  /* select employe name */
                                  $sql = "SELECT *  FROM sales_emp where emp_id=' $emp_id ' ";
                                  $result = $conn->query($sql);                                    
                                  if($result){
                                  while( $val=$result->fetch_assoc()){
                                  $values[]=$val;}}
                                  return $values;}

                                  function getArea_id ($area_id=""){
                                  include 'connect.php';                                                                                                                                   
                                  $values=array();
                                  /* select area name */
                                   $sql = "SELECT *  FROM areas where area_id=' $area_id ' ";
                                   $result = $conn->query($sql);                                    
                                   if($result){
                                   while( $val=$result->fetch_assoc()){
                                   $values[]=$val;}}
                                  return $values;}
                                  include 'connect.php';   
                                  /* select road line name */
                                   $sql = "SELECT road_id, emp_id ,area_id FROM road_line";
                                   $result = $conn->query($sql);
                                   if($conn->error){
                                   die($conn->error);}
                                   if ($result->num_rows > 0) {
                                   // output data of each row
                                   while($row = $result->fetch_assoc()) {                                 
                                   // creating new table row per record
                                   echo "<tr>";
                                   echo "<td>{$row["road_id"]}</td>";
                                   foreach(getSalesEmp_id($row["emp_id"]) as $emp){
                                    echo "<td>{$emp["emp_name"]}</td>"; }
                                    foreach(getArea_id($row["area_id"]) as $area){
                                    echo "<td>{$area["area_name"]}</td>"; }
                                    echo "<td>";                                                           
                                    echo "<a href='update_areaDis.php?road_id={$row["road_id"]}' class='button primary edit'></a>";                         
                                    echo  "<a href='delete_areas_dist.php?road_id={$row["road_id"]}' class='button primary delete'></a>";
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