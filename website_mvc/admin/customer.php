<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/customer.php');
    include_once ($filepath.'/../helpers/format.php');
 ?>
<?php
    $cs = new customer(); 
    if(!isset($_GET['customerid']) || $_GET['customerid'] == NULL){
        echo "<script> window.location = 'inbox.php' </script>";
        
    }else {
        $id = $_GET['customerid']; // Lấy catid trên host
    }
     
  ?>

<div class="grid_10">
            <div class="box round first grid">
                <h2>Thông tin khách hàng đã đặt hàng</h2>
            
               <div class="block copyblock"> 
                 <form action="catadd.php" method="post">
                    <table class="form">
                    <?php 
                    $show_customer =$cs->show_customers($id);
                    if($show_customer)
                    {
                        while ($result =$show_customer->fetch_assoc()) {
                    ?>                    
                        <tr>
                            <td>Họ tên</td>
                            <td><?php echo $result['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td><?php echo $result['address']; ?></td>
                        </tr>
                        <tr>
                            <td>Thành Phố</td>
                            <td><?php echo $result['city']; ?></td>
                        </tr>
                        <tr>
                            <td>Số điện thoại</td>
                            <td><?php echo $result['phone']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $result['email']; ?></td>
                        </tr>
                    <?php }
                }?>
                    </table>
                    </form>
                </div>
            </div>
        </div>
   

<?php 
include 'inc/footer.php';


?>