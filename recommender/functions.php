<?php
$con = mysqli_connect("localhost","root","","recommnder");

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
	
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='images/$pro_image' width='180' height='180' />
					
					<p><b> Price:  $pro_price </b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
					
					<a href='index.php?add_cart=$pro_id'><button>Add to Cart</button></a>
				
				</div>
		
		
		";
	
	}
	}
}

}

function setRating()
{
	global $con; 
	
	if(isset($_GET['rating']))
	{
		if(isset($_SESSION['user']))
		{
			$user = $_SESSION['user'];
			$pro_id = $_GET['pro_id'];
			$rating = $_GET['rating'];
			$timestamp = time();

			if($rating > 10)
			{
				echo "you've inputed a wrong value";
			}
			else
			{
				$rate = "INSERT INTO rating (userId, productId, ratingValue, datetimestamp) values(
				'$user', '$pro_id', '$rating', '$timestamp')";
				
				if(EnterOnce($user, $pro_id))
				{
					echo "you can't enter twice";
				}
				else{
					$result = mysqli_query($con, $rate);
				}

				if(!$result)
				{
					echo mysqli_error($con);
				}
			}
		}
	}
}


function EnterOnce( $user, $product )
{
	global $con;
	$ech = "SELECT * FROM rating";
	$check = mysqli_query($con, $ech);

	while($row = mysqli_fetch_array($check))
	{
		if( ($row['userId'] == $user) && ($row['productId'] == $product) )
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}
}

?>
