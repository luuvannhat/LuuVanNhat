<style type="text/css">
	
}
</style>
	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php 
				$getLastestYamaha = $product->getLastestYamaha();
				if($getLastestYamaha)
				{
					while ($resultYa=$getLastestYamaha->fetch_assoc()) {

				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="#"> <img height="100px" src="admin/uploads/<?php echo $resultYa['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>YAMAHA</h2>
						<p><?php echo $resultYa['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultYa['productId'] ?>">Mua ngay</a></span></div>
				   </div>
			   </div>
			   <?php 
			   } }
			   ?>
			   <?php 
				$getLastestHonda = $product->getLastestHonda();
				if($getLastestHonda)
				{
					while ($resultHo=$getLastestHonda->fetch_assoc()) {

				?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="#"><img src="admin/uploads/<?php echo $resultHo['image'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>HONDA</h2>
						  <p><?php echo $resultHo['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultHo['productId'] ?>">Mua ngay</a></span></div>
					</div>
				</div>
				<?php 
			   } }
			   ?>
			</div>
			<div class="section group">
				<?php 
				$getLastestDucati = $product->getLastestDucati();
				if($getLastestDucati)
				{
					while ($resultDu=$getLastestDucati->fetch_assoc()) {

				?>	
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="#"><img src="admin/uploads/<?php echo $resultDu['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>DUCATI</h2>
						<p><?php echo $fm->textShorten($resultDu['productName'],20) ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultDu['productId'] ?>">Mua ngay</a></span></div>
				   </div>
			   </div>
			   <?php 
			   } }
			   ?>
			   <?php 
				$getLastestSuzuki = $product->getLastestSuzuki();
				if($getLastestSuzuki)
				{
					while ($resultSu=$getLastestSuzuki->fetch_assoc()) {

				?>				
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="#"><img src="admin/uploads/<?php echo $resultSu['image'] ?>" alt=""  /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>SUZUKI</h2>
						  <p><?php echo $resultSu['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultSu['productId'] ?>">Mua ngay</a></span></div>
					</div>
				</div>
				<?php 
			   } }
			   ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/5.jpg" alt=""/></li>
						<li><img src="images/6.jpg" alt=""/></li>
						<li><img src="images/7.jpg" alt=""/></li>
						<li><img src="images/8.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	
 
 