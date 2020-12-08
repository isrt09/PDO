<?php 
	require_once('./db.php');
	$sql      = "UPDATE users SET user_name=:name,user_email=:email,user_password=:password WHERE user_id=:id";
	$stmt     = $pdo->prepare($sql);
	$name     = 'James Bond';
	$email 	  = 'james@gmail.com';
	$password = '12345';
	$id  	  = 3;
	$stmt->execute([
		':name'    =>$name,
		':email'   =>$email,
		':password'=>$password,
		':id'      =>$id
	]);
 ?>