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
	.box_left {
    width: 50%;
    border: 1px solid gray;
    float: left;
    padding: 10px;
}
    .box_right {
    width: 45%;
    border: 1px solid gray;
    float: right;
    padding: 10px;
}
    a.a_order {
    	background: gray;
    	padding: 7px 20px;
    	color: #fff;
    	font-size: 21px;
    }
</style>
<form action="" method="post">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
    		<h3>Thanh toán tiền mặt</h3>
    		</div>
    		<div class="clear"></div>
    		<div class="box_left">
    			<div class="cartpage">
			    	<?php
               if(isset($update_quantity_cart)){
               	echo $update_quantity_cart;
               }
			    	?>
			    	<?php
               if(isset($delcart)){
               	echo $delcart;
               }
			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="15%">Product Name</th>
								
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								
							</tr>
							<?php
							$get_product_cart = $ct->get_product_cart();
							$subtotal = 0;
							$qty = 0;
							$I = 0;
							if($get_product_cart){
								
								while($result = $get_product_cart->fetch_assoc()){
									$I++;
							?>
							<tr>
								<td><?php echo $I; ?></td>
								<td><?php echo $result['productName'] ?></td>
								
								<td><?php echo $result['price'].' '.'VNĐ' ?></td>
								<td>
										
										<?php echo $result['quantity'] ?>
										
								</td>
								<td><?php
								$total = $result['price'] * $result['quantity'];
								echo $total.' '.'VNĐ';

								 ?></td>
								
							</tr>
							
		              <?php
		              $subtotal += $total;
		              $qty = $qty + $result['quantity'];
		           }
		        }
		              ?>
							
						</table>
						<?php
                  $check_cart = $ct->check_cart();
                  if($check_cart){
                  
                 ?>
						<table style="float:right;text-align:left;margin: 5px;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php

                         echo $subtotal.' '.'VNĐ';
                         Session::set('sum', $subtotal);
                         Session::set('qty', $qty);
							    ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%(<?php echo $vat = $subtotal * 0.1; ?>)</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php 
                                $vat = $subtotal * 0.1;
                                $gtotal = $subtotal + $vat;
                                echo $gtotal.' '.'VNĐ';
								    ?>
								</td>
							</tr>
							
					   </table>
					   <?php
                   }else{
                   	echo 'Your Cart Is Empty! Please Shopping Now';
                   }


					   ?>
					</div>
    		</div>
    		<div class="box_right">
    			<table class="tblone">
    			<?php
    			$Id = Session::get('customer_Id');
                 $get_customers = $cs -> show_customers($Id);
                 	if($get_customers){
                 		while($result = $get_customers->fetch_assoc()){
                 	
    			?>
    			<tr>
    				<td>Name</td>
    				<td>:</td>
    				<td><?php echo $result['name'] ?></td>
    			</tr>
    			<tr>
    				<td>City</td>
    				<td>:</td>
    				<td><?php echo $result['city'] ?></td>
    			</tr>
    			<tr>
    				<td>Phone</td>
    				<td>:</td>
    				<td><?php echo $result['phone'] ?></td>
    			</tr>
    			<!-- <tr>
    				<td>Country</td>
    				<td>:</td>
    				<td><?php echo $result['country'] ?></td>
    			</tr> -->
    			<tr>
    				<td>Zipcode</td>
    				<td>:</td>
    				<td><?php echo $result['zipcode'] ?></td>
    			</tr>
    			<tr>
    				<td>Email</td>
    				<td>:</td>
    				<td><?php echo $result['email'] ?></td>
    			</tr>
    			<tr>
    				<td>Address</td>
    				<td>:</td>
    				<td><?php echo $result['address'] ?></td>
    			</tr>
    			<tr>
    				
    				<td colspan="3"><a href="editprofile.php">Update Profile</a></td>
    				
    			</tr>
    			
    			
    			<?php
                }
            }
    			?>
    		</table>
    		</div>
    	
 		</div>

 	</div>
 	<center><a href="?orderId=order" class="a_order">Order now</a></center><br>
</div>

	<?php
include_once("inc/footer.php");
?>