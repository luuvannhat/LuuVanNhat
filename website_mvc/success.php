<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>
<?php 
    if(isset($_GET['oderid']) AND $_GET['orderid'] == 'order'){
        $customer_id = Session::get('customer_id');
        $insertOrder = $ct->insertOrder($customer_id);
        $delCart = $ct->del_all_data_cart();
        header('Location:success.php');
    }
 ?>
<style type="text/css">
.box_left {
    width: 50%;
    border: 1px solid #666;
    float: left;
    padding: 4px;

}

.box_right {
    width: 47%;
    border: 1px solid #666;
    float: right;
    padding: 4px;
}

.a_order {
    background: #653092;
    color: aliceblue;
    padding: 10px;
    font-size: 25px;
    border-radius: none;
    cursor: pointer;
}
}
</style>

<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2>Đặt hàng thành công</h2>
                <?php 
            $customer_id = Session::get('customer_id');
            $get_amount =$ct->getAmountPrice($customer_id);
            if($get_amount)
                
               {
                $amount =0;
                     while ($result = $get_amount->fetch_assoc()) {
                    $price = $result['price'];
                    $amount +=$price;
                    }
            }

            ?>
                <p>Tổng giá trị bạn đã mua: <?php $total =$amount*0.1 + $amount; echo $fm->format_currency($total);  ?>
                    VNĐ</p>
                <p>Chúng tôi sẽ liên hệ với bạn sớm nhất có thể, xem chi tiết đặt hàng tại đây.<a
                        href="orderdetails.php">Click vào đây</a></p>

            </div>
        </div>

    </div>
</form>
<p>Xuất hóa đơn tại đây:</p>
<form method="post" action="export.php">
    <input type="submit" name="export" class="btn btn-success" value="Xuất hóa đơn" />
    <a href="export.php?hoadon">Xuất hóa đơn</a>
</form>
</br>
<?php 
	include 'inc/footer.php';
 ?>
<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "website_mvc");
$output = '';
if(isset($_POST["export"]))
{
   $id=Session::get('customer_id');
 

 $query2 = "SELECT * FROM tbl_customer WHERE id='$id'";
 $result2 = mysqli_query($connect, $query2);

 
 
 $query3 = "SELECT * FROM tbl_order order by id desc LIMIT 1";
 $result3 = mysqli_query($connect, $query3);
 while($row3 = mysqli_fetch_array($result3))
  {
    $hoadon1=$row3["hoadon"];
     $query = "SELECT * FROM tbl_order WHERE hoadon='$hoadon1'";
 $result = mysqli_query($connect, $query);
  

  $output .= '
   <table class="table" bordered="1" border="1" style="font-weight: bold"> 
   <tr>
   <td colspan="5" align="center" style="font-weight: bold;font-size: 50px">HÓA ĐƠN BÁN HÀNG</td>
   </tr> 
   <tr><td colspan="5" align="center">Nam Định,Ngày.......Tháng.......Năm.......</td></tr> 

<tr><td colspan="5" align="center"></td></tr> 
';


    $output .= '
<tr><td colspan="5">Mã hóa đơn: '.$hoadon1.'</td></tr>
';

$output .= '
<tr><td colspan="5" align="center"></td></tr>
<tr><td colspan="5"  style="background-color: #42c9db">Đơn vị bán hàng: Lưu Văn Nhật</td></tr> 
<tr><td colspan="5" >Mã số thuế: 1512359</td></tr> 
<tr><td colspan="5" >Địa chỉ: Hà Nội</td></tr> 
<tr><td colspan="5" >Điện thoại: 0987583960</td></tr> 
<tr><td colspan="5" ></td></tr> 
<tr><td colspan="5"  style="background-color: #42c9db">Thông tin khách hàng</td></tr> 
';
 while($row2 = mysqli_fetch_array($result2))
  {
$output .='
<tr><td colspan="5" >Họ tên:'.$row2['name'].' </td></tr> 
<tr><td colspan="5" >Địa chỉ:'.$row2['address'].' </td></tr> 
<tr><td colspan="5" >Điện thoại:'.$row2['phone'].' </td></tr> 
<tr><td colspan="5" >Email:'.$row2['email'].' </td></tr> 
<tr><td colspan="5" ></td></tr> 
';
}
$output .='
<tr><td colspan="5" align="center"></td></tr> 
                    <tr>  
                         <th width="100">STT</th>  
                         <th width="300">Tên sản phẩm</th>  
                         <th width="300">Số lượng</th>
                         <th width="300">Đơn giá</th>  
                         <th width="300">Thành Tiền</th>   
     
                    </tr>
  ';

 if(mysqli_num_rows($result) > 0)
 {

  $i=1;
  $amount =0;
  
  while($row = mysqli_fetch_array($result))
  {
    $thanhtien=$row["price"];
   $sl=$row["quantity"];
   $dongia=$thanhtien/$sl;
   $output .= '
    <tr>  
                         <td>'.$i++.'</td>  
                         <td>'.$row["productName"].'</td>  
                         <td>'.$row["quantity"].'</td> 
                          <td>'.$dongia.'</td> 
                         <td>'.$row["price"].' VND</td>  
                         
       
                    </tr>
   ';
   $amount +=$row["price"];
   $sum=$amount*0.1+$amount;
   $thanhtien=$row["price"];
   $sl=$row["quantity"];
   $dongia=$thanhtien/$sl;
  }
  $output .= '
    <tr>  
                         <td></td> 
                         <td></td>  
                         <td></td>  
                         <td>Tổng giá</td>  
                         <td>'.$amount.' VND</td>  
       
                    </tr>
                     <tr> 
                         <td></td>
                         <td></td>  
                         <td></td>  
                         <td>VAT</td>  
                         <td>10%</td>  
       
                    </tr>
                    <tr>  
                         <td></td>
                         <td></td>  
                         <td></td>  
                         <td>Tổng tiền cần thanh toán:</td>  
                         <td>'.$sum.' VND</td>  
       
                    </tr>
   ';
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
}
?>