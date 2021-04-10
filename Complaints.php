
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
	<script src="js/modernizr.js"></script> <!-- Modernizr -->

</head>
<body id="page-top">
   <?php include 'header.php'; ?>
    <div id="slecet_emp" class="forms">
         <div class="table-users cust">
             <!-- display all record -->
            <div class="header"> شكاوى العملاء </div>                           
                <table cellspacing="0">
                    <tr>
                         <th>رقم الشكوى</th>
                          <th>اسم العميل</th>
                          <th>اسم المندوب</th>       
                          <th> تاريخ الشكوى</th>
                          <th>الاعدادات</th>
                     </tr>                 
                      <?php
                          function getecust_id ($customer_id=""){
                          include 'connect.php';                
                          $values=array();
                          /* select customer name */
                          $sql = "SELECT customer_id,customer_name  FROM customers where customer_id=' $customer_id ' ";
                          $result = $conn->query($sql);                
                          if($result){
                           while( $val=$result->fetch_assoc()){
                           $values[]=$val;}}
                           return $values;}
                        
                           function getemp_id ($emp_id=""){
                            include 'connect.php';    
                            $values=array();
                            /* select employe name */
                             $sql = "SELECT emp_id,emp_name  FROM sales_emp where emp_id=' $emp_id ' ";
                             $result = $conn->query($sql);                              
                             if($result){
                             while( $val=$result->fetch_assoc()){
                             $values[]=$val;}}
                             return $values;} 
                            /*   show records  */
                            include 'connect.php'; 
                             $sql = "SELECT a.complaints_id,b.customer_id,b.emp_id,a.complaint_date
                             FROM complaints a JOIN customers b
                             Where a.customer_id=b.customer_id;";
                             $result = $conn->query($sql);                                                        
                             if($conn->error){                            
                             die($conn->error);}                                                                                                                
                             if ($result->num_rows > 0) {
                             // output data of each row
                             while($row = $result->fetch_assoc()) {              
                             // creating new table row per record
                             echo "<tr>";
                             echo "<td>{$row["complaints_id"]}</td>";
                             foreach(getecust_id($row["customer_id"]) as $cust){
                               echo "<td>{$cust["customer_name"]}</td>"; };                    
                              foreach(getemp_id($row["emp_id"]) as $point){
                               echo "<td>{$point["emp_name"]}</td>"; };                                                                                                     
                                echo "<td>{$row["complaint_date"]}</td>";
                                echo "<td>";                                                                                                                                   
                                echo "<a href='complaints_details.php?pid={$row["complaints_id"]}' class='button primary edit'>  عرض التفاصيل</a>";
                                /* delete conformation */
                                echo    "<a onClick=\"javascript: return confirm('هل انت متأكد من الحذف؟');\"  href='delete_complaints.php?pid={$row["complaints_id"]}' class='button primary delete'></a>";                            
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