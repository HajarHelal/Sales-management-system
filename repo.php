<?php
function getArea_id ($area_id=""){
	include 'connect.php'; 
	
	$values=array();
		$sql = "SELECT *  FROM areas where area_id=' $area_id ' ";
		$result = $conn->query($sql);
	   
		if($result){
			while( $val=$result->fetch_assoc()){
	return $val['area_name'];
	var_dump($val);
		  
		}
	}
	}
	
if ($_SERVER["REQUEST_METHOD"]=="POST"and isset($_POST["display"]))
{
	include 'connect.php'; 

	$emp_id=$_POST['emp_id'];
	$request_date=$_POST['request_date'];

	if (isset($_POST['emp_id']))
	{
		$query = "SELECT a.emp_id,a.emp_name,b.area_id FROM sales_emp a join  road_line b where a.emp_id = b.emp_id and a.emp_id=$emp_id";
		$result=mysqli_query($conn, $query);
		if ($result->num_rows > 0) 
		{
			// output data of each row
			while($row = $result->fetch_assoc()) 
			{
				$emp_id=$row["emp_id"];
				$emp_name=$row["emp_name"];
				$area_id=$row['area_id'];
			}
		}
			
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
     <!-- <link rel="stylesheet" href="report.css">  -->
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> 
	<script src="js/modernizr.js"></script> <!-- Modernizr -->


</head>
<body id="page-top">
<?php include 'header.php'; ?>
      <div class="container">
    <div class="report-box">
    <button class="bot_comp"> البحث عن تقرير المبيعات اليومي للمندوبين</button><br><br>
    <div class="row">
            <div class="col-md-12 ">
					<form class="emp_report" id="emp_form" action="#" method="post" enctype='multipart/form-data'>
					        <div class="report_right">
                            <label >اسم المندوب</label>
                              
                            <?php
							 include 'connect.php';   
								$sql = "SELECT emp_id,emp_name FROM sales_emp";
								$result = $conn->query($sql);
								if($conn->error)
								{
									die($conn->error);
								}
								?>
								<select name="emp_id">
								<?php
								 while($row =$result->fetch_assoc())
								 {
									 
									 if(isset($emp_id) and $emp_id==$row['emp_id'])
									 {
										 ?>
										 <option value='<?php echo $row['emp_id'];?>' selected> <?php echo $row['emp_name'];?></option>
										 <?php
									 }
									 else
									 {											 																			 
								?>
											   
								<option value='<?php echo $row['emp_id'];?>'> <?php echo $row['emp_name'];?></option>
								<?php  }
								} ?>                         
								 </select><br><br>
								     
								 
                            <label >التاريخ المطلوب</label>
							<input type="date" class="date" autocomplete="off" name="request_date" value='<?php if(isset($request_date))echo $request_date;?>'><br><br>
							<input  type='submit'  id="butten-dis" value='عرض' name="display"/>
							</div>   

							<div class="report_left">   						                                      
                            <label >رقم المندوب</label>
                            <input type="text"  name="emp_id1" autocomplete="off"  value='<?php if(isset($emp_id))echo $emp_id;?>' readonly><br><br>
                            <label >اسم المندوب</label>
                            <input type="text"  name="emp_name" autocomplete="off" value='<?php if(isset($emp_name))echo $emp_name?>' readonly><br><br>
                            <label>خط السير</label>
                            <input type="text"  autocomplete="off"  name="area_id" value='<?php if(isset($area_id))echo getArea_id($area_id)?>' readonly> 
                           
							</div>
                            </form>
                            </div>
                            </div>
                            </div>
							<button id="btnExport" onClick="fnExcelReport()">تصدير للاكسل</button>
    
    
    
    

    <table id="theTable" class="table_report">
    <thead>
		<tr>
          <th><h1>رقم الطلب</h1></th>
			<th><h1>اسم العميل</h1></th>
			<th><h1>اسم النقطة</h1></th>
			<th><h1>المبيعات</h1></th>
		</tr>
	</thead>
	<tbody>
  <?php
  function customer_id($customer_id="")
  { include 'connect.php';   
		$values=array();
			$sql = "SELECT *  FROM customers where customer_id=' $customer_id ' ";
			$result = $conn->query($sql);
		   
			if($result){
				while( $val=$result->fetch_assoc()){
					$values[]=$val;
			}
		}
		return $values;
	}
   
    function point_id($point_id="")
	{
		include 'connect.php';   
		
		$values=array();
			$sql = "SELECT *  FROM points where point_id=' $point_id ' ";
			$result = $conn->query($sql);
		   if($result)
		   {
				while( $val=$result->fetch_assoc())
				{
					$values[]=$val;
				}
			}
		return $values;
	}
if ($_SERVER["REQUEST_METHOD"]=="POST"and isset($_POST["display"]))
{
	include 'connect.php';   
;
	$emp_id=$_POST['emp_id'];
	$request_date=$_POST['request_date'];

	$sql = "SELECT a.point_id,b.request_id,b.customer_id ,b.total FROM
	  customers a join request b where a.customer_id = b.customer_id and b.emp_id=$emp_id and b.request_date='$request_date'";
	  $result=mysqli_query($conn, $sql);
	if($conn->error)
	{
		die($conn->error);
    }
	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{
			echo "<tr>";
			echo "<td>{$row["request_id"]}</td>";
			foreach(customer_id ($row["customer_id"]) as $customer)
			{
				echo "<td>{$customer["customer_name"]}</td>"; 
			}
			foreach(point_id ($row["point_id"]) as $point)
			{
				echo "<td>{$point["point_name"]}</td>"; 
			}      
			echo "<td>{$row["total"]}</td>";
			echo "<td>";
			echo "</td>";
			echo "</tr>";
		}
   }
$conn->close();


}      
?>
  </tbody>
    </table>
    </div>
    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>


<!-- ALL JS FILES -->
<script src="js/all.js"></script>
<script src="js/report.js"></script>

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