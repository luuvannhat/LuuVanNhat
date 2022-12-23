<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/cate/category.php'; ?>
<?php include '../classes/product.php';  ?>
<?php include_once '../helpers/format.php';  ?>

<?php 
	$pd = new product();
	$fm = new Format();
	if(!isset($_GET['productid']) || $_GET['productid'] == NULL){
        // echo "<script> window.location = 'catlist.php' </script>";
        
    }else {
        $id = $_GET['productid']; // Lấy catid trên host
        $delProduct = $pd -> del_product($id); // hàm check delete Name khi submit lên
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">
            <?php 
        	if(isset($delProduct))
        	{
        		echo $delProduct;
        	}
        	?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá Mua</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Hình ảnh</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Mô tả</th>
                        <th>Loại</th>
                        <th>Xử lý</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
				
				$pdlist = $pd->show_product();
				if($pdlist)
				{
					$i=0;
					while ($result = $pdlist->fetch_assoc()) {
					$i++; ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['productName']; ?></td>
                        <td><?php echo $fm->format_currency($result['price_mua']); ?></td>
                        <td><?php echo $fm->format_currency($result['price']); ?></td>
                        <td><?php echo $result['sl']; ?></td>
                        <td><img src="uploads/<?php echo $result['image']; ?>" width="50px"></td>
                        <td><?php echo $result['catName']; ?></td>
                        <td><?php echo $result['brandName']; ?></td>
                        <td><?php
					 echo $fm->textShorten($result['product_desc'],100); 
					 ?></td>
                        <td>
                            <?php if($result['type'] ==0)
						{
							echo "Nổi bật";
						}
						else
						{
							echo "Không nổi bật";
						}
						?>

                        </td>
                        <td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> || <a
                                href="?productid=<?php echo $result['productId'] ?>">Delete</a></td>
                    </tr>
                    <?php }
			}
			?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    setupLeftMenu();
    $('.datatable').dataTable();
    setSidebarHeight();
});
</script>
<?php include 'inc/footer.php';?>
<img src="">