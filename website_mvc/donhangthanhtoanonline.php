<?php 
include 'inc/header.php';
// include 'inc/slider.php';

?>
<?php 
if(isset($_GET['cartid']))
{
        $cartid = $_GET['cartid']; // Lấy catid trên host
        $delcart = $ct->del_product_cart($cartid); // hàm check delete Name khi submit lên
 }

 //
 //
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
     
     $cartId = $_POST['cartId'];
     $quantity = $_POST['quantity'];
     $update_quantity_cart = $ct->update_quantity_cart($quantity,$cartId);
     if($quantity<=0)
     {
     	 $delcart = $ct->del_product_cart($cartId);
     }
}

?>

<style>
.btn {

    height: 35px;
    border-radius: 5px;
    display: inline-block;

}

.btn-success {
    background-color: green;
    color: white;
    border: none;
}
</style>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <div class="content_top">
                    <div class="heading">
                        <?php
                            if(isset($_GET['congthanhtoan'])=='vnpay'){

                        ?>
                        <h3>Thanh toán bằng VNPAY</h3>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="clear"></div>
                </div>
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
                        <th width="20%">Tên sản phẩm</th>
                        <th width="10%">Image</th>
                        <th width="15%">Giá</th>
                        <th width="25%">Số Lượng</th>
                        <th width="20%">Tổng Giá</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
							

							   $get_product_cart = $ct->get_product_cart();
							   if($get_product_cart)
							   {
							   	$subtotal = 0;
							   	while ($result =$get_product_cart->fetch_assoc()) {
							    
							?>
                    <tr>
                        <td><?php echo $result['productName'] ?></td>
                        <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
                        <td><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" />
                                <input type="number" name="quantity" min="0"
                                    value="<?php echo $result['quantity'] ?>" />
                                <input type="submit" name="submit" value="Update" />
                            </form>
                        </td>
                        <td>
                            <?php 
									$total = $result['price']*$result['quantity'];
									echo $fm->format_currency($total)." "."VNĐ";
									?>
                        </td>
                        <td><a href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a></td>
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
            <div class="shopping">
                <div class="shopleft">
                    <a href="cart.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <form action="congthanhtoan.php" method="POST">
                        <input type="hidden" name="total_congthanhtoan" value="<?php echo $grtotal ?>">
                        <button class="btn btn-success" name="redirect" id="redirect">Thanh toán
                            VNPAY</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>



<?php 
include 'inc/footer.php';


?>