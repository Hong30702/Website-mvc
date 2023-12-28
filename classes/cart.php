<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");	
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
		$this -> db = new database();
		$this -> fm = new format();
	}
	public function add_to_cart($quantity, $Id){
		$quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$Id = mysqli_real_escape_string($this->db->link, $Id);
		$sId = session_Id();

		$query = "SELECT * FROM tbl_product WHERE productId = '$Id' ";
		$result = $this -> db ->select($query)->fetch_assoc();
		
		$image = $result["image"];
		$price = $result["price"];
		$productName = $result["productName"];

        $query_cart = "SELECT * FROM tbl_cart WHERE productId = '$Id' AND sId = '$sId'";
        $check_cart =  $this->db->select($query_cart); 

        if($check_cart){
        	$msg = "Product Already Added";
        	return $msg;
        }else{
		$query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES('$Id','$quantity','$sId',
			'$image','$price','$productName')";
        $insert_cart = $this->db->insert($query_insert);

         if($insert_cart){
         	header("Location:cart.php");
         }
         else{
         	header("Location:404.php");
         }
     }
     }
     public function get_product_cart(){
     	$sId = session_Id();
     	$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
     	$result = $this -> db ->select($query);
     	return $result;
     }
     public function update_quantity_cart($quantity, $cartId){
     	$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart SET 

                  quantity = '$quantity'

                  WHERE cartId= '$cartId'";
        $result = $this -> db ->update($query);
     	if($result){
     		header("Location:cart.php");
     	}else{
     		$msg = "<span class='error'>Product Quantity Updated Not Successfully</span>";
        	return $msg;
     	}
     }
     public function del_product_cart($cartId){
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
     	$result = $this -> db ->delete($query);
     	if($result){
     		header("Location:cart.php");
     		
     	}else{
     		$msg = "<span class='error'>Product Deleted Not Successfully</span>";
        	return $msg;
     	}
     }
     public function check_cart(){
     	$sId = session_Id();
     	$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
     	$result = $this -> db ->select($query);
     	return $result;
     }
     public	function del_all_data_cart(){
     	$sId = session_Id();
     	$query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
     	$result = $this -> db ->select($query);
     	return $result;
     }
     public function insertOrder($customer_Id){
      $sId = session_Id();
      $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
      $get_product = $this -> db ->select($query);
      if($get_product){
        while($result = $get_product->fetch_assoc()){
          $productId = $result['productId'];
          $productName = $result['productName'];
          $quantity = $result['quantity'];
          $price = $result['price'] * $quantity;
          $image = $result['image'];
          $customer_Id = $customer_Id;
          $query_order = "INSERT INTO tbl_order(productId,productName,quantity,price,image,customer_Id) VALUES('$productId','$productName','$quantity',
          '$price','$image','$customer_Id')";
          $insert_order = $this->db->insert($query_order);

          
        }
      }
     }
     public function getAmountPrice($customer_Id){
      $query = "SELECT price FROM tbl_order WHERE customer_Id = '$customer_Id'";
      $get_price = $this -> db ->select($query);
      return $get_price;
     }
     public function get_cart_ordered($customer_Id){
      $query = "SELECT * FROM tbl_order WHERE customer_Id = '$customer_Id'";
      $get_cart_ordered = $this -> db ->select($query);
      return $get_cart_ordered;
     }
	}
	?>

