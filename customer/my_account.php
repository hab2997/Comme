<!DOCTYPE>
<?php 
session_start();
include("includes/functions/functions.php");
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
	<div class="menubar navbar navbar-expand-sm bg-dark fixed-top">
		
		<ul id="menu">
			<li><a href="../index.php">Home</a></li>
			<li><a href="../all_products.php">All Products</a></li>
			<li><a href="customer/my_account.php">My Account</a></li>
			<li><a href="../cart.php">Shopping Cart</a></li>
		
		</ul>
		
		<div id="form">
			<form method="get" action="../results.php" enctype="multipart/form-data">
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
			
				<div id="shopping_cart"> 
					
					<span style="float:right; font-size:17px; padding:5px; line-height:40px;">
					
					<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b><br/>" . $_SESSION['customer_email'] ;
					
					}
					?>
					
					<?php 
					if(!isset($_SESSION['customer_email'])){
					
					echo "<a href='../checkout.php' style='color:orange;'>Login</a>";
					
					}
					else {
					echo "<a href='../logout.php' style='color:orange;'>Logout</a>";
					}
					
					?>
	
					</span>
			</div>
			
				<div id="sidebar_title">My Account:</div>
				
				<ul id="cats">
				<?php 
				$user = $_SESSION['customer_email'];
				
				$get_img = "select * from customers where customer_email='$user'";
				
				$run_img = mysqli_query($con, $get_img); 
				
				$row_img = mysqli_fetch_array($run_img); 
				
				$c_image = $row_img['customer_image'];
				
				$c_name = $row_img['customer_name'];
				
				echo "<p style='text-align:center;'><img src='customer_images/$c_image' width='150' height='150'/></p>";
				
				?>
				<li><a href="my_account.php?my_orders">My Orders</a></li>
				<li><a href="my_account.php?edit_account">Edit Account</a></li>
				<li><a href="my_account.php?change_pass">Change Password</a></li>
				<li><a href="my_account.php?delete_account">Delete Account</a></li>
				<li><a href="logout.php">Logout</a></li>
				
				<ul>
				
				</div>
					
		
			<div id="content_area">
			
			<?php cart(); ?>	
		
				<div id="products_box">
				
				<?php 
				if(!isset($_GET['my_orders'])){
					if(!isset($_GET['edit_account'])){
						if(!isset($_GET['change_pass'])){
							if(!isset($_GET['delete_account'])){
							
				echo "
				<h2 style='padding:20px;'>Welcome:  $c_name </h2>
				<b>You can see your orders progress by clicking this <a href='my_account.php?my_orders'>link</a></b>";
				}
				}
				}
				}
				?>
				
				<?php 
				if(isset($_GET['edit_account'])){
				include("edit_account.php");
				}
				if(isset($_GET['change_pass'])){
				include("change_pass.php");
				}
				if(isset($_GET['delete_account'])){
				include("delete_account.php");
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