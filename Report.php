
<!DOCTYPE html>
<html lang="ar">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">	
 
     <!-- Site Metas -->
    <title>نظام تتبع مندوبي المبيعات عن طريق ال GPS واحتساب
      رواتبهم</title>  
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
    <!-- <link  rel="stylesheet" href="report.css"> -->



    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
	<script src="js/modernizr.js"></script> <!-- Modernizr -->

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="page-top">

    
<div class="header_container">
    <ul id="mainNav">
 <li  class="marT"><a href="#">الرئيسية</a></li>
 <li class="marT"><a href="#">إدارة المندوبين والعملاء  <i class="fa fa-caret-down"></i></a>
  <ul>
   <li><a href="sales-emp.php"> إدارة المندوبين</a></li>
   <li><a href="cust.php"> إدارة العملاء</a></li>
  
  </ul>
 </li>
 <li class="marT"><a href="#">المنتجات والأصناف <i id="faa3"class="fa fa-caret-down"></i></a>
  <ul>
   <li><a href="product.php">إدارة المنتجات</a></li>
   <li><a href="type.php">إدارة الأصناف</a></li>
  </ul>
 </li>
 <li class="marT"><a href="#">إدارة الحوافز والمخالفات<i class="fa fa-caret-down"></i></a>
  <ul>
   <li><a href="incentives.php">إدارة الحوافز</a></li>
   <li><a href="violation.php">إدارة المخالفات</a></li>
  </ul>
 </li>
 <li class="marT"><a href="#">خط سير العمل <i id="faa1"class="fa fa-caret-down"></i></a>
 <ul>
   <li><a href="point.php"> إضافة خط سير</a>
</li>
   <li><a href="areas-dist.php">توزيع خطوط السير </a></li>
  </ul>
 </li>
 <!-- <li class="marT"><a href="customer_location.php">موقع العملاء</a></li> -->
 <li class="marT"><a href="#">التقارير <i id="faa2"class="fa fa-caret-down"></i> </a>
 <ul>
   <li><a href="Complaints.php">شكاوى العملاء </a></li>
   <li><a href="">تقرير  </a></li>
  </ul>

</li>
</ul>
<a href="logout.php" class="log marT">تسجيل خروج</a>
<!-- <button class="log marT" href="logout.php">تسجيل الخروج</button> -->
</div>             
    <div class="container">
            <div class="report-box">
            <button class="bot_comp"> البحث عن تقرير المبيعات اليومي للمندوبين</button><br><br>
            <div class="row">
            <div class="col-md-12 ">
                    <form class="emp_report" id="emp_form">
                            <label >اسم المندوب</label>
                            <select name="user">
  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT emp_id,emp_name FROM sales_emp";
$result = $conn->query($sql);

       if($conn->error){

           die($conn->error);
       }
               while($row =$result->fetch_assoc()){
               ?>
                         <?php echo $row['emp_name'];?>


            <option value="<?php echo $row['emp_id'];?>">
             <?php echo $row['emp_name'];?>
            </option>
                    <?php } ?>                            
          </select><br>
                            <label>التاريخ المطلوب</label>
                            <input type="date"  autocomplete="off"  name="date">
                            <!-- <br> <br> -->
                   <!-- <br><br><br> -->
                    </form>
                    
                        </div>
                        </div>

                        <form class="emp_report1" >
                            <label >رقم المندوب</label>
                            <input type="text"  name="user" autocomplete="off" form="emp_form" >
                            <label >اسم المندوب</label>
                            <input type="text"  name="user" autocomplete="off"  form="emp_form">
                            <label>خط السير</label>
                            <input type="text"  autocomplete="off"  name="roadline" form="emp_form"> 
                            <input type='submit' value='حفظ' name="save"class='btn btn-primary m-r-1em ' />
                                       <a href='#select_product'  class='btn btn-danger'>عرض البيانات</a>
                        </form>
                        </div>  










                        <table class="table_report">
	<thead>
		<tr>
    <th><h1>رقم الطلب</h1></th>
      <!-- <th><h1>رقم العميل</h1></th>     -->
			<th><h1>اسم العميل</h1></th>
			<th><h1>اسم النقطة</h1></th>
			<th><h1>المبيعات</h1></th>
		</tr>
	</thead>
	<tbody>
  <?php
  function customer_id($customer_id=""){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pr";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("UTF8");
    
    $values=array();
        $sql = "SELECT *  FROM customers where customer_id=' $customer_id ' ";
        $result = $conn->query($sql);
       
        if($result){
            while( $val=$result->fetch_assoc()){
                $values[]=$val;
        }
    }
    return $values;}
   
       function point_id($point_id=""){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pr";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("UTF8");
    
    $values=array();
        $sql = "SELECT *  FROM points where point_id=' $point_id ' ";
        $result = $conn->query($sql);
       
        if($result){
            while( $val=$result->fetch_assoc()){
                $values[]=$val;
        }
    }
    return $values;}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT a.point_id,b.request_id,b.customer_id ,b.total FROM
  customers a join request b where a.customer_id = b.customer_id ";
$result = $conn->query($sql);

       if($conn->error){

           die($conn->error);
       }




            if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

    // creating new table row per record
    echo "<tr>";
        echo "<td>{$row["request_id"]}</td>";
        foreach(customer_id ($row["customer_id"]) as $customer){
          echo "<td>{$customer["customer_name"]}</td>"; }
          foreach(point_id ($row["point_id"]) as $point){
            echo "<td>{$point["point_name"]}</td>"; }      
        echo "<td>{$row["total"]}</td>";
        echo "<td>";
            


        echo "</td>";
    echo "</tr>";
}
            }
$conn->close();


       
?>
  

        
	</tbody>
</table>
    </div>

                           
                      
                      
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