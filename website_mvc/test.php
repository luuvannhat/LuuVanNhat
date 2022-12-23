<?php 
$connect = mysqli_connect("localhost", "root", "", "website_mvc");
 $query3 = "SELECT * FROM tbl_order order by productId desc LIMIT 1";
 $result3 = mysqli_query($connect, $query3);
 while($row3 = mysqli_fetch_array($result3))
  {
    $hoadon1=$row3["hoadon"];
     
     $query = "SELECT * FROM tbl_order WHERE hoadon='$hoadon1'";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
 	while($row = mysqli_fetch_array($result))
  {
  	$n=$row["productName"];
  	$g=$row["price"];
  	echo "aaaaaaaaa".$n."------------".$g;
  }
 }

  
  }
	
?>