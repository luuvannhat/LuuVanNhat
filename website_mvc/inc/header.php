<?php
	session_start();
    include 'lib/session.php';
    Session::init();
?>
<?php
	
	include 'lib/database.php';
	include 'helpers/format.php';

	//hàm tự động lấy class name
	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});
		

	$db = new Database();
	$fm = new Format();
	$ct = new cart();
	$us = new user();
	$cs = new customer();
	$cat = new category();
	$product = new product();
?>
<?php $login_check = Session::get('customer_login'); ?>

<!DOCTYPE HTML>

<head>
    <title>Store Website</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/nav-hover.js"></script>
    <link href='css/fonts.css' rel='stylesheet' type='text/css'>
    <link href='css/fonts2.css' rel='stylesheet' type='text/css'>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
    $(document).ready(function($) {
        $('#dc_mega-menu-orange').dcMegaMenu({
            rowItems: '4',
            speed: 'fast',
            effect: 'fade'
        });
    });
    </script>
</head>

<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="admin/uploads/logo3.png" alt="" /></a>
            </div>
            <div class="header_top_right">
                <div class="search_box">
                    <form method="POST" action="search_product.php">
                        <input style="color: #fff;" type="text" name="product_name_search"
                            placeholder="Nhập tên xe cần tìm..." value="">
                        <input type="submit" name="search_product" value="SEARCH">
                    </form>
                </div>

                <div class="shopping_cart" id="shopping_cart">
                    <?php 

			    			$id =Session::get('customer_id');

			    			if($id==false)
			    			{
			    				echo "false";
			    			}
			    			else
			    				{
			    			?>
                    <div class="cart">
                        <a href="#" title="View my shopping cart" rel="nofollow" style="line-height: 20px">
                            <!-- <img src="images/logo48.jpg"> -->
                            <?php 
    			             
    			             $get_customers = $cs->show_customers($id);
    			              if($get_customers)
    			                {
    				            while ($result = $get_customers->fetch_assoc()) {

    			                ?>
                            <span class="cart_title" style=' line-height: 38px'>Xin chào :</span>
                            <span class="no_product" style=' line-height: 38px'><?php echo $result['name'] ?></span>
                            <?php 
							}
						}

								?>
                        </a>
                    </div>
                    <?php } ?>
                </div>





                <?php 
			      if(isset($_GET['customer_id']))
			      {
			      	$delCart =$ct->del_all_data_cart();
			      	Session::destroy();
			      	
			      }


			      ?>
                <div class="login">
                    <?php 
			   	$login_check = Session::get('customer_login');
			   	if($login_check==false) { ?>

                    <a style="font-size: 20px; line-height: 38px" href="login.php">Đăng Nhập</a>

                    <?php } else { ?>

                    <a style="font-size: 20px; line-height: 38px"
                        href="?customer_id='<?= Session::get('customer_id')?>'">Đăng Xuất</a>

                    <?php } ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="menu">
            <ul id="dc_mega-menu-orange" class="dc_mm-orange">
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="products.php">Sản phẩm</a> </li>


                <?php 
	  	$login_check = $ct->check_cart();
		if($login_check==false)
		{
			echo "";
		}
		else
		{
			echo '<li><a href="cart.php">Giỏ Hàng</a></li>';
		}

	  ?>



                <?php 
	   $customer_id = Session::get('customer_id');
	  if($customer_id==false)
	  {
	  	echo "";
	  }
	  else
	  {
	  ?>


                <li><a href="orderdetails.php">Đơn hàng</a></li>
                <li><a href='profile.php'>Thông Tin</a> </li>
                <?php }?>
                <li><a href="contact.php">Liên Hệ</a> </li>
                <div class="clear"></div>
            </ul>
        </div>