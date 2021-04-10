
 <?php
     function getCustomer_id ($customer_id=""){
        include 'connect.php'; 
      $values=array();
          $sql = "SELECT customer_id,customer_name FROM customers where customer_id=' $customer_id ' ";
          $result = $conn->query($sql);
          if($result){
              while( $val=$result->fetch_assoc()){
                  $values[]=$val;
          }
      }
      return $values;}
      function getpoint_id ($point_id=""){
        include 'connect.php'; 
        
        $values=array();
            $sql = "SELECT point_id,point_name FROM points where point_id=' $point_id ' ";
            $result = $conn->query($sql);
           
            if($result){
                while( $val=$result->fetch_assoc()){
                    $values[]=$val;
              
        
            }
        }
        return $values;}
        function getSales_id ($emp_id=""){
            include 'connect.php';            
            $values=array();
            $sql = "SELECT emp_id,emp_name  FROM sales_emp where emp_id=' $emp_id ' ";
           
            $result = $conn->query($sql);
               
                if($result){
                    while( $val=$result->fetch_assoc()){
                        $values[]=$val;
                }
            }
            return $values;}
            include 'connect.php'; 
 
 

$complaints_id= $_GET['pid'];
if($_POST) {
     
    $customer_id=$_POST['customer_id'];
    $complaints_description=$_POST['complaints_description'];
    $complaint_date=$_POST['complaint_date'];
    $emp_id=$_POST['emp_id'];
    $point_id=$_POST['point_id'];


    $sql = "update complaints set customer_id='$customer_id',point_id='$point_id',complaint_date='$complaint_date' ,emp_id='$emp_id',complaints_description='$complaints_description'
     where complaints_id='$complaints_id'";
    $result =$conn->query($sql);
    if($conn->error){
        die
        ($conn->error) ;
    }
}
//$sql = "SELECT complaints_id,customer_id,complaints_description,complaint_date  FROM complaints  where complaints_id= '$complaints_id'";
$sql = "SELECT 	a.complaints_id,a.customer_id,a.complaints_description,a.complaint_date,b.point_id,b.emp_id
FROM complaints a JOIN customers b 
Where a.customer_id=b.customer_id AND complaints_id='$complaints_id' ";

$result = $conn->query($sql);

       if($conn->error){

           die($conn->error);
       }
    // output data of each row
    $row = $result->fetch_assoc();

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
        
    <div class="box">
                 <button class="bot_comp"> تفاصيل شكوى العميل</button> 
                 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="comp"><br>
                    <label for="num_comp">رقم الشكوى:</label>
                    <input type="text" name='complaints_id' value="<?php echo $row["complaints_id"];?>"><br>
                    <label for="name_comp">اسم العميل:</label>
                    <input type="text" name='customer_name' value="<?php foreach(getCustomer_id($row["customer_id"]) as $customer){
                     echo "{$customer["customer_name"]}"; }?>"><br>
                    <label for="name_comp">اسم النقطة:</label>
                    <input type="text" name='point_id' value="<?php foreach(getpoint_id($row["point_id"]) as $point){
                     echo "{$point["point_name"]}"; } ?>"><br>
                    <label   id="datte1" for="name_comp">اسم المندوب:</label>
                    <input  id="dattee1"type="text" name='emp_id' value="<?php foreach(getsales_id($row["emp_id"]) as $emp){
                     echo "{$emp["emp_name"]}"; }?>"><br>
                    <label id="datte" for="date_comp">تاريخ الشكوى:</label>
                    <input id="dattee" type="text" name='complaint_date' value="<?php echo $row["complaint_date"];?>"><br>
                    <label id="massege_compla" for="description_comp" >وصف الشكوى:</label>
                    <input id="massege_comp" name='complaints_description' value="<?php echo $row["complaints_description"];?> "> 
                 </form>


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