<!DOCTYPE>
<?php 

include("functions/functions.php");

?>
<html>
	<head>
		<title>My Online Shop</title>	
	<link rel="stylesheet" href="includes/styles/style.css" media="all" /> 
	</head>

<body>
	
	<!--Navigation Bar starts-->
	<div class="menubar">
		
		<ul id="menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="all_products.php">All Products</a></li>
			<?php 
			if(isset($_SESSION['customer_email'])){
			echo "<li><a href='customer/my_account.php'>My Account</a></li>" ;
			}
			else {
			echo "<li><a href='customer_login.php'>Login</a></li>";
				}
			?>

			<li><a href="cart.php">Shopping Cart</a></li>
	
		</ul>
		
		<div id="form">
			<form method="get" action="results.php" enctype="multipart/form-data">
				<input type="text" name="user_query" placeholder="Search a Product"/ > 
				<input type="submit" name="search" value="Search" />
			</form>
		
		</div>
		
	</div>
	<!--Navigation Bar ends-->
	
	<!--Header starts here-->
	<div class="header_wrapper">
	
		<a href="index.php"><img id="logo" src="includes/images/logo.gif" /> </a>
		<img id="banner" src="includes/images/ad_banner.gif" />
	</div>
	<!--Header ends here-->
	
	<!--Main Container starts here-->
	<div class="main_wrapper">
	
		<!--Content wrapper starts-->
		<div class="content_wrapper">
		
			<div id="sidebar">
			
				<div id="sidebar_title">Categories</div>
				
				<ul id="cats">
				
				<?php getCats(); ?>
				
				<ul>
					
				<div id="sidebar_title">Brands</div>
				<ul id="cats">
					<?php getBrands(); ?>
				<ul>
			</div>
		
			<div id="content_area">
			
				<div id="products_box">
			<?php 
			$get_pro = "select * from products";

			$run_pro = mysqli_query($con, $get_pro); 
			
			while($row_pro=mysqli_fetch_array($run_pro)){
			
				$pro_id = $row_pro['product_id'];
				$pro_cat = $row_pro['product_cat'];
				$pro_brand = $row_pro['product_brand'];
				$pro_title = $row_pro['product_title'];
				$pro_price = $row_pro['product_price'];
				$pro_image = $row_pro['product_image'];
			
				echo "
						<div id='single_product'>
						
							<h3>$pro_title</h3>
							
							<img src='admin_area/product_images/$pro_image' width='180' height='180' />
							
							<p><b> $ $pro_price </b></p>
							
							<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
							
							<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
						
						</div>
				
				
				";
			
			}
			?>
				</div>	
			</div>
		</div>
		<!--Content wrapper ends-->
		
	</div> 
<!--Main Container ends here-->

	<div id="footer">
		<h3>&copy; PRESENTING AT BVICAM</h3>
		<h4><a href="admin_area/login.php">Admin Login</a></h4>
	</div>
</body>
</html>