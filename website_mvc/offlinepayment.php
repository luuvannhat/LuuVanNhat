<?php 
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php 
if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
        $customer_id =  Session::get('customer_id');
        $insertOrder = $ct->insertOrder($customer_id);
        $delCart =$ct->del_all_data_cart();
        header('Location: success.php');
        
    }
?>
<style type="text/css">

    .box
    {
    	width: 1200px;
    }
	.boxleft
	{
		width: 50%;
		float: left;
		border:1px solid #989898;
		
	}
	.boxrigh
	{
		width: 48%;
		float: right;
		border:1px solid #989898;
	
	}
	.input_order{
		width: 200px;
		height: 30px;
		margin-left: 500px;
		padding: 10px;

 /* display: flex;
  flex-direction: column;
  height: 93vh;
  justify-content: center;
  align-items: center;
  background: #222;
  color: #eee;
  font-family: "Dosis", sans-serif;*/
}

.underlined-a {
  text-decoration: none;
  color: #990000;
  padding-bottom: 0.15em;
  box-sizing: border-box;
  box-shadow: inset 0 -0.2em 0 #990000;
  transition: 0.2s;
  &:hover {
    color: #222;
    box-shadow: inset 0 -2em 0 #990000;
    transition: all 0.45s cubic-bezier(0.86, 0, 0.07, 1);
  }
}

.brk-btn {

  position: relative;
  background: none;
  padding: 10px;

  color: #990000;
  text-transform: uppercase;
  text-decoration: none;
  border: 0.2em solid #990000;
  
  &::before {
    content: "";
    display: block;
    position: absolute;
    width: 10%;
    background: #222;
    height: 0.3em;
    right: 20%;
    top: -0.21em;
    transform: skewX(-45deg);
    -webkit-transition: all 0.45s cubic-bezier(0.86, 0, 0.07, 1);
    transition: all 0.45s cubic-bezier(0.86, 0, 0.07, 1);
  }
  &::after {
    content: "";
    display: block;
    position: absolute;
    width: 10%;
    background: #222;
    height: 0.3em;
    left: 20%;
    bottom: -0.25em;
    transform: skewX(45deg);
    -webkit-transition: all 0.45 cubic-bezier(0.86, 0, 0.07, 1);
    transition: all 0.45s cubic-bezier(0.86, 0, 0.07, 1);
  }
  &:hover {
    &::before {
      right: 80%;
    }
    &::after {
      left: 80%;
    }
  }
}

	
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
    		     <h3>Thanh Toán Offline</h3>
    		     <div class="box">
    		     <div class="boxleft">
    		     <div class="cartpage">
			    	
			    	<?php
			    	if(isset($update_quantity_cart)) 
			    	{
			    		echo $update_quantity_cart;
			    	}
			    	?>
			    	<?php
			    	if(isset($del_product_cart)) 
			    	{
			    		echo $del_product_cart;
			    	}
			    	?>
						<table class="tblone">
							<tr>
								<th width="10%">STT</th>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Image</th>
								<th width="15%">Giá</th>
								<th width="25%">Số Lượng</th>
								<th width="20%">Tổng Giá</th>
								
							</tr>
							<?php
							   $get_product_cart = $ct->get_product_cart();
							   if($get_product_cart)
							   {
							   	$i=0;
							   	$subtotal = 0;
							   	while ($result =$get_product_cart->fetch_assoc()) {
							    $i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price']) ?></td>
								<td><?php echo $result['quantity'] ?></td>
								<td>
									<?php 
									$total = $result['price']*$result['quantity'];
									echo $fm->format_currency($total);
									?>
								</td>
								
							</tr>
							<?php 
							$subtotal+=$total;
							}
						}
							?>
							
						</table>
						<?php 
						$check_cart = $ct->check_cart();
						if($check_cart)
						{
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php echo $fm->format_currency($subtotal)." "."VNĐ" ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php 
									$vat = $subtotal *0.1;
									$grtotal = $subtotal + $vat;
									echo $fm->format_currency($grtotal)." "."VNĐ";
									?>
								</td>
							</tr>
					   </table>
					<?php 
				}else
				{
					echo "<span style='color: red; font-size: 20px'>Giỏ hàng của bạn trống.Hãy mua thêm gì đó</span>";
				}
				?>
					</div>
    		     </div>
    		     <div class="boxrigh">
    		     	 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    		<div class="heading">
    		<h3>Thông tin cá nhân</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    		<table class="tblone">
    			<?php 
    			$id =Session::get('customer_id');
    			$get_customers = $cs->show_customers($id);
    			if($get_customers)
    			{
    				while ($result = $get_customers->fetch_assoc()) {

    			?>
    			<tr>
    				<td>Name</td>
    				<td><?php echo $result['name'] ?></td>
    			</tr>
    			<tr>
    				<td>City</td>
    				<td><?php echo $result['city'] ?></td>
    			</tr>
    			<tr>
    				<td>Zip-Code</td>
    				<td><?php echo $result['zipcode'] ?></td>
    			</tr>
    			<tr>
    				<td>E-Mail</td>
    				<td><?php echo $result['email'] ?></td>
    			</tr>
    			<tr>
    				<td>Address</td>
    				<td><?php echo $result['address'] ?></td>
    			</tr>
    			<tr>
    				<td>Phone</td>
    				<td><?php echo $result['phone'] ?></td>
    			</tr>
    			<tr>
    				<td colspan="2">
                    <a href="editprofile.php">Sửa thông tin</a>            
                    </td>
    			</tr>
    			
    			<?php 
    		}
    	}

    			?>
    		</table>
 		</div>
 	</div>
	</div>
   
    		     </div>
    		     </div>
    		</div>
 		</div>
 	</div>
 	<div class="input_order">
 	<center><a href="?orderid=order" class="brk-btn">Đặt hàng ngay</a></center>
 	</div>
	</div>
   </form>

<?php 
include 'inc/footer.php';


?>