<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");
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
		$this -> db = new database();
		$this -> fm = new format();
	}
	public function insert_product($data,$files){

		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link, $data['category']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		//kiem tra hinh anh va lay hinh anh cho vao folder uploads
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;
		 

	if($productName == "" || $brand == "" ||  $category == "" || $product_desc == "" || $price == "" || $type == "" || $image = ""){

        $alert = "<span class='error'>Fields must be not empty</span>";
        return $alert;
       }else{
       	move_uploaded_file($file_temp, $uploaded_image);
         $query = "INSERT INTO tbl_product (productName,brandId,catId,product_desc,price,type,image) VALUES('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";
         $result = $this->db->insert($query);
         if($result==true){
         	$alert="<span class='success'> Insert Product Successfully</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'> Insert Product Not Success</span>";
         	return $alert;
         }
        }

	}
	public function update_product($data,$files,$Id){

		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link, $data['category']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		//kiem tra hinh anh va lay hinh anh cho vao folder uploads
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;

		if($productName=="" || $brand=="" ||  $category=="" || $product_desc=="" || $price=="" || $type==""){

        $alert = "<span class='error'>Fields must be not empty</span>";
        return $alert;
       }else{
       	if(!empty($file_name)){
       		//neu nguoi dung chon anh
        if($file_size > 100000) {
      
        	$alert="<span class='success'> Image size should be less then 2MB!</span>";
         	return $alert;
        }
        elseif (in_array($file_ext, $permited) === false)
        {
        	//echo "<span class='error'>You can upload only: ".implode(', ', $permited)."</span>";
        	$alert="<span class='success'>You can upload only: ".implode(', ', $permited)."</span>";
         	return $alert;
        }
        move_uploaded_file($file_temp, $uploaded_image);	
        $query = "UPDATE tbl_product SET 
        productName = '$productName',
        brandId = '$brand',
        catId = '$category',
        type = '$type',
        price = '$price',
        image = '$unique_image',
        product_desc = '$product_desc'
        WHERE productId = '$Id'";	 
         $result = $this->db->update($query);
         if($result==true){
         	$alert="<span class='success'>Product Updated Successfully</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'>Product Update Not Success</span>";
         	return $alert;
         }

      }else{
         //Neu nguoi dung khong chon anh
      	$query = "UPDATE tbl_product SET 
        productName = '$productName',
        brandId = '$brand',
        catId = '$category',
        type = '$type',
        price = '$price',
        product_desc = '$product_desc'
        WHERE productId = '$Id'";	 
      }
         $result = $this->db->update($query);
         if($result==true){
         	$alert="<span class='success'>Product Updated Successfully</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'>Product Update Not Success</span>";
         	return $alert;
         }
      }
       
	}
	public function show_product(){
$query = "
SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName

FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
                 INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
order by tbl_product.productId desc";

		//$query = "SELECT * FROM tbl_product order by productId desc";


        $result = $this->db->select($query);
        return $result;
	}
	public function getproductbyId($Id){
		$query = "SELECT * FROM tbl_product WHERE productId = '$Id'";
        $result = $this->db->select($query);
        return $result;
	}
	public function del_product($Id){
$query = "DELETE FROM tbl_product WHERE productId = '$Id'";
        $result = $this->db->delete($query);
        if($result){

        		$alert="<span class='success'>Product Deleted Successfully</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'>Product Delete Not Success</span>";
         	return $alert;
         }
       }
    //End backend
       public function getproduct_featured(){
       	$query = "SELECT * FROM tbl_product WHERE type ='1' LIMIT 4";
        $result = $this->db->select($query);
        return $result;
       }
       public function getproduct_new(){
         $query = "SELECT * FROM tbl_product order by productId desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
       }
       public function get_details($Id){
        $query = "
      SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName

      FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId

      INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$Id'
      
      ";

      $result = $this->db->select($query);
      return $result;
       }
       //Lấy ra các sản phẩm nổi bật của Apple
       public function getLastestiPhone(){
         $query = "SELECT * FROM tbl_product WHERE productId='2' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
       }
       public function getLastestiPad(){
         $query = "SELECT * FROM tbl_product WHERE productId='1' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
       }
       public function getLastestMacBook(){
         $query = "SELECT * FROM tbl_product WHERE productId='5' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
       }
       public function getLastestAirPods(){
         $query = "SELECT * FROM tbl_product WHERE productId='4' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
       }
       //Lấy ra các thương hiệu nổi bật
       // public function getLastestApple(){
       //   $query = "SELECT * FROM tbl_product WHERE brandId='1' order by productId desc LIMIT 1";
       //  $result = $this->db->select($query);
       //  return $result;
       // }
       // public function getLastestSamSung(){
       //   $query = "SELECT * FROM tbl_product WHERE brandId='2' order by productId desc LIMIT 1";
       //  $result = $this->db->select($query);
       //  return $result;
       // }
       // public function getLastestDell(){
       //   $query = "SELECT * FROM tbl_product WHERE brandId='3' order by productId desc LIMIT 1";
       //  $result = $this->db->select($query);
       //  return $result;
       // }
       // public function getLastestOppo(){
       //   $query = "SELECT * FROM tbl_product WHERE brandId='4' order by productId desc LIMIT 1";
       //  $result = $this->db->select($query);
       //  return $result;
       // }

     }
	?>

