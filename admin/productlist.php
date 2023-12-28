<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once("../classes/brand.php");?>
<?php include_once("../classes/category.php");?>
<?php include_once("../classes/product.php");?>
<?php include_once("../helpers/format.php");?>
<?php
$fm = new Format();	
$pd = new product();
   if(isset($_GET['productId'])){
        $Id = $_GET['productId'];
        $delpro = $pd -> del_product($Id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">
        <?php  
        	if(isset($delpro)){
             echo $delpro;
        	}
        ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên SP</th>
					<th>Giá SP</th>
					<th>Ảnh SP</th>
					<th>Loại SP</th>
					<th>Thương hiệu</th>
					<!-- <th>Mô tả</th> -->
					<th>Phân loại</th>
					<th>Thao tác</th>
				</tr>
			</thead>
			<tbody>
            <?php
             $pd = new product();
           
             $pdlist = $pd -> show_product();
             if($pdlist){
             	$i = 0;
             	while($result = $pdlist -> fetch_assoc()){
                  $i++;

            ?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $result['price'] ?></td>
					<td><img src="uploads/<?php echo $result['image'] ?>" width="70"></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<!-- <td><?php echo $fm->textShorten($result['product_desc'], 20) ?></td> -->
					<td><?php 
					if($result['type']==1){
						echo 'Nổi bật';
					}else{
						echo 'Bình thường';
					}

				         ?></td>
					<!-- <td class="center"></td> -->
					<td><a href="productedit.php?productId=<?php echo $result['productId']?>">Sửa</a> || <a href="?productId=<?php echo $result['productId']?>">Xóa</a></td>
				</tr>
				<?php
			}
                }
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include_once 'inc/footer.php';?>
