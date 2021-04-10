
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
   	<div  class="forms" >
			 <fieldset style="border: 3px solid #999; ">
          <legend style="color: white; text-align: center; font-weight: bold;  width:30%">مخالفة المرتجعات</legend>					
            <div class="table-users" id="select_v_return">					       
              <div class="header"> إدارة المخالفات </div>                         
                 <table cellspacing="0">
                    <tr>                  
                        <th>الفئة</th>                               
                        <th>كمية المرتجعات نهاية فترة الائتمان للمندوب الواحد بالكرتون</th>
								        <th>الغرامة المخصومة من الحافز بالريال</th>
								        <th>الإعدادات</th>
                     </tr>                         
                    <?php		
                       include 'connect.php'; 
                       /* select violation_returns data */
                       $sql = "SELECT violation_returns_id,decription,percentage FROM violation_returns ";
                       $result = $conn->query($sql);
                       if($conn->error){
                       die($conn->error);}
                       if ($result->num_rows > 0) {
                       // output data of each row
                       while($row = $result->fetch_assoc()) {
                       // creating new table row per record
                       echo "<tr>";
                       echo "<td>{$row["violation_returns_id"]}</td>";
                       echo "<td>{$row["decription"]}</td>";
                       echo "<td>{$row["percentage"]}</td>";
                       echo "<td>";                             
                       echo "<a href='update_v_return.php?violation_returns_id={$row["violation_returns_id"]}' class='button primary edit'></a>";            		 
                       echo "</td>";
                       echo "</tr>";}}
                      $conn->close();      
                   ?>
                 </div>
         </fieldset>
         </div>                       
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