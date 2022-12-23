<?php 
include 'inc/header.php';
// include 'inc/slider.php';

?>
<?php
$product_name_search=$_POST['product_name_search'];

 ?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Kết quả tìm kiếm cho "<?php echo $product_name_search; ?>"</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    	
	      <div class="section group">
	      	<?php 
	      	$product_search = $product->product_name_search($product_name_search);
	      	if($product_search)
	      	{
	      		while ($result = $product_search->fetch_assoc()) {
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId']?>"><img src="admin/uploads/<?php echo $result['image'] ?>" height="109px"  alt=""  /></a>
					 <h2><?php echo $result['productName'] ?> </h2>
					 <p><?php echo $fm->textShorten($result['product_desc'],0) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php 
			}
		}
				?>
			</div>
			
			
    </div>
 </div>

 <?php 
include 'inc/footer.php';


?>
