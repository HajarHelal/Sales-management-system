<?php
//connect db
$host = "localhost";
$db_name = "pr";
$username = "root";
$password = "";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
  
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
// post value
 $name = $_POST['a_name'];
 $password = $_POST['a_pass'];

 if(asset($_POST['login'])){
     
         if(empty($name)) OR empty($password){
             echo '<script> alert("الرجاء ادخال جميع البيانات المطلوبة");</script>';
         }
         else{ 
             $get_admin ="select * from admin where a_name='$name' AND a_pass='$password'";
             $run_admin =mysqli_query($con,$get_admin);
         }
     }

 



?>

<!DOCTYPE html>
<html lang="ar">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">	
 
     <!-- Site Metas -->
    <title>تسجيل الدخول الى لوحة التحكم</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">
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
<body id="page-top" class="politics_version">

   
	

    <div id="contact" class="section db">
        <div class="container-fluid">
            <div class="section-title text-center">
                <h3>تسجيل الدخول</h3>
               
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="contact_form">
                        <div id="message"></div>
                        <form action="login.php" method="post">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="name" name="a_name" type="text" placeholder="اسم المستخدم" required="required" data-validation-required-message="Please enter your name.">
										<p class="help-block text-danger"></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="email" name="a_pass" type="password" placeholder="كلمة المرور" required="required" data-validation-required-message="Please enter your password.">
										<p class="help-block text-danger"></p>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-lg-12 text-center">
									<div id="success"></div>
									<button id="sendMessageButton"  name="login"class="sim-btn hvr-rectangle-out" data-text="دخول" type="submit">تسجيل الدخول</button>
								</div>
							</div>
						</form>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    

   

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