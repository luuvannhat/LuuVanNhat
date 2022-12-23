<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>


<?php 

/**
 * 
 */
class cart
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		//Gọi class database
		$this->db = new Database();
		//Gọi class Format
		$this->fm = new Format();
	}

	public function add_to_cart($id,$quantity)
	{
		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link,$quantity);
		$is = mysqli_real_escape_string($this->db->link,$id);
		$sId = session_id();

		$query ="SELECT * FROM tbl_product WHERE productId ='$id'";
		$result = $this->db->select($query)->fetch_assoc();

		// $ud_sl = $result['sl']-$quantity;
		// $query_2 = "UPDATE tbl_product SET sl = '$ud_sl' where productId='$id'";
		// $this->db->update($query_2);
		
		$image = $result['image'];
		$price = $result['price'];
		$productName = $result['productName'];

		$query_insert ="INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES('$id','$quantity','$sId','$image','$price','$productName')";
		$result_cart =$this->db->insert($query_insert);
			
		if($result_cart){
			header('Location: cart.php');
		}else{
			header('Location: 404.php');
		}
	
		
		// $check_cart = "SELECT * FROM tbl_cart WHERE productId ='$id' AND sId ='$sId'";
		
		// if($check_cart)
		// {
		// 	$msg="Product Already Added";
		// 	return $msg;
		// }else
		// 	{

		// 			$query_insert ="INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES('$id','$quantity','$sId','$image','$price','$productName')";
		// 			$result_cart =$this->db->insert($query_insert);

		// 			if($result_cart)
		// 				{
		// 					header('Location: cart.php');
		// 				}
		// 			else{
		// 					header('Location: 404.php');
		// 				}
		// 	}
	}

	

		public function get_product_cart()
		{
			$sId = session_id();
			$query ="SELECT * FROM tbl_cart WHERE sId ='$sId'";
			$result = $this->db->select($query);
			return $result;
		}

	public function update_quantity_cart($quantity,$cartId)
		{
			$quantity = mysqli_real_escape_string($this->db->link,$quantity);
			$cartId = mysqli_real_escape_string($this->db->link,$cartId);

			$query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
			$result = $this->db->update($query);

			
			if($result)
			{
				$msg ="<span  style='color: blue ; font-size: 18px'>Cập nhật số lượng thành công</span>";
				return $msg;
			}
			else
			{
				$msg ="<span  style='color: red ; font-size: 18px'>Cập nhật số lượng không thành công</span>";
				return $msg;
			}
		}

	public function del_product_cart($cartid)
	{
		$cartid = mysqli_real_escape_string($this->db->link,$cartid);
		$query ="DELETE FROM tbl_cart WHERE cartId ='$cartid'";
		$result =	$this->db->delete($query);
		if($result)
		{
			header('Location: cart.php');
			
		}
		else
		{
			$msg ="<span  style='color: red ; font-size: 18px'>Xóa không thành công</span>";
			return $msg;
		}

	}
	public function check_cart()
	{
		$sId = session_id();
		$query ="SELECT * FROM tbl_cart WHERE sId ='$sId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function del_all_data_cart()

	{
		$sId = session_id();
		$query ="DELETE FROM tbl_cart WHERE sId ='$sId'";
		$result = $this->db->select($query);
		return $result;
	}


 

 
 






	public function insertOrder($customer_id)
	{
		$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';


		function generate_string($input, $strength = 16) {
			
			$input_length = strlen($input);
			$random_string = '';
			for($i = 0; $i < $strength; $i++) {
				$random_character = $input[mt_rand(0, $input_length - 1)];
				$random_string .= $random_character;
			}
			
			return $random_string;
		}

		$test=generate_string($permitted_chars, 10);
		$sId = session_id();
		$query ="SELECT * FROM tbl_cart WHERE sId ='$sId'";
		$get_product = $this->db->select($query);
		
		if($get_product)
		{
			while ($result=$get_product->fetch_assoc()) {
				$productid = $result['productId'];
				$productName = $result['productName'];
				$quantity = $result['quantity'];
				$price = $result['price'] *$quantity;
				$image = $result['image'];
				$customer_id = $customer_id;

				$query_order ="INSERT INTO tbl_order(productId,productName,customer_id,quantity,price,image,hoadon) VALUES('$productid','$productName','$customer_id','$quantity','$price','$image','$test')";
			$insert_order =$this->db->insert($query_order);
			
			
			}
		}
	}

	public function getAmountPrice($customer_id)
	{
		
		$query ="SELECT price FROM tbl_order WHERE customer_id ='$customer_id'";
		$get_price = $this->db->select($query);
		return $get_price;
	}




	public function show_cart_order($customer_id)

	{
		
		$query ="SELECT * FROM tbl_order WHERE customer_id ='$customer_id'";
		$result = $this->db->select($query);
		return $result;
		

	}

	public function get_inbox_cart()
	{
		$query ="SELECT * FROM tbl_order ORDER BY date_order DESC";
		$get_inbox_cart = $this->db->select($query);
		return $get_inbox_cart;
	}



	public function shifted($id,$qty,$proid,$price,$time)
	{
		$id = mysqli_real_escape_string($this->db->link,$id);
		$qty = mysqli_real_escape_string($this->db->link,$qty);
		$proid = mysqli_real_escape_string($this->db->link,$proid);
		$price = mysqli_real_escape_string($this->db->link,$price);
		$time = mysqli_real_escape_string($this->db->link,$time);


		$query = "UPDATE tbl_order SET status = '1' WHERE id = '$id' AND quantity='$qty' AND productId='$proid' AND price='$price' AND date_order='$time'";
		$result = $this->db->update($query);
		if($result)
		{
			$msg ="<span  style='color: blue ; font-size: 18px'>Cập nhật tình trạng thành công</span>";
			return $msg;
		}
		else
		{
			$msg ="<span  style='color: red ; font-size: 18px'>Cập nhật tình trạng không thành công</span>";
			return $msg;
		}
	}





	public function del_shifted($id,$qty,$proid,$price,$time)
	{
		$id = mysqli_real_escape_string($this->db->link,$id);
		$qty = mysqli_real_escape_string($this->db->link,$qty);
		$proid = mysqli_real_escape_string($this->db->link,$proid);
		$price = mysqli_real_escape_string($this->db->link,$price);
		$time = mysqli_real_escape_string($this->db->link,$time);


		$query = "DELETE FROM tbl_order WHERE id = '$id' AND quantity='$qty' AND productId='$proid' AND price='$price' AND date_order='$time'";
		$result = $this->db->delete($query);
		return $result;
		
	}


	public function confirm_order($id,$price,$time)
	{

		$id = mysqli_real_escape_string($this->db->link,$id);
		$price = mysqli_real_escape_string($this->db->link,$price);
		$time = mysqli_real_escape_string($this->db->link,$time);


		$query = "UPDATE tbl_order SET status = '2' WHERE customer_id = '$id' AND price='$price' AND date_order='$time'";
		$result = $this->db->update($query);
		if($result)
		{
			$msg ="<span  style='color: blue ; font-size: 15px'Xóa đơn hàng thành công</span>";
			return $msg;
		}
		else
		{
			$msg ="<span  style='color: red ; font-size: 18px'>Xóa đơn hàng không thành công</span>";
			return $msg;
		}

	}






	}
	
	
?>