<?php
	include('functions.php');
	$_SESSION['user'] = "790";
?>


<!DOCTYPE html>
<html>
<head>
	<title>Recommender System</title>
</head>
<body>
	<?php 	
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
	
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='images/$pro_image' width='400' height='300' />
					
					<p><b> $ $pro_price </b></p>
					
					<p>$pro_desc </p>
					
					<a href='index.php' style='float:left;'>Go Back</a>
					
					<a href='index.php?pro_id=$pro_id'><button>Add to Cart</button></a>
				
				</div>
		
		
		";
	
	}
	}

		//Setting Rating
		setRating();
?>
	<h3>Rate This Product</h3>
	<table>
		<form method="get">
			<tr><td><input type="text" name="pro_id" value="<?php echo $_GET['pro_id']?>"  readonly></td>
				<td><input type="text" name="rating" placeholder="Rate Out of 10" autocomplete="off" required/></td>
			<td><input type="submit" value="Rate"></td></tr>
		</form>
	</table>
</body>
</html>