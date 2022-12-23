 <?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>


<?php 

/**
 * 
 */
class profileadmin
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

	// hàm thêm danh mục
	



	// /
	// /
	public function show_profileadmin()
	{
		$query = "SELECT * FROM tbl_admin";
			$result =$this->db->insert($query);
			return $result;
	}

	// public function getbrandbyId($id)
	// {
	// 	$query = "SELECT * FROM tbl_brand WHERE brandId='$id'";
	// 		$result =$this->db->select($query);
	// 		return $result;
	// }

	public function update_profileadmin($data,$id)
		{
			$passold = mysqli_real_escape_string($this->db->link,$data['passold']);
			$passnew = mysqli_real_escape_string($this->db->link,$data['passnew']);			
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "SELECT * FROM tbl_admin";
			$result =$this->db->select($query);
			if($result!=false)
			{
				$value = $result->fetch_assoc();
				
			if($passold =="" || $passnew=="")	
			{
				$alert = "<span class='error'>Hãy nhập đầy đủ thông tin</span>";
			        return $alert;
			}
			else
			{
				if($value['adminPass'] != md5($passold))
				{
					$alert = "<span class='error'>Mật khẩu cũ không đúng</span>";
			        return $alert;
				}
				else
				{
						 $query = "UPDATE tbl_admin SET adminPass= md5('$passnew') WHERE adminId = '$id' ";
				         $result = $this->db->update($query);
				         if($result)
				         {
					     $alert = "<span class='success'>Đổi mật khẩu thành công</span>";
					     return $alert;
				         }
				         else
				         {
					      $alert = "<span class='error'>Đổi mật khẩu không thành công</span>";
					      return $alert;
			             }
				}
			}
			}
		}

			


			// if(empty($brandName)){
			// 	$alert = "<span class='error'>Tên thương hiệu không được bỏ trống</span>";
			// 	return $alert;
			// }else{
			// 	$query = "UPDATE tbl_brand SET brandName= '$brandName' WHERE brandId = '$id' ";
			// 	$result = $this->db->update($query);
			// 	if($result){
			// 		$alert = "<span class='success'>Sửa thành công</span>";
			// 		return $alert;
			// 	}else {
			// 		$alert = "<span class='error'>Update Category NOT Success</span>";
			// 		return $alert;
			// 	}
			// }


}
?>