<?php
include_once ("inc/header.php");
//include_once ("inc/slider.php");
?>
<?php
if(isset($_GET['orderId']) && $_GET['orderId']=='order'){
        $customer_Id = Session::get('customer_Id');
        $insertOrder = $ct->insertOrder($customer_Id);
        $delCart = $ct -> del_all_data_cart();
        header('Location:success.php');
    }
  
//   if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])) {
//     $quantity = $_POST['quantity'];
//     $AddtoCart = $ct -> add_to_cart($quantity, $Id);

// }
?>
<style type="text/css">
	h2.success_order{
		text-align: center;
		color: red;
	}
   p.success_note{
      text-align: center;
      padding: 8px;
      font-size: 17px;
   }
</style>
<form action="" method="post">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<h2 class="success_order">Dat hang thanh cong</h2>
         <?php
           $customer_Id = Session::get('customer_Id');
           $get_amount = $ct -> getAmountPrice($customer_Id);
           if($get_amount){
            $amount = 0;
            while($result = $get_amount -> fetch_assoc()){
               $price = $result['price'];
               $amount += $price;

            }
           }
         ?>
    	    <p class="success_note">Tong so tien ban da mua tai website la: 
            <?php 
            $vat = $amount * 0.1;
            $total = $vat + $amount;
            echo $total. 'VND';
            ?> 
          </p>
          <p class="success_note">Chung toi se lien lac toi ban som nhat. Hay theo doi chi tiet don hang cua ban <a href="orderdetails.php">tai day</a></p>

 		</div>

 	</div>
</div>

	<?php
include_once("inc/footer.php");
?>