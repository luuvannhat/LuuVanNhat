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
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    		<div class="heading">
    		<h3>Thông tin cá nhân</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
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
    				<td><?php echo $result['name'] ?></td>
    			</tr>
    			<tr>
    				<td>City</td>
    				<td><?php echo $result['city'] ?></td>
    			</tr>
    			<tr>
    				<td>Zip-Code</td>
    				<td><?php echo $result['zipcode'] ?></td>
    			</tr>
    			<tr>
    				<td>E-Mail</td>
    				<td><?php echo $result['email'] ?></td>
    			</tr>
    			<tr>
    				<td>Address</td>
    				<td><?php echo $result['address'] ?></td>
    			</tr>
    			<tr>
    				<td>Phone</td>
    				<td><?php echo $result['phone'] ?></td>
    			</tr>
    			<tr>
    				<td colspan="2">
                    <a href="editprofile.php">Sửa thông tin</a>            
                    </td>
    			</tr>
    			
    			<?php 
    		}
    	}

    			?>
    		</table>
 		</div>
 	</div>
	</div>
   

<?php 
include 'inc/footer.php';


?>