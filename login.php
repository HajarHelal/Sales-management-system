<?php
session_start();
?>

<html>
    <head>
    <title>نظام إدارة مندوبي المبيعات </title>   
        <link rel="stylesheet" type="text/css" href="stylee.css"> 
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> 

         <!-- Site Icons -->
 <link rel="shortcut icon" href="images/salesLogo.png" type="image/x-icon" />
    </head>
    <body>
        <div class="container">
            <div class="login-box">
            <div class="row">
            <div class="col-md-12 login-left">
                    <h2>تسجيل الدخول</h2>
                    <form action="validation.php" method="post">
                        <div class="form-group">
                            <label>اسم المستخدم</label>
                            <input type="text"  name="user" autocomplete="off" placeholder="أدخل اسمك" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password"  autocomplete="off" placeholder="أدخل كلمة المرور" name="password"  class="form-control" required>
                        </div>
                        <button id="login_btn" type="حفظ" class="btn btn-primary">دخول</button>
                        <?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo "<span>$error</span>";
                    }
                ?>  
                    </form>
                  </div>
                </div>
                </div>
        </div>
    </body>
</html>
<?php
    unset($_SESSION["error"]);
?>