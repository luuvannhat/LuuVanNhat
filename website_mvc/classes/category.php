<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>


<?php 

/**
 * 
 */
class category
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
	public function insert_category($catName)
	{
		//Kiểm tra dữ liệu nhập vào có hợp lệ không , có dấu gì không
		$catName = $this->fm->validation($catName);
		

		// 2 biến , 1 biến là kết nối csdl , 1 biến là dữ liệu;
		$catName = mysqli_real_escape_string($this->db->link,$catName);
	

		if(empty($catName))
		{
			$alert="<span class='error'>Danh mục sản phẩm không được bỏ trống</span>";
			return $alert;
		}
		else
		{
			// $query()="SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPassword' LIMIT 1";
			// 
			// 
			$query="SELECT * FROM tbl_category WHERE catName='$catName'";
			$result=$this->db->select($query);
			if($result)
			{
				$alert="<span style='color: red'>Đã tồn tại danh mục này.Hãy thử lại !!!</span>";
			    return $alert;
			}
			else
			{
				 $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
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
			// $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
			// $result =$this->db->insert($query);
			// if($result)
			// {
			// 	$alert="<span class='success'>Thêm thành công</span>";
			// return $alert;
			// }
			// else
			// {
			// 	$alert="<span class='error'>Lỗi !!!!</span>";
			// return $alert;
			// }
		}
	}



	///
	///
	public function show_category()
	{
		$query = "SELECT * FROM tbl_category order by catId DESC";
			$result =$this->db->insert($query);
			return $result;
	}

	public function getcatbyId($id)
	{
		$query = "SELECT * FROM tbl_category WHERE catId='$id'";
			$result =$this->db->select($query);
			return $result;
	}

	public function update_category($catName,$id)
		{
			$catName = $this->fm->validation($catName); //gọi ham validation từ file Format để ktra
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$id = mysqli_real_escape_string($this->db->link, $id);
			if(empty($catName)){
				$alert = "<span class='error'>Category must be not empty</span>";
				return $alert;
			}else{
				$query = "UPDATE tbl_category SET catName= '$catName' WHERE catId = '$id' ";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Category Update Successfully</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Update Category NOT Success</span>";
					return $alert;
				}
			}

		}

		public function del_category($id)
		{
			$query="DELETE FROM tbl_category WHERE catId='$id'";
			$result=$this->db->delete($query);
			if($result)
			{
				$alert="<span class='success'>Xóa thành công danh mục</span>";
				return $alert;
			}
			else
			{
				$alert="<span class='success'>Xóa không thành công</span>";
				return $alert;
			}

		}


		public function show_category_fontend()
	{
		$query = "SELECT * FROM tbl_category order by catId DESC";
			$result =$this->db->insert($query);
			return $result;
	}


	public function get_product_by_cat($id)
		{
			$query = "SELECT * FROM tbl_product where catId = '$id' order by catId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_name_by_cat($id)
		{
			$query = "SELECT tbl_product.*,tbl_category.catName,tbl_category.catId 
					  FROM tbl_product,tbl_category 
					  WHERE tbl_product.catId = tbl_category.catId
					  AND tbl_product.catId ='$id' LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}
}

?>
<span style="color: red"></span>