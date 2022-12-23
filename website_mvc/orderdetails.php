  <?php 
include 'inc/header.php';
// include 'inc/slider.php';

?>
<?php 
$login_check = Session::get('customer_login');

if($login_check==false)
{
	header('Location: login.php');
}

?>
<?php 
 $ct = new cart(); 
    if(isset($_GET['confirmid'])){

        $id = $_GET['confirmid']; 
        $price = $_GET['price']; 
        $time = $_GET['time']; 
        $confirm_order = $ct->confirm_order($id,$price,$time);
    }
    
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<div class="content_top">
    		<div class="heading">
    		<h3>Đơn hàng đã đặt</h3>
    		
    		</div>
    		<div class="clear"></div>
    	</div>
			    	
						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Image</th>
								<th width="15%">Giá</th>
								<th width="5%">Số Lượng</th>
								<th width="20%">Ngày</th>
								<th width="15%">Trạng thái</th>
								<th width="10%">Action</th>
							</tr>
							<?php 
							  $customer_id = Session::get('customer_id');
							  $show_cart_order=$ct->show_cart_order($customer_id);
							  if($show_cart_order)
							  {
							  	$i=0;
							  	while ($result=$show_cart_order->fetch_assoc()) {
							  		$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price'])." "."VNĐ"; ?></td>
								<td><?php echo $result['quantity']; ?></td>
								<td><?php echo $fm->formatDate($result['date_order']) ?></td>
								<td>

									<?php 
									if($result['status']==0)
									{
										echo "Đang chờ xử lý";
									}
									else if($result['status']==1)
									{
										echo "Đã gửi hàng";
									}
									else
									{
										echo "Đã nhận";
									}
									?>
								</td>
								

								<?php
								if($result['status']==0)
								{
								 ?>
								<td>N/A</td>
							<?php }

							else if($result['status']==1)
								{?>
								<td><a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Xác nhận</a></td>
								<?php
							}else{?>
								<td>Đã nhận</td>
							<?php }?>
							</tr>
							<?php 
						} }?>		
							
						</table>
						
						
					
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>



 <?php 
include 'inc/footer.php';


?>