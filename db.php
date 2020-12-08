<?php 
	// dsn for Data Source Network
	$dsn = "mysql:host=localhost; dbname=pdo";
	try {
		$pdo = new PDO($dsn,'root','');
	} catch (PDOException $e) {
		echo $e->getMessage();
	}

?>