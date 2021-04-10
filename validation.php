
<?php 
session_start();
 
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,'pr');
$name = $_POST['user'];
$pass =$_POST['password'];
$error = " اسم المستخد أو كلمة المرور غير صحيحة";

$s = "select * from web_users  where name ='$name' && password ='$pass'";
$result = mysqli_query($con,$s);
$num = mysqli_num_rows($result);

if($num ==1){
    $_SESSION["user"] = $name;
    $_SESSION["password"] = $pass;
    header('location:index.php');
}else{
    $_SESSION["error"] = $error;
    header("location: login.php");
 
}
?> 

