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
		  <style>
	  /* Make the image fully responsive */
	  .carousel-inner img {
	    width: 100%;
	    height: 100%;
	  }
	  </style>
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
			<form id="fm" method="get" action="results.php" enctype="multipart/form-data">
				<input type="text" name="user_query" placeholder="Search a Product"/ > 
				<input type="submit" name="search" value="Search" />
			</form>
		</div>
	</div>
		<!--Navigation Bar ends-->

	<!--Header starts here-->
	<div id= "demo" class="carousel slide header_slider" data-ride="carousel">
	  <ul class="carousel-indicators">
	    <li data-target="#demo" data-slide-to="0" class="active"></li>
	    <li data-target="#demo" data-slide-to="1"></li>
	    <li data-target="#demo" data-slide-to="2"></li>
	  </ul>
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img src="includes/images/ads1.png" alt="Los Angeles" width="1100" height="500">
	      <div class="carousel-caption">
	        <h3>Fitness Band</h3>
	        <p>Best In class</p>
	      </div>   
	    </div>
	    <div class="carousel-item">
	      <img src="includes/images/2nd.png" alt="Chicago" width="1100" height="500">
	      <div class="carousel-caption">
	        <h3>Chicago</h3>
	        <p>Thank you, Chicago!</p>
	      </div>   
	    </div>
	    <div class="carousel-item">
	      <img src="includes/images/ads.png" alt="New York" width="1100" height="500">
	      <div class="carousel-caption">
	        <h3>New York</h3>
	        <p>We love the Big Apple!</p>
	      </div>   
	    </div>
	  </div>
	  <a class="carousel-control-prev" href="#demo" data-slide="prev">
	    <span class="carousel-control-prev-icon"></span>
	  </a>
	  <a class="carousel-control-next" href="#demo" data-slide="next">
	    <span class="carousel-control-next-icon"></span>
	  </a>
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
					echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>" ;
					}
					else {
					echo "<b>Welcome Guest:</b>";
						}
					?>
					
					<b style="color:yellow">Shopping Cart -</b> Total Items: <?php total_items();?> Total Price: <?php total_price(); ?> <a href="cart.php" style="color:yellow">Go to Cart</a>
					
					
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
				
				<?php getPro(); ?>
				<?php getCatPro(); ?>
				<?php getBrandPro(); ?>		
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