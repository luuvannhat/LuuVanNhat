<?php 
$filepath = realpath(dirname(__FILE__));
include ($filepath.'/../lib/session.php');
//gọi hàm checkLogin
Session::checkLogin();
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');


?>


<?php 

/**
 * 
 */
class adminlogin
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

	// hàm login admin
	public function login_admin($adminUser,$adminPass)
	{
		//Kiểm tra dữ liệu nhập vào có hợp lệ không , có dấu gì không
		$adminUser = $this->fm->validation($adminUser);
		$adminPass = $this->fm->validation($adminPass);

		// 2 biến , 1 biến là kết nối csdl , 1 biến là dữ liệu;
		$adminUser = mysqli_real_escape_string($this->db->link,$adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link,$adminPass);

		if(empty($adminUser) || empty($adminPass))
		{
			$alert="Tài khoản và mật khẩu không được bỏ trống";
			return $alert;
		}
		else
		{
			// $query()="SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPassword' LIMIT 1";
			$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1 ";
			$result =$this->db->select($query);
			if($result!=false) // nếu đúng
			{
				$value = $result->fetch_assoc();
				// nếu true thì tồn tại  $_SESSION['adminlogin']
				Session:: set('adminlogin',true);
				Session:: set('adminId',$value['adminId']);
				Session:: set('adminUser',$value['adminUser']);
				Session:: set('adminName',$value['adminName']);
				Session:: get('adminPass',$value['adminPass']);
				header('Location: index.php');
			}
			else
			{
			$alert="<span style='color: #ffffff'>Tài khoản hoặc mật khẩu không chính xác</span>";
			return $alert;
			}
		}
	}



	




}

?>
<span style="color: with"></span>
