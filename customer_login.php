<?php 
include("includes/db.php");
?>

<div> 
	
	<form method="post"> 
		
		<table width="500" align="center" bgcolor="skyblue"> 
			
			<tr align="center">
				<td colspan="3"><h2>Login or Register to Buy!</h2></td>
			</tr>
			
			<tr>
				<td align="right"><b>Email:</b></td>
				<td><input type="text" name="email" placeholder="enter email" required/></td>
			</tr>
			
			<tr>
				<td align="right"><b>Password:</b></td>
				<td><input type="password" name="pass" placeholder="enter password" required/></td>
			</tr>
			
			<tr align="center">
				<td colspan="3"><a href="checkout.php?forgot_pass">Forgot Password?</a></td>
			</tr>
			
			<tr align="center">
				<td colspan="3"><input type="submit" name="login" value="Login" /></td>
			</tr>
			
		</table> 
	
			<h2 style="float:right; padding-right:20px;"><a href="customer_register.php" style="text-decoration:none;">New? Register Here</a></h2>
	
	
	</form>
	

</div>


	
	<?php 
	if(isset($_POST['login'])){
	
		$c_email = $_POST['email'];
		$c_pass = $_POST['pass'];
		
		// checking the information given exists in table
		$sel_c = "SELECT * from customers where customer_pass='$c_pass' AND customer_email='$c_email'";
		$run_c = mysqli_query($con, $sel_c);
		$check_customer = mysqli_num_rows($run_c); 

		//	check if user exists	
		if($check_customer==0){
		
		// give a msg and exit 
		echo "<script>alert('Password or email is incorrect, plz try again!')</script>";
		exit();
		}
		// Get Ip address 
		$ip = getIp(); 

		// check if customer ip address has any items in cart
		$sel_cart = "SELECT * from cart where ip_add='$ip'";
		$run_cart = mysqli_query($con, $sel_cart); 
		$check_cart = mysqli_num_rows($run_cart); 
	
		// if customer exists but cart is empty redirect to my_account page
		if($check_customer>0 AND $check_cart==0){

		$_SESSION['customer_email']=$c_email; 
		echo "<script>alert('You logged in successfully, Thanks!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
		
		}
		else {

		//if cart is not empty then redirect to checkout page for payment
		$_SESSION['customer_email']=$c_email; 
		echo "<script>alert('You logged in successfully, Thanks!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
		
		
		}
	}

	
	?>
	
	
	
