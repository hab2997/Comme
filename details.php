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
							echo "<a href='#' class='myBtn'>Login</a>";
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
			
		<div id="products_box">
	<?php 
	if(isset($_GET['pro_id']) && (isset($_GET['rate']) && $_GET['rate'] != 'yes'))
	{
		setRating();
	}
	if(isset($_GET['pro_id'])){
	
		$product_id = $_GET['pro_id'];
		$get_pro = "select * from products where product_id='$product_id'";
		$run_pro = mysqli_query($con, $get_pro); 
	
	while($row_pro=mysqli_fetch_array($run_pro)){
	
		$pro_id = $row_pro['product_id'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];
		$rating = getRating($pro_id);
		
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='400' height='300' />
					
					<p><b>Price: $pro_price INR</b></p>
					
					<p>$pro_desc </p>
					
					<a href='index.php' style='float:left;'>Go Back</a>
					
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
					";
					if($rating < 0)
					{
						echo "<br/><a href='details.php?pro_id=$pro_id&rate=yes'>Rate This Product</a>";
					}
					else
					{
						echo "<br/> <b>Rating: $rating</b>";
					}

				echo "</div>";
			if(isset($_GET['pro_id']) && ($_GET['rate'] == 'yes'))
			{
				include('rating.php');
			}				
	
		}
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
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="login.php" method="POST">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" id="usrname" placeholder="Enter email" name="email" required/>
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" id="psw" placeholder="Enter password" name="pass" required/>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button type="submit" class="btn btn-success btn-block" name="login"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p>Not a member? <a href="#">Sign Up</a></p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
      </div>
      
    </div>
  </div> 
</div>
 

<script>
	$(document).ready(function(){
  	$(".myBtn").click(function(){
    $("#myModal").modal();
  });
});


</script>

</body>
</html>