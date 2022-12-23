 
<?php 
include 'inc/header.php';

?>
<?php 
	$login_check = Session::get('customer_login');
	if($login_check==false)
	{
	header('Location: login.php');
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>404 Error</title>
</head>
<style type="text/css">
	h1{
		color: red;
		font-size: 30px;
	}
</style>
<body>
	<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				<div class="order_page">
					<h1><center><a href="index.php">Click mua hàng ngay</a></center></h1>
				</div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</body>
</html>


 <?php 
include 'inc/footer.php';


?>

