<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");	
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
		$this -> db = new database();
		$this -> fm = new format();
	}
	public function insert_customers($data){
       $name = mysqli_real_escape_string($this->db->link, $data['name']);
       $city = mysqli_real_escape_string($this->db->link, $data['city']);
       $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
       $email = mysqli_real_escape_string($this->db->link, $data['email']);
       $address = mysqli_real_escape_string($this->db->link, $data['address']);
       $country = mysqli_real_escape_string($this->db->link, $data['country']);
       $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
       $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
       if($name=="" || $city== "" || $zipcode== "" || $email== "" || $address== "" || $country== "" || $phone== "" || $password==""){
          $alert = "<span class='error'>Fields must be not empty</span>";
          return $alert;
             
	  }else{
         $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1 ";
         $result_check = $this->db->select($check_email);
         if($result_check){
         	$alert = "<span class='error'>Email Da Ton Tai</span>";
            return $alert;
         }else{
         	$query = "INSERT INTO tbl_customer (name,city,zipcode,email,address,country,phone, password) VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
         $result = $this->db->insert($query);	
         if($result==true){
         	$alert="<span class='success'> Customer Created Successfully</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'> Customer Created Not Success</span>";
         	return $alert;
         }
         }
	  }
	
}
    public function login_customers($data){
       $email = mysqli_real_escape_string($this->db->link, $data['email']);
       $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
       if($email=="" || $password==""){
          $alert = "<span class='error'>Tai khoan hoac mat khau khong dung! Vui long nhap lai</span>";
          return $alert;
             
	  }else{
         $check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password = '$password' LIMIT 1 ";
         $result_check = $this->db->select($check_login);
         if($result_check != false){
         	$value	= $result_check->fetch_assoc();
         	Session::set('customer_login', true);
         	Session::set('customer_Id', $value['Id']);
         	Session::set('customer_name', $value['name']);
         	header('Location:cart.php');
         }else{
         	$alert = "<span class='error'>Email hoac Mat Khau khong ton tai!</span>";
            return $alert;
         }
	  }
}
    public function show_customers($Id){
      $query = "SELECT * FROM tbl_customer WHERE Id='$Id'";
      $result = $this->db->select($query);
      return $result;
    }
    public function update_customers($data, $Id){
         $name = mysqli_real_escape_string($this->db->link, $data['name']);

       $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
       $email = mysqli_real_escape_string($this->db->link, $data['email']);
       $address = mysqli_real_escape_string($this->db->link, $data['address']);
    
       $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

       if($name=="" || $zipcode== "" || $email== "" || $address== "" || $phone== ""){
          $alert = "<span class='error'>Fields must be not empty</span>";
          return $alert;
             
     }else{
            $query = "UPDATE tbl_customer SET name='$name',zipcode='$zipcode',email='$email',address='$address',phone='$phone' WHERE Id = '$Id'";
         $result = $this->db->insert($query);   
         if($result==true){
            $alert="<span class='success'> Customer Updated Successfully</span>";
            return $alert;
         }
         else{
            $alert="<span class='error'> Customer Updated Not Success</span>";
            return $alert;
         }
         }
     }
    

}
	?>


