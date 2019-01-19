<?php

$db = mysqli_connect('localhost', 'root', '', 'ecomm');
if(!$db){
	echo mysqli_error($db);
}
?>