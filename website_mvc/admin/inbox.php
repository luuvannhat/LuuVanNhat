<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/cart.php');
include_once ($filepath.'/../helpers/format.php');

?>
<?php 
 $ct = new cart(); 
    if(isset($_GET['shiftid'])){

        $id = $_GET['shiftid']; 
        $qty = $_GET['qty']; 
        $proid = $_GET['proid']; 
        $price = $_GET['price']; 
        $time = $_GET['time']; 
        $shifted = $ct->shifted($id,$qty,$proid,$price,$time);
    }
    
?>
<?php 
    if(isset($_GET['delid'])){

        $id = $_GET['delid']; 
        $qty = $_GET['qty']; 
        $proid = $_GET['proid']; 
        $price = $_GET['price']; 
        $time = $_GET['time']; 
        $del_shifted = $ct->del_shifted($id,$qty,$proid,$price,$time);
    }
    
?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách đơn hàng</h2>
                
                
                <div class="block">  
                <?php
                if(isset($shifted))
                {
                	echo $shifted;
                }
                 ?>

                 <?php
                if(isset($del_shifted))
                {
                	echo $del_shifted;
                }
                 ?>

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">ID</th>
							<th width="20%">Thời gian đặt hàng</th>
							<th width="15%">Tên sản Phẩm</th>
							<th width="10%">Số lượng</th>
							<th width="15%">Giá</th>
							<th width="10%">ID khách hàng</th>
							<th width="15%">Thông tin khách hàng</th>
							<th width="10%">Action</th>

						</tr>
					</thead>
					<tbody>
						<?php 

						$ct = new cart();
						$fm = new Format();
						$get_inbox_cart =$ct-> get_inbox_cart();
						if ($get_inbox_cart) {
							$i=0;
							while ($result=$get_inbox_cart->fetch_assoc()) {
								$i++;
								
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['date_order']) ; ?></td>
							<td><?php  echo $result['productName'] ?></td>
							<td><?php  echo $result['quantity']?></td>
							<td><?php  echo $fm->format_currency($result['price'])." "."VNĐ" ?></td>
							<td><?php  echo $result['customer_id'] ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">Xem khách hàng</a></td>
							
							<td>


							



								<?php

								if($result['status']==0) 
								{
									?>
									<a href="?shiftid=<?php echo $result['id'] ?>&qty=<?php echo $result['quantity'] ?>&proid=<?php echo $result['productId'] ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order'] ?>">Chờ xử lý</a>
									<?php 
								}else if($result['status']==2){?>
									<a href="?delid=<?php echo $result['id'] ?>&qty=<?php echo $result['quantity'] ?>&proid=<?php echo $result['productId'] ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order'] ?>">Xóa</a>

								<?php 
								}else
								echo "Đang giao hàng";
								?>  
							</td>
						</tr>
						<?php 
					}
					} ?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
