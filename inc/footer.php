</div>
   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Thông tin</h4>
						<ul>
						<li><a href="#">Giới thiệu</a></li>
						<li><a href="#">Liên hệ</a></li>
						<li><a href="#">Phương thức thanh toán</a></li>
						<li><a href="#">Hướng dẫn mua hàng</a></li>
						<li><a href="#">Gửi góp ý, khiếu nại</a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Chính sách</h4>
						<ul>
						<li><a href="about.html">Về chúng tôi</a></li>
						<li><a href="faq.html">Chăm sóc khách hàng</a></li>
						<li><a href="#">Chính sách bảo mật</a></li>
						<li><a href="contact.html">Chính sách bảo hành</a></li>
						<li><a href="preview.html">Điều khoản sử dụng</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Tài khoản</h4>
						<ul>
							<li><a href="login.php">Đăng nhập</a></li>
							<li><a href="cart.<?php 	 ?>">Xem giỏ hàng</a></li>
							<li><a href="#">Sản phẩm yêu thích</a></li>
							<li><a href="#">Theo dõi đơn hàng</a></li>
							<li><a href="faq.html">Hỗ trợ</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Liên lạc</h4>
						<ul>
							<li><span>0386721050</span></li>
							<li><span>0868666970</span></li>
						</ul>
						<div class="social-icons">
							<h4>Theo dõi</h4>
					   		  <ul>
							      <li class="facebook"><a href="https://www.facebook.com/reseller.com.vn/" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<!-- <div class="copy_right">
				<p>Training with live project &amp; All rights Reseverd </p>
		   < -->
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>