<?php 
// After uploading to online server, change this connection accordingly
$con = mysqli_connect("localhost","root","","ecomm");

if (mysqli_connect_errno())
  {
  echo "The Connection was not established: " . mysqli_connect_error();
  }
 // getting the user IP address
  function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
  
  
  
//creating the shopping cart
function cart(){

	if(isset($_GET['add_cart']))
	{
		global $con; 
		
		$ip = getIp();
		
		$pro_id = $_GET['add_cart'];

		$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";
		
		$run_check = mysqli_query($con, $check_pro); 
		
		if(mysqli_num_rows($run_check)>0){
			while($row = mysqli_fetch_array($run_check)){
				
				$_SESSION['qty'] = $row['qty']; 
				$qty = $_SESSION['qty'] + 1;
				$update_qty = "UPDATE cart set qty = '$qty' where ip_add='$ip' AND p_id='$pro_id'";
				$run_update = mysqli_query($con, $update_qty);
			}
		}
	else 
	{
		$insert_pro = "insert into cart (p_id,ip_add, qty) values ('$pro_id','$ip', '$qty')";
		
		$run_pro = mysqli_query($con, $insert_pro); 
		
		echo "<script>window.open('index.php','_self')</script>";
	}
	
}

}

 // getting the total added items
 function total_items(){
 
	if(isset($_GET['add_cart'])){
	
		global $con; 
		$ip = getIp(); 
		 
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($con, $get_items); 
		$count_items = mysqli_num_rows($run_items);
		
		}
		
	else {
		
		global $con; 
		$ip = getIp(); 
		 
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($con, $get_items); 
		$count_items = mysqli_num_rows($run_items);
		
		}
	
	echo $count_items;
	}
  
	// Getting the total price of the items in the cart 
	function total_price(){
	
		$total = 0;
		global $con; 
		$ip = getIp(); 
		$sel_price = "select * from cart where ip_add='$ip'";
		$run_price = mysqli_query($con, $sel_price); 
		while($p_price=mysqli_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id']; 			
			$pro_price = "select * from products where product_id='$pro_id'";
			$run_pro_price = mysqli_query($con,$pro_price); 
			
			while ($pp_price = mysqli_fetch_array($run_pro_price))
			{
			
				$product_price = array($pp_price['product_price']);	
				$values = array_sum($product_price);
				$total +=$values;
			
			}
		
		
		}
		
		echo $total . " INR";
		
	
	}

//getting the categories

function getCats(){
	
	global $con; 
	
	$get_cats = "select * from categories";
	
	$run_cats = mysqli_query($con, $get_cats);
	
	while ($row_cats=mysqli_fetch_array($run_cats)){
	
		$cat_id = $row_cats['cat_id']; 
		$cat_title = $row_cats['cat_title'];
	
	echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	
	
	}


}

//getting the brands

function getBrands(){
	
	global $con; 
	
	$get_brands = "select * from brands";
	
	$run_brands = mysqli_query($con, $get_brands);
	
	while ($row_brands=mysqli_fetch_array($run_brands)){
	
		$brand_id = $row_brands['brand_id']; 
		$brand_title = $row_brands['brand_title'];
	echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	}
}

function getPro(){

	if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){

	global $con; 
	
	$get_pro = "select * from products order by RAND() LIMIT 0,6";

	$run_pro = mysqli_query($con, $get_pro); 
	
	while($row_pro=mysqli_fetch_array($run_pro)){
	
		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
		$rating = getRating($pro_id);	
		echo "
				<a href='details.php?pro_id=$pro_id'>
				<div id='single_product'>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<h3>$pro_title</h3>
					
					<p><b> Price: $pro_price INR</b></p>
					
					<a href='index.php?add_cart=$pro_id'><button style='width: 100%'>Add to Cart</button>
		";
		if($rating > 0){	echo "<br/> Rating : $rating";	}
				
		else{	echo "<br>Not Rated Yet!";	}
		
		echo "	</div> </a>";
		}
	}
}
}

function getCatPro(){

	if(isset($_GET['cat'])){
		
		$cat_id = $_GET['cat'];

	global $con; 
	
	// Getting Products on based of category selected
	$get_cat_pro = "select * from products where product_cat='$cat_id'";
	$run_cat_pro = mysqli_query($con, $get_cat_pro); 	
	$count_cats = mysqli_num_rows($run_cat_pro);
	
	//Getting Category title
	$getcat = "SELECT * from categories where cat_id = '$cat_id'";
	$run_cat = mysqli_query($con, $getcat);
	$cat = mysqli_fetch_array($run_cat);
	$cat_name = $cat['cat_title'];
	if($count_cats==0)
	{
		echo "<h2 style='padding:20px;'>No products where found in this category!</h2>";
	}
		
	echo "<h3 style = 'padding: 5px; text-decoration:underline;'>$cat_name </h3>";

	while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
	
		$pro_id = $row_cat_pro['product_id'];
		$pro_cat = $row_cat_pro['product_cat'];
		$pro_brand = $row_cat_pro['product_brand'];
		$pro_title = $row_cat_pro['product_title'];
		$pro_price = $row_cat_pro['product_price'];
		$pro_image = $row_cat_pro['product_image'];
		$rating = getRating($pro_id);
		echo "
			<a href='details.php?pro_id=$pro_id'>
				<div id='single_product'>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<h3>$pro_title</h3>
					
					<p><b>Price: $pro_price INR</b></p>
					
					<a href='index.php?pro_id=$pro_id'><button style='width: 100%'>Add to Cart</button></a>";
		

		if($rating > 0){	echo "<br/> Rating : $rating";	}
				
		else{	echo "<br>Not Rated Yet!";	}
		
		echo "	</div> </a>";
	
		}	
	}
}

function getBrandPro(){

	if(isset($_GET['brand'])){
		
		$brand_id = $_GET['brand'];

		global $con; 
		
		// Getting Products based on the brand Selected
		$get_brand_pro = "select * from products where product_brand='$brand_id'";
		$run_brand_pro = mysqli_query($con, $get_brand_pro); 
		$count_brands = mysqli_num_rows($run_brand_pro);
		
		// Getting the Brand Title 
		$getbrand = "SELECT * from brands where brand_id = '$brand_id'";
		$run_brand = mysqli_query($con, $getbrand);
		$brand = mysqli_fetch_array($run_brand);
		$brand_name = $brand['brand_title'];
		if($count_brands==0)
		{
			echo "<h2 style='padding:20px;'>No products where found associated with this brand!!</h2>";
		}
		echo "<h3 style = 'padding: 5px; text-decoration:underline;'>$brand_name </h3>";
	
		while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){
	
		$pro_id = $row_brand_pro['product_id'];
		$pro_cat = $row_brand_pro['product_cat'];
		$pro_brand = $row_brand_pro['product_brand'];
		$pro_title = $row_brand_pro['product_title'];
		$pro_price = $row_brand_pro['product_price'];
		$pro_image = $row_brand_pro['product_image'];
		$rating = getRating($pro_id);
		echo "
			<a href='details.php?pro_id=$pro_id'>
				<div id='single_product'>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<h3>$pro_title</h3>
					
					<p><b>Price: $pro_price INR</b></p>
					
					<a href='index.php?pro_id=$pro_id'><button style='width: 100%'>Add to Cart</button></a>";

		if($rating > 0){	echo "<br/> Rating : $rating";	}
				
		else{	echo "<br>Not Rated Yet!";	}
		
		echo "	</div> </a>";

		
	
	}
 	
 }
}

function getRating($pro_id = NULL)
{
	global $con;
	
	$total_rate = 0;
	$avg = 0;
	//get pro_id;
		//get all the rating for a product
		$get_rate = "SELECT * from rating where productId = '$pro_id'"; 
		$run_rate = mysqli_query($con, $get_rate);
		$count_rate = mysqli_num_rows($run_rate);

		if($count_rate > 0)		
		{
			while($rate = mysqli_fetch_array($run_rate))
			{
				$rating	= array($rate['ratingValue']);		
				$values = array_sum($rating);
				$total_rate += $values;
			}
			$avg = $total_rate / $count_rate;
			//$avg = floor($avg);
			return $avg;
		}
		else{
			return -1;
		}
	
}

function setRating()
{
	global $con;
		if(!isset($_SESSION['customer_email']))
			echo "<script> alert('Please Login First');</script> ";
		$user = $_SESSION['customer_email'];
		$get_uid = "SELECT * from customers where customer_email = '$user'";		
		$run_uid = mysqli_query($con, $get_uid);
		$count = mysqli_num_rows($run_uid);
		$uid = NULL;
		if($count > 0)
		{
			while($row = mysqli_fetch_array($run_uid))	
			{
				$uid = $row['customer_id'];
			}		
		}
	
		//get the variables for query 
		$pro_id = $_GET['pro_id'];
		$rateVal = $_GET['rate'];
		
		$insert_rate = "INSERT INTO rating(ratingId, userId, productId, ratingValue, datetimestamp) VALUES (NULL, '$uid', '$pro_id', '$rateVal', CURRENT_TIMESTAMP";
		$run_insert = mysqli_query($con, $insert_rate);

}

?>
