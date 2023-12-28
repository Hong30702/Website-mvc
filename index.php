<?php
include_once ("inc/header.php");
include_once ("inc/slider.php");
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nổi bật</h3>

    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
             $product_featured = $product->getproduct_featured();
             if($product_featured){
               while($result = $product_featured->fetch_assoc()){
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'], 50) ?></p>
					 <p><span class="price"><?php echo $result['price']." "."VND" ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
			}
            }
				?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sản phẩm mới</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
             $product_new = $product->getproduct_new();
             if($product_new){
               while($result_new = $product_new->fetch_assoc()){
             	
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
					 <h2><?php echo $result_new['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result_new['product_desc'], 50) ?></p>
					 <p><span class="price"><?php echo $result_new['price']." "."VND" ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result_new['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
			}
            }
				?>
			</div>
    </div>
 </div>
<?php
include_once("inc/footer.php");
?>