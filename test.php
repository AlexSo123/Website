<?php
	
	$username = 'TEST';
	$password = 'TEST';
	$email = 'TEST';

	$mysqli = NEW mySQLi('localhost','root','','login_db');
		
	$insert = $mysqli->query("INSERT INTO users (username, password, email)
	VALUES('.$username.', '.$password.', '.$email.')");
		
	echo $insert
?>
 
