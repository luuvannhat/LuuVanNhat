    <?php 
include 'inc/header.php';
// include 'inc/slider.php';
?>
<!-- <?php 
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
?> -->

<?php 
$login_check = Session::get('customer_login');
    if($login_check==false)
    {
        header('Location: login.php');
    }
    
?>


<?php 
    
    $id = Session::get('customer_id');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $UpdateCustomers = $cs -> update_customers($_POST, $id); // hàm check catName khi submit lên
    } 
 ?>
 <div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
            <div class="heading">
            <h3>Cập nhật thông tin cá nhân</h3>
            </div>
            <?php 
            if(isset($UpdateCustomers))
            {
                echo $UpdateCustomers;
            }
            ?>
            <div class="clear"></div>
        </div>
        <form action="" method="POST">
            <table class="tblone">
                <?php 
                $id =Session::get('customer_id');
                $get_customers = $cs->show_customers($id);
                if($get_customers)
                {
                    while ($result = $get_customers->fetch_assoc()) {

                ?>
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="name" value="<?php echo $result['name'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>
                        <input type="text" name="city" value="<?php echo $result['city'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>Zip-Code</td>
                    <td>
                        <input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>">
                    </td>
                </tr> 
                <tr>
                    <td>E-Mail</td>
                    <td>
                        <input type="text" name="email" value="<?php echo $result['email'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>
                        <input type="text" name="address" value="<?php echo $result['address'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>
                        <input type="text" name="phone" value="<?php echo $result['phone'] ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="submit" name="save" value="Cập Nhật">            
                    </td>
                </tr>
                
                <?php 
            }
        }

                ?>
            </table>
        </form>
        </div>
    </div>
    </div>
   

<?php 
include 'inc/footer.php';


?>