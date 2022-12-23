<?php 
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php 
if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
        echo "<script> window.location = '404.php' </script>";
        
    }else {
        $id = $_GET['proid']; // Lấy productid trên host
    } 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
     //gọi hàm login admin bên class category , truyền vào catName
     $quantity = $_POST['quantity'];
     $AddtoCart = $ct->add_to_cart($id,$quantity);
}
?>
<div class="main">
    <div class="content">
        <div class="section group">

            <?php 
    		$get_product_details = $product->get_details($id);
    		if($get_product_details)
    		{
    			while ($result_details = $get_product_details->fetch_assoc()) {

    		?>
            <div class="cont-desc span_1_of_2">
                <div class="grid images_3_of_2">
                    <img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
                </div>
                <div class="desc span_3_of_2">
                    <h2><?php echo $result_details['productName'] ?></h2>
                    <p><?php echo $fm->textShorten($result_details['product_desc'],20) ?></p>
                    <div class="price">
                        <p>Giá: <span><?php echo $fm->format_currency($result_details['price'])." "."VNĐ" ?></span></p>
                        <p>Danh mục: <span><?php echo $result_details['catName'] ?></span></p>
                        <p>Thương hiệu:<span><?php echo $result_details['brandName'] ?></span></p>
                    </div>
                    <div class="add-cart">
                        <form action="" method="post">
                            <input type="number" class="buyfield" name="quantity" value="1" min="1"
                                max="<?php echo $result_details['sl'] ?>" />
                            <input type="submit" class="buysubmit" name="submit" value="Mua ngay" />
                        </form>
                        <!-- <?php
                            if(isset($AddtoCart))
                            {
                                echo '<span style="color:red;font-size:18px">Product Already Added</span>';
                            }
					    ?> -->
                    </div>
                </div>
                <div class="product-desc">

                    <?php echo $result_details['product_desc'] ?>
                </div>

            </div>
            <?php 
}
}
	?>
            <div class="rightsidebar span_3_of_1">
                <h2>DANH MỤC SẢN PHẨM</h2>
                <ul>
                    <?php 
						$getall_category = $cat->show_category_fontend();
						if($getall_category)
						{
							while ($result_allcat=$getall_category->fetch_assoc()) {
								?>
                    <li><a
                            href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName'] ?></a>
                    </li>
                    <?php
					}
				}
						?>
                </ul>

            </div>
        </div>
    </div>
</div>


<?php 
include 'inc/footer.php';


?>



<!-- <h2 class="title">TH&Ocirc;NG Sá» Ká»¸ THUáº¬T</h2>
<div class="content-detail">
<div id="table-detail" class="table-detail">
<div class="row">
<div class="col1">
<div class="left spec-group">
<div class="group-name">Äá»˜NG CÆ </div>
<div class="specs">
<div class="spec">
<div class="spec-name left">Äá»™ng cÆ¡</div>
<div class="spec-val left">4-th&igrave;, 4-xy lanh, DOHC, 4-valve, l&agrave;m m&aacute;t báº±ng cháº¥t lá»ng, supercharged</div>
</div>
<div class="spec">
<div class="spec-name left">Dung t&iacute;ch xi lanh</div>
<div class="spec-val left">998cc</div>
</div>
<div class="spec">
<div class="spec-name left">ÄÆ°á»ng k&iacute;nh x H&agrave;nh tr&igrave;nh Piton</div>
<div class="spec-val left">76.0 x 55.0mm</div>
</div>
<div class="spec">
<div class="spec-name left">Tá»‰ sá»‘ n&eacute;n</div>
<div class="spec-val left">8.5:1</div>
</div>
<div class="spec">
<div class="spec-name left">Há»‡ thá»‘ng nhi&ecirc;n liá»‡u</div>
<div class="spec-val left">DFI<span class="sup">&reg;</span>&nbsp;w/50mm th&acirc;n á»‘ng (4) vá»›i dual injection</div>
</div>
<div class="spec">
<div class="spec-name left">Ä&aacute;nh lá»­a</div>
<div class="spec-val left">Digital</div>
</div>
<div class="spec">
<div class="spec-name left">Tá»‰ sá»‘ chuyá»n Ä‘á»™ng</div>
<div class="spec-val left">6-cáº¥p, return, dog-ring</div>
</div>
<div class="spec">
<div class="spec-name left">Tá»‰ sá»‘ chuyá»n Ä‘á»™ng</div>
<div class="spec-val left">Sealed chain</div>
</div>
<div class="spec">
<div class="spec-name left">Ph&acirc;n lá»±c phanh Ä‘iá»‡n tá»­</div>
<div class="spec-val left">Kawasaki Corner Management Function (KCMF), Kawasaki Traction Control (KTRC), Kawasaki Launch Control Mode (KLCM), Kawasaki Intelligent anti-lock Brake System (KIBS), Kawasaki Äá»™ng cÆ¡ Brake Control, Kawasaki Quick Shifter (KQS) (upshift &amp; downshift), &Ouml;hlins Electronic Steering Damper</div>
</div>
</div>
</div>
<div class="left spec-group">
<div class="group-name">Há»† THá»NG CHUYá»€N Äá»˜NG</div>
<div class="specs">
<div class="spec">
<div class="spec-name left">Giáº£m s&oacute;c trÆ°á»›c / B&aacute;nh xe Chuyá»ƒn Ä‘á»™ng</div>
<div class="spec-val left">43mm inverted fork vá»›i rebound and compression damping, spring preload adjustability and top-out springs/4.7 in</div>
</div>
<div class="spec">
<div class="spec-name left">Giáº£m s&oacute;c sau / B&aacute;nh xe Chuyá»ƒn Ä‘á»™ng</div>
<div class="spec-val left">New Uni-Trak, &Ouml;hlins TTX36 gas charged shock vá»›i piggyback reservoir, compression and rebound damping and spring preload adjustability, and top-out spring/5.3 in</div>
</div>
<div class="spec">
<div class="spec-name left">Lá»‘p trÆ°á»›c</div>
<div class="spec-val left">120/70 ZR17 (58W)</div>
</div>
<div class="spec">
<div class="spec-name left">Lá»‘p sau</div>
<div class="spec-val left">200/55 ZR17 (78W)</div>
</div>
<div class="spec">
<div class="spec-name left">Phanh trÆ°á»›c</div>
<div class="spec-val left">Dual radial-mount, opposed 4-piston calipers, dual semi-floating 330mm discs, KIBS ABS</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div> -->