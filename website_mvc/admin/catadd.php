<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';  ?>
<?php 
//gọi class (tên class)
$cat = new category();
// Nếu phương thức là Post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     //Lấy ra 2 biến 
     $catName=$_POST['catName'];
     //gọi hàm login admin bên class category , truyền vào catName
     $insertCat = $cat->insert_category($catName);
}


?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục</h2>
                <?php 
                if(isset($insertCat))
                {
                    echo $insertCat;
                }
                ?>
               <div class="block copyblock"> 
                 <form action="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Nhập danh mục.." class="medium" />
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