<?php 

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');

?>
<?php 

/**
 * 
 */
class product
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
	public function insert_product($data,$files)
	{
		//Kiểm tra dữ liệu nhập vào có hợp lệ không , có dấu gì không
		

		// 2 biến , 1 biến là kết nối csdl , 1 biến là dữ liệu;
		$productName = mysqli_real_escape_string($this->db->link,$data['productName']);
		$brand = mysqli_real_escape_string($this->db->link,$data['brand']);
		$category = mysqli_real_escape_string($this->db->link,$data['category']);
		$product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
		$price_mua = mysqli_real_escape_string($this->db->link,$data['price_mua']);
		$price = mysqli_real_escape_string($this->db->link,$data['price']);
		$quantity = mysqli_real_escape_string($this->db->link,$data['quantity']);
		$type = mysqli_real_escape_string($this->db->link,$data['type']);
		$permited = array('jpg','jpeg','png','gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;

	

		if($productName==""||$brand==""||$category==""||$product_desc==""||$price==""||$type==""||$file_name==""
		||$price_mua=="" || $quantity=="")
		{
			$alert="<span class='error'>Các trường không được bỏ trống</span>";
			return $alert;
		}
		else
		{
			move_uploaded_file($file_temp, $uploaded_image);
			// $query()="SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPassword' LIMIT 1";
			$query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,price_mua,sl,type,image) VALUES('$productName','$brand','$category','$product_desc','$price','$price_mua','$quantity','$type','$unique_image')";
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



	///
	///
	public function show_product()
	{
		$query = "
		SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
		FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
		INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
		order by tbl_product.productId desc
		";

		// $query = "SELECT * FROM tbl_product order by productId DESC";
			$result =$this->db->insert($query);
			return $result;
	}

	public function getproductbyId($id)
	{
		$query = "SELECT * FROM tbl_product WHERE productId='$id'";
			$result =$this->db->select($query);
			return $result;
	}

	public function update_product($data,$files,$id){
	
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price_mua = mysqli_real_escape_string($this->db->link, $data['price_mua']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$quantity = mysqli_real_escape_string($this->db->link,$data['quantity']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if($productName == "" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type=="" || 
			$price_mua=="" || $quantity==""){
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert; 
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 2048000) {

		    		 $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE tbl_product SET
					productName = '$productName',
					brandId = '$brand',
					catId = '$category', 
					type = '$type',
					price_mua='$price_mua', 
					price = '$price',
					sl ='$quantity', 
					image = '$unique_image',
					product_desc = '$product_desc'
					WHERE productId = '$id'";
					
				}else{
					//Nếu người dùng không chọn ảnh
					$query = "UPDATE tbl_product SET

					productName = '$productName',
					brandId = '$brand',
					catId = '$category', 
					type = '$type',
					price_mua='$price_mua', 
					price = '$price', 
					sl ='$quantity',
					product_desc = '$product_desc'

					WHERE productId = '$id'";
					
				}
				$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Sản phẩm Updated thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Sản phẩm Updated không thành công</span>";
						return $alert;
					}
				
			}

		}
		public function del_product($id)
		{
			$query = "DELETE FROM tbl_product where productId = '$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Product Deleted Successfully</span>";
				return $alert;
			}else {
				$alert = "<span class='success'>Product Deleted Not Success</span>";
				return $alert;
			}
		}


		//END BACKEN
		
		//Hàm lấy sản phẩm nổi bật
		public function getproduct_feathered()
		{
			$query = "SELECT * FROM tbl_product WHERE type='0'";
			$result =$this->db->select($query);
			return $result;
		}

		//Hàm lấy ra sản phẩm mới
		public function getproduct_new()
		{
			$query = "SELECT * FROM tbl_product order by productId desc LIMIT 4";
			$result =$this->db->select($query);
			return $result;
		}

		public function get_details($id)
		{

		$query = "
		SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
		FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
		INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId ='$id'";

		// $query = "SELECT * FROM tbl_product order by productId DESC";
			$result =$this->db->insert($query);
			return $result;
		}



		public function getLastestYamaha()
		{
			$query = "SELECT * FROM tbl_product WHERE brandId ='6' order by productId desc LIMIT 1";
			$result =$this->db->select($query);
			return $result;
		}

		public function getLastestHonda()
		{
			$query = "SELECT * FROM tbl_product WHERE brandId ='4' order by productId desc LIMIT 1";
			$result =$this->db->select($query);
			return $result;
		}
		public function getLastestDucati()
		{
			$query = "SELECT * FROM tbl_product WHERE brandId ='3' order by productId desc LIMIT 1";
			$result =$this->db->select($query);
			return $result;
		}
		public function getLastestSuzuki()
		{
			$query = "SELECT * FROM tbl_product WHERE brandId ='5' order by productId desc LIMIT 1";
			$result =$this->db->select($query);
			return $result;
		}

		public function show_product_Yamaha()
	     {

		 $query = "SELECT * FROM tbl_product WHERE brandId ='6'";
			$result =$this->db->insert($query);
			return $result;
	     }
	     public function show_product_HonDa()
	     {

		 $query = "SELECT * FROM tbl_product WHERE brandId ='4'";
			$result =$this->db->insert($query);
			return $result;
	     }
	     public function show_product_Suzuki()
	     {

		 $query = "SELECT * FROM tbl_product WHERE brandId ='5'";
			$result =$this->db->insert($query);
			return $result;
	     }
	     public function show_product_Ducati()
	     {

		 $query = "SELECT * FROM tbl_product WHERE brandId ='3'";
			$result =$this->db->insert($query);
			return $result;
	     }

	     public function product_name_search($product_name_search)
	     {
	     	$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$product_name_search%'";
			$result_search =$this->db->select($query);
			return $result_search;
	     }





}

?>