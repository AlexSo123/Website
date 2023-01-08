<?php
session_start();
	
	include("functions.php");
	

$error = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$username = $_POST ['username'];
	$password = $_POST ['password'];
	$password2 = $_POST ['password2'];
	$email = $_POST ['email'];
	
	if(strlen($username) < 5) {
		$error = "<p> Your username needs to be at least 5 characters</p>";
	}elseif ($password2 != $password){
		$error .= "<p> Your passwords do not match</p>";
	}else{
		
		$mysqli = NEW mySQLi('localhost','root','','login_db');
		
		$user_id = random_number(20);
		
		$insert = $mysqli->query("INSERT INTO users (username, password, email)
		VALUES('$username', '$password', '$email')");
		
		header("Location: login.php");
		die;
		
		if($insert) {
			echo "success";
		}else{
			echo $mysqli->error;
		}
	}
}
?>