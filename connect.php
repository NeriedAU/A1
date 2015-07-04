<?php
	include_once('db.php');
	
	try {
		$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
?>