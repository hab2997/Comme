<!DOCTYPE>
<?php 
session_start();
include("functions/functions.php");

?>
<html>
	<head>
		<title>My Online Shop</title>
		  <meta charset="utf-8">
  		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		  <link rel="stylesheet" href="includes/styles/style.css" media="all" />
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		  
	</head>
<body>
	<!--Navigation Bar starts-->
		<div class="menubar navbar navbar-expand-sm bg-dark fixed-top ">
		
		<ul id="menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="all_products.php">All Products</a></li>
			<?php 
			if(isset($_SESSION['customer_email'])){
			echo "<li><a href='customer/my_account.php'>My Account</a></li>" ;
			}
			else {
			echo "<li><a href='#' class='myBtn'>Login</a></li>";
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
		<img id="logo" src="includes/images/logo.jpg" />
	</div>
	<!--Header ends here-->
			
	<!--Main Container starts here-->
	<div class="main_wrapper">
	

	
		<!--Content wrapper starts-->
		<div class="content_wrapper">
		
			<div id="sidebar">
			
			<div id="shopping_cart" style="text-align: center;"> 
					
				<span style=" font-size:17px; padding:5px; line-height:40px;">
					
					<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b><br/>" . $_SESSION['customer_email'] ;
					}
					else {
					echo "<b>Welcome Guest:</b>";
						}
					?>
					
					<b class= "cart-text">Shopping Cart</b><br/> Total Items: <?php total_items();?> Total Price: <?php total_price(); ?> <br/><a href="cart.php" class= "cart-text">Go to Cart</a>
					
					
					<?php 
					if(!isset($_SESSION['customer_email']))
					{
						echo "<a href='checkout.php' style='color:orange;'>Login</a>";
					}
					else 
					{
						echo "<a href='logout.php' style='color:orange;'>Logout</a>";
					}
					?>
				</span>
			</div>
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
			
			<?php cart(); ?>
			
				<div id="products_box">
				
				<?php 
				if(!isset($_SESSION['customer_email'])){
					
					include("customer_login.php");
				}
				else {
				
				include("payment.php");
				
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
		<h5><a href="admin_area/login.php">Admin Login</a></h5>
	</div>


</body>
</html>