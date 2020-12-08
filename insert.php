<?php 
	require_once('./db.php');
	$sql      = "INSERT INTO users(user_name,user_email,user_password) VALUES(:name,:email,:password)";
	$stmt     = $pdo->prepare($sql);
	$name     = 'Sumon Sarkar';
	$email    = 'sumon98@yahoo.com';
	$password = 'akashtanha';
	$stmt->execute([
	      ':name'=>$name,
	     ':email'=>$email,
	  ':password'=>$password
	]);
 ?>