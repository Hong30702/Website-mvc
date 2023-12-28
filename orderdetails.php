<?php
include_once ("inc/header.php");
//include_once ("inc/slider.php");
?>
<?php
// if(isset($_GET['cartId'])){
//         $cartId = $_GET['cartId'];
//         $delcart = $ct -> del_product_cart($cartId);
//     }
// if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])) {
// 	 $cartId = $_POST['cartId'];
//     $quantity = $_POST['quantity'];
//     $update_quantity_cart = $ct -> update_quantity_cart($quantity, $cartId);
//     if($quantity<=0){
//     	$delcart = $ct -> del_product_cart($cartId);
//     }
// }
?>
<!-- <?php
  // if(!isset($_GET['Id'])){
  // 	echo "<meta http-equiv='refresh' content='0;URL=?Id=live'>";
  // }
?> -->

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Details Cart</h2>
			    	
						<table class="tblone">
							<tr>
								<th width="10%">ID</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Date</th>
								<th width="10%">Status</th>

								<th width="10%">Action</th>
							</tr>
							<?php
							$customer_Id = Session::get('customer_Id');
							$get_cart_ordered = $ct->get_cart_ordered($customer_Id);
							$i=0;
							$qty = 0;
							if($get_cart_ordered){
								
								while($result = $get_cart_ordered->fetch_assoc()){
									$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $result['price'] ?></td>
								<td>
									
										
										<?php echo $result['quantity'] ?>
										
								
								</td>
								<td><?php echo $fm->formatDate($result['date_order'])?></td>
							    <td>
							    	<?php
                                     if($result['status']=='0'){
                                     	echo 'Pending';
                                     }else{
  										echo 'Procesed';
                                     }
							    	?>
							    </td>
							    <?php
							    	if($result['status']=='0'){	

							    ?>
							    <td><?php echo 'N/A';?></td>
							<?php

								}else{
							?>
				  <td><a onclick="return confirm('Bạn có muốn xóa?');" href="?cartId=<?php echo $result['cartId']?>">Xóa</a></td>
				<?php }?>
							</tr>
							
		              <?php
		              
		           }
		        }
		              ?>
							
						</table>
						
						
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
include_once("inc/footer.php");
?>
