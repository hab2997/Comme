<?php
?>

<!DOCTYPE html>
<html>
<head>
	<title>Recommender System</title>
	<script>
    	function chat_ajax(){
	    var req = new XMLHttpRequest();
	    req.onreadystatechange = function() {
		if(req.readyState == 4 && req.status == 200){
			document.getElementById('chat').innerHTML = req.responseText;
	        	}
            	}
	    req.open('GET', 'chat.php', true);
	    req.send(); 
                }

        setInterval(function(){chat_ajax()}, 1000)
    </script>
    </head>
</head>
<body>
	<form>
		<input type="text" name="searchBox">
		<input type="submit" name="Recomm" search="Search">
	</form>
</body>
</html>