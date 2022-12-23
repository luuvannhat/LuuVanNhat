<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>


<?php 

/**
 * 
 */
class brand
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
	public function insert_brand($brandName)
	{
		//Kiểm tra dữ liệu nhập vào có hợp lệ không , có dấu gì không
		$brandName = $this->fm->validation($brandName);
		

		// 2 biến , 1 biến là kết nối csdl , 1 biến là dữ liệu;
		$brandName = mysqli_real_escape_string($this->db->link,$brandName);
	

		if(empty($brandName))
		{
			$alert="<span class='error'>Thương hiệu sản phẩm không được bỏ trống</span>";
			return $alert;
		}
		else
		{

			$query="SELECT * FROM tbl_brand WHERE brandName='$brandName'";
			$result=$this->db->select($query);
			if($result)
			{
				$alert="<span class='error'>Đã tồn tại thương hiệu này.Hãy thử lại</span>";
			   return $alert;
			}
			else
			{
			// $query()="SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPassword' LIMIT 1";
				$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
				$result =$this->db->insert($query);
				if($result)
				{
					$alert="<span class='success'>Thêm thành công</span>";
				return $alert;
				}
				else
				{
					$alert="<span class='error'>Lỗi !!!!</span>";
				return $alert;
				}
		    }
		}
	}



	// /
	// /
	public function show_brand()
	{
		$query = "SELECT * FROM tbl_brand order by brandId DESC";
			$result =$this->db->insert($query);
			return $result;
	}

	public function getbrandbyId($id)
	{
		$query = "SELECT * FROM tbl_brand WHERE brandId='$id'";
			$result =$this->db->select($query);
			return $result;
	}

	public function update_brand($brandName,$id)
		{
			$brandName = $this->fm->validation($brandName); //gọi ham validation từ file Format để ktra
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$id = mysqli_real_escape_string($this->db->link, $id);
			if(empty($brandName)){
				$alert = "<span class='error'>Tên thương hiệu không được bỏ trống</span>";
				return $alert;
			}else{
				$query = "UPDATE tbl_brand SET brandName= '$brandName' WHERE brandId = '$id' ";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Sửa thành công</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Update Category NOT Success</span>";
					return $alert;
				}
			}

		}

		public function del_brand($id)
		{
			$query="DELETE FROM tbl_brand WHERE brandId='$id'";
			$result=$this->db->delete($query);
			if($result)
			{
				$alert="<span class='success'>Xóa thành công thương hiệu</span>";
				return $alert;
			}
			else
			{
				$alert="<span class='success'>Xóa không thành công</span>";
				return $alert;
			}

		}
}

?>