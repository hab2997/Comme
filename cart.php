<!DOCTYPE>
<?php 
session_start(); 

include("functions/functions.php");

include("includes/db.php");
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
				</ul>
				<div id="sidebar_title">Brands</div>
				<ul id="cats">
					<?php getBrands(); ?>
				<ul>
			</div>
		
			<div id="content_area">
				<?php cart(); ?>
			
				<div id="products_box">
				
				<form action="" method="post" enctype="multipart/form-data">
			
				<table align="center" width="700" bgcolor="skyblue">
					
					<tr align="center">
						<th>Remove</th>
						<th>Product(S)</th>
						<th>Quantity</th>
						<th>Total Price</th>
					</tr>
					
		<?php 
		$total = 0;
		
		global $con; 
		
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_add='$ip'";
		
		$run_price = mysqli_query($con, $sel_price); 
		
		while($p_price=mysqli_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id']; 
			$_SESSION['qty'] = $p_price['qty'];
			$pro_price = "select * from products where product_id='$pro_id'";
			
			$run_pro_price = mysqli_query($con,$pro_price); 
			
			while ($pp_price = mysqli_fetch_array($run_pro_price)){
			
			$single_price = $pp_price['product_price'] * $_SESSION['qty'];
			$product_price = array($single_price);
			
			$product_title = $pp_price['product_title'];
			
			$product_image = $pp_price['product_image']; 
			
			
			
			$values = array_sum($product_price); 
			
			$total += $values; 
					
					?>
					
					<tr align="center">
						<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
						<td><?php echo $product_title; ?><br>
						<img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60"/>
						</td>
						<td><input type="text" size="4" name="qty" value="<?php echo $_SESSION['qty'];?>"/></td>
						<td><?php echo $single_price . " INR"; ?></td>
					</tr>
						
					
				<?php } } ?>
				
				<tr>
						<td colspan="4" align="right"><b>Sub Total:</b></td>
						<td><?php echo $total . " INR";?></td>
					</tr>
					
					<tr align="center">
						<td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
						<td><input type="submit" name="continue" value="Continue Shopping" /></td>
						<td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
					</tr>
					
				</table> 
			
			</form>
			
	<?php 
		
	function updatecart(){
		
		global $con; 
		
		$ip = getIp();
		
		if(isset($_POST['update_cart'])){
		
			foreach($_POST['remove'] as $remove_id){
			
			$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
			
			$run_delete = mysqli_query($con, $delete_product); 
			
			if($run_delete){
			
			echo "<script>window.open('cart.php','_self')</script>";
			
			}
			
			}
		
		}
		if(isset($_POST['continue'])){
		
		echo "<script>window.open('index.php','_self')</script>";
		
		}
			if(isset($_POST['qty']))
			{
				$changeqty = $_POST['qty'];
				$update_qty = "UPDATE cart set qty = '$changeqty' where ip_add='$ip' AND p_id='$pro_id";
				$run_qty = mysqli_query($con, $update_qty); 
			}
			$total = $total;	
	}
	echo @$up_cart = updatecart();
	
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