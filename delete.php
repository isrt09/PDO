<?php 
	require_once('./db.php');
	$sql  = "DELETE FROM users WHERE user_id=:id";
	$stmt = $pdo->prepare($sql);
	$id   = 4;
	$stmt->execute([':id'=>$id]);
 ?>