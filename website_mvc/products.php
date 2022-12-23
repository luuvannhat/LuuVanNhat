<?php 
include 'inc/header.php';
// include 'inc/slider.php';

?>

<style type="text/css">
	img
	{
		width: 280px;
		height: 120px;
	}
	.grid_1_of_4.images_1_of_4 {
    height: 290px;
}
</style>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Yamaha</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      	$show_product_Yamaha = $product->show_product_Yamaha();
	      	if($show_product_Yamaha)
	      	{
	      		while ($result_Yamaha=$show_product_Yamaha->fetch_assoc()) {
	      			
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result_Yamaha['productId'] ?>"><img src="admin/uploads/<?php echo $result_Yamaha['image']; ?>" alt="" /></a>
					 <h2><?php echo $result_Yamaha['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result_Yamaha['product_desc'],60) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result_Yamaha['price'])." "."VNĐ"; ?></h2></span></p>
				      <div class="button"><span><a href="details.php?proid=<?php echo $result_Yamaha['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php 
			}}
			?>

			</div>


			<div class="content_top">
    		<div class="heading">
    		<h3>Suzuki</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
	      	<?php 
	      	$show_product_Suzuki = $product->show_product_Suzuki();
	      	if($show_product_Suzuki)
	      	{
	      		while ($result_Suzuki=$show_product_Suzuki->fetch_assoc()) {
	      			
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result_Suzuki['productId'] ?>"><img src="admin/uploads/<?php echo $result_Suzuki['image']; ?>" alt="" /></a>
					 <h2><?php echo $result_Suzuki['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result_Suzuki['product_desc'],60) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result_Suzuki['price'])." "."VNĐ"; ?></h2></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_Suzuki['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php 
			}}
			?>

			</div>








			<div class="content_bottom">
    		<div class="heading">
    		<h3>HonDa</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php 
	      	$show_product_HonDa = $product->show_product_HonDa();
	      	if($show_product_HonDa)
	      	{
	      		while ($result_HonDa=$show_product_HonDa->fetch_assoc()) {
	      			
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result_HonDa['productId'] ?>"><img src="admin/uploads/<?php echo $result_HonDa['image']; ?>" alt="" /></a>
					 <h2><?php echo $result_HonDa['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result_HonDa['product_desc'],60) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result_HonDa['price'])." "."VNĐ"; ?></h2></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_HonDa['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				
				<?php 
			}}
			?>
			</div>





			<div class="content_top">
    		<div class="heading">
    		<h3>Ducati</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php 
	      	$show_product_Ducati = $product->show_product_Ducati();
	      	if($show_product_Ducati)
	      	{
	      		while ($result_Ducati=$show_product_Ducati->fetch_assoc()) {
	      			
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result_Ducati['productId'] ?>"><img src="admin/uploads/<?php echo $result_Ducati['image']; ?>" alt="" /></a>
					 <h2><?php echo $result_Ducati['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result_Ducati['product_desc'],60) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result_Ducati['price'])." "."VNĐ"; ?></h2></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_Ducati['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
			<?php } }?>
				
			</div>





    </div>
 </div>
<?php 
include 'inc/footer.php';


?>