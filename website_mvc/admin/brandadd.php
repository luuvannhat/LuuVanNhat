<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';  ?>
<?php 
//gọi class (tên class)
$brand = new brand();
// Nếu phương thức là Post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     //Lấy ra 2 biến 
     $brandName=$_POST['brandName'];
     //gọi hàm login admin bên class category , truyền vào brandName
     $insertBrand = $brand->insert_brand($brandName);
}


?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục</h2>
                <?php 
                if(isset($insertBrand))
                {
                    echo $insertBrand;
                }
                ?>
               <div class="block copyblock"> 
                 <form action="brandadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Nhập thương hiệu.." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>