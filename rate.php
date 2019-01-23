<!--

	For now not gonna use this as making a star rating is
	harder than a float value rating.
rate product
	TODO USE THIS IN NEXT VERSION
-->
<head>
	<style type="text/css">
	  	.rating {
		  display: inline-block;
		  position: relative;
		  height: 50px;
		  line-height: 50px;
		  font-size: 50px;
		}

		.rating label {
		  position: absolute;
		  top: 0;
		  left: 0;
		  height: 100%;
		  cursor: pointer;
		}

		.rating label:last-child {
		  position: static;
		}

		.rating label:nth-child(1) {
		  z-index: 5;
		}

		.rating label:nth-child(2) {
		  z-index: 4;
		}

		.rating label:nth-child(3) {
		  z-index: 3;
		}

		.rating label:nth-child(4) {
		  z-index: 2;
		}

		.rating label:nth-child(5) {
		  z-index: 1;
		}

		.rating label input {
		  position: absolute;
		  top: 0;
		  left: 0;
		  opacity: 0;
		}

		.rating label .icon {
		  float: left;
		  color: transparent;
		}

		.rating label:last-child .icon {
		  color: #000;
		}

		.rating:not(:hover) label input:checked ~ .icon,
		.rating:hover label:hover input ~ .icon {
		  color: #09f;
		}

		.rating label input:focus:not(:checked) ~ .icon:last-child {
		  color: #000;
		  text-shadow: 0 0 5px #09f;
		}	  
	</style>
</head>
<body>
	<h5>Rate this Product</h5>		
	<form class="rating">
		  <label>
		    <input type="radio" name="stars" value="1" />
		    <span class="icon">★</span>
		  </label>
		  <label>
		    <input type="radio" name="stars" value="2" />
		    <span class="icon">★</span>
		    <span class="icon">★</span>
		  </label>
		  <label>
		    <input type="radio" name="stars" value="3" />
		    <span class="icon">★</span>
		    <span class="icon">★</span>
		    <span class="icon">★</span>   
		  </label>
		  <label>
		    <input type="radio" name="stars" value="4" />
		    <span class="icon">★</span>
		    <span class="icon">★</span>
		    <span class="icon">★</span>
		    <span class="icon">★</span>
		  </label>
		  <label>
		    <input type="radio" name="stars" value="5" />
		    <span class="icon">★</span>
		    <span class="icon">★</span>
		    <span class="icon">★</span>
		    <span class="icon">★</span>
		    <span class="icon">★</span>
		  </label>
	</form>
	

<script type="text/javascript">

	$(':radio').change(function() {
  		console.log('New star rating: ' + this.value);
  		document.cookie="star_rating=" + this.value;
	});	

	$(':radio').change(function())
	{

	}

</script>


<?php 
	$rating = getRating();	
	echo $_COOKIE['star_rating'];
?>