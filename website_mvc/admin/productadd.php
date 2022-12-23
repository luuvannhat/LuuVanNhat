<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/cate/category.php'; ?>
<?php include '../classes/product.php';  ?>

<?php 
//gọi class (tên class)
$pd = new product();
// Nếu phương thức là Post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
     //gọi hàm login admin bên class category , truyền vào catName
     $insertProduct = $pd->insert_product($_POST,$_FILES);
}


?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <?php 
                if(isset($insertProduct))
                {
                    echo $insertProduct;
                }
                ?>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Tên sản phẩm</label>
                        </td>
                        <td>
                            <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                                <option>Chọn danh mục</option>
                                <?php 
                            $cat = new category();   
                            $show_cat = $cat -> show_category();
                            if($show_cat){
                                while($result = $show_cat -> fetch_assoc()){
                                    ?>
                                <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                <?php }
                        }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brand">
                                <option>Chọn thương hiệu</option>
                                <?php 
                                 $brand = new brand();  
                            $show_brand = $brand -> show_brand();
                            if($show_brand){
                                while($result = $show_brand -> fetch_assoc()){?>
                                <option value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?>
                                </option>
                                <?php }} ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea name="product_desc" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price Mua</label>
                        </td>
                        <td>
                            <input type="text" name="price_mua" placeholder="Enter Price..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Quantity</label></label>
                        </td>
                        <td>
                            <input type="text" name="quantity" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <option value="0">Nổi bật</option>
                                <option value="1">Không nổi bật</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
});
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>