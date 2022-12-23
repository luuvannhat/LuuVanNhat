<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>


 
<?php 
	/**
	* 
	*/
	class customer
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function insert_customer($data)
		{
			$name = mysqli_real_escape_string($this->db->link,$data['name']);
			$city = mysqli_real_escape_string($this->db->link,$data['city']);
			$zipcode = mysqli_real_escape_string($this->db->link,$data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link,$data['email']);
			$address = mysqli_real_escape_string($this->db->link,$data['address']);
			$country = mysqli_real_escape_string($this->db->link,$data['country']);
			$phone = mysqli_real_escape_string($this->db->link,$data['phone']);
			$password = mysqli_real_escape_string($this->db->link,md5($data['password']));


			if($name==""||$city==""||$zipcode==""||$email==""||$address==""||$country==""||$phone==""||$password=="")
		
		    {
			$alert="<span class='error'>Các trường không được bỏ trống</span>";
			return $alert;
		    }
		else
		{
			$check_mail = "SELECT * FROM tbl_customer WHERE email ='$email' LIMIT 1";
			$resutl_check = $this->db->select($check_mail);
			if($resutl_check)
			{
				$alert="<span class='error'>Email đã tồn tại</span>";
			return $alert;
			}
			else
			{
				 $query = "INSERT INTO tbl_customer(name,city,zipcode,email,address,country,phone,password) VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
			     $result =$this->db->insert($query);
			     if($result)
			      {
				    $alert="<span class='success'>Đăng kí thành công</span>";
			        return $alert;
			      }
			      else
			       {
				    $alert="<span class='error'>Đăng kí không thành công !!!!</span>";
			        return $alert;
			        }
			}
		}
		
		}

		public function login_customer($data)
		{
			$email = mysqli_real_escape_string($this->db->link,$data['email']);
			$password = mysqli_real_escape_string($this->db->link,md5($data['password']));


			if($email==""||$password=="")
		
		    {
			$alert="<span class='error'>Các trường không được bỏ trống</span>";
			return $alert;
		    }
		else
		{
			$check_login = "SELECT * FROM tbl_customer WHERE email ='$email'AND password='$password'";
			$resutl_check = $this->db->select($check_login);
			if($resutl_check !=false)
			{
				$value = $resutl_check->fetch_assoc();
				Session::set('customer_login',true);
				Session::set('customer_id',$value['id']);
				Session::set('customer_name',$value['name']);
				header('Location: order.php');
			}
			else
			{
				$alert="<span class='error'>Email hoặc Password không chính xác</span>";
			return $alert;
			}
		}
		}



		public function show_customers($id)
		{
			$query = "SELECT * FROM tbl_customer WHERE id ='$id'";
			$resutl_show_customers = $this->db->select($query);
			return $resutl_show_customers;
		}


		public function update_customers($data, $id)
		{
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			
			if($name==""||$city=="" || $zipcode=="" || $email=="" || $address=="" || $phone ==""){
				$alert = "<span class='error'>Tất cả thông tin không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE tbl_customer SET name='$name',city='$city',zipcode='$zipcode',email='$email',address='$address',phone='$phone' WHERE id ='$id'";
				$result = $this->db->insert($query);
				if($result){
						$alert = "<span class='success'  style='color: blue'>Khách hàng Updated thành công</span>";
						return $alert;
				}else{
						$alert = "<span class='error'>Khách hàng Updated không thành công</span>";
						return $alert;
				}
				
			}
		}

	}
 ?>
 <span style="color: blue"></span>