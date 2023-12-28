<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");
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
		$this -> db = new database();
		$this -> fm = new format();
	}
	public function insert_category($catName){
		$catName = $this -> fm -> validation ($catName);

		$catName = mysqli_real_escape_string($this->db->link, $catName);
		

	if(empty($catName)){

        $alert = "<span class='error'>Category must be not empty</span>";
        return $alert;
       }else{
         $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
         $result = $this->db->insert($query);
         if($result==true){
         	$alert="<span class='success'> Insert Category Successfully</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'> Insert Category Not Success</span>";
         	return $alert;
         }
        }

	}
	public function update_category($catName,$Id){
		$catName = $this -> fm -> validation ($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		$Id = mysqli_real_escape_string($this->db->link, $Id);
		if(empty($catName)){

        $alert = "<span class='error'>Category must be not empty</span>";
        return $alert;
       }else{
         $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$Id'";
         $result = $this->db->update($query);
         if($result==true){
         	$alert="<span class='success'>Category Updated Successfully</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'>Category Update Not Success</span>";
         	return $alert;
         }
        }
	}
	public function show_category(){
		$query = "SELECT * FROM tbl_category order by catId desc";
        $result = $this->db->select($query);
        return $result;
	}
	public function getcatbyId($Id){
		$query = "SELECT * FROM tbl_category WHERE catId = '$Id'";
        $result = $this->db->select($query);
        return $result;
	}
	public function del_category($Id){
    $query = "DELETE FROM tbl_category WHERE catId = '$Id'";
        $result = $this->db->delete($query);
        if($result){

        		$alert="<span class='success'>Category Deleted Successfully</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'>Category Delete Not Success</span>";
         	return $alert;
         }
        }
  public function show_category_fontend(){
		$query = "SELECT * FROM tbl_category order by catId desc";
        $result = $this->db->select($query);
        return $result;
	}
	public function get_product_by_cat($Id){
		$query = "SELECT * FROM tbl_product WHERE catId = '$Id' order by catId desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
	}
	public function get_name_by_cat($Id){
		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_category.catId FROM tbl_product,tbl_category WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$Id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
	}
	}
?>

