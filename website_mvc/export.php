<?php
  session_start();
    include 'lib/session.php';
    Session::init();
?>
<?php
  
  include 'lib/database.php';
  include 'helpers/format.php';

  spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
  });
    

  $db = new Database();
  $fm = new Format();
  $ct = new cart();
  $us = new user();
  $cs = new customer();
  $cat = new category();
  $product = new product();
?>




<?php  
//export.php  
//
if(isset($_GET["hoadon"]) || isset($_POST["export"]))
{
$connect = mysqli_connect("localhost", "root", "", "website_mvc");
$output = '';

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
<tr><td colspan="5" >Địa chỉ:159 ngõ 79 Cầu Giấy</td></tr> 
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
<td style="background-color: #42c9db"></td>