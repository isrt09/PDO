<?php 	
	require_once('./db.php');
	$sql = "SELECT * FROM users";
	$stmt = $pdo->prepare($sql);	
	$stmt->execute();
	while($row = $stmt->fetch()){
		echo "<pre>";
		print_r($row);
	}
 ?>