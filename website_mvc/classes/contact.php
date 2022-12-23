 <?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>


<?php 

/**
 * 
 */
class contact
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

	//hàm thêm danh mục
	public function insert_contact($data)
	{
		//Kiểm tra dữ liệu nhập vào có hợp lệ không , có dấu gì không
		// 2 biến , 1 biến là kết nối csdl , 1 biến là dữ liệu;
		$contactName = mysqli_real_escape_string($this->db->link,$data['contactName']);
		$contactEmail = mysqli_real_escape_string($this->db->link,$data['contactEmail']);
		$contactSdt = mysqli_real_escape_string($this->db->link,$data['contactSdt']);
		$contactTieude = mysqli_real_escape_string($this->db->link,$data['contactTieude']);
		$contactNoidung = mysqli_real_escape_string($this->db->link,$data['contactNoidung']);
		if($contactName == "" || $contactEmail == "" || $contactSdt == "" || $contactTieude==""||$contactNoidung=="")
		{
			$alert="<span style='color: red; font-size: 20px'>Tất cả các trường không được bỏ trống</span>";
			return $alert;
		}
		else
		{
			
			$query = "INSERT INTO tbl_contact(contactName,contactEmail,contactSdt,contactTieude,contactNoidung) VALUES('$contactName','$contactEmail','$contactSdt','$contactTieude','$contactNoidung')";
			$result =$this->db->insert($query);
			if($result)
			{
				$alert="<span style='color: #339966; font-size: 20px'>Chúng tôi đã nhận được thông tin và sẽ liên hệ bạn trong thời gian sớm nhất.</span>";
			return $alert;
			}
			else
			{
				$alert="<span style='color: red; font-size: 20px'>Lỗi !!!!</span>";
			return $alert;
			}
		}
	}



	// /
	// /
	public function show_contact()
	{
		$query = "SELECT * FROM tbl_contact order by contactId DESC";
			$result =$this->db->insert($query);
			return $result;
	}

	// public function getcontactbyId($id)
	// {
	// 	$query = "SELECT * FROM tbl_brand WHERE brandId='$id'";
	// 		$result =$this->db->select($query);
	// 		return $result;
	// }

	// public function update_brand($brandName,$id)
	// 	{
	// 		$brandName = $this->fm->validation($brandName); //gọi ham validation từ file Format để ktra
	// 		$brandName = mysqli_real_escape_string($this->db->link, $brandName);
	// 		$id = mysqli_real_escape_string($this->db->link, $id);
	// 		if(empty($brandName)){
	// 			$alert = "<span class='error'>Tên thương hiệu không được bỏ trống</span>";
	// 			return $alert;
	// 		}else{
	// 			$query = "UPDATE tbl_brand SET brandName= '$brandName' WHERE brandId = '$id' ";
	// 			$result = $this->db->update($query);
	// 			if($result){
	// 				$alert = "<span class='success'>Sửa thành công</span>";
	// 				return $alert;
	// 			}else {
	// 				$alert = "<span class='error'>Update Category NOT Success</span>";
	// 				return $alert;
	// 			}
	// 		}

	// 	}

		public function del_contact($id)
		{
			$query="DELETE FROM tbl_contact WHERE contactId='$id'";
			$result=$this->db->delete($query);
			if($result)
			{
				$alert="<span style='color: #339966; font-size: 20px'>Xóa thành công góp ý</span>";
				return $alert;
			}
			else
			{
				$alert="<span style='color: red; font-size: 20px'>Xóa không thành công</span>";
				return $alert;
			}

		}
}

?>
