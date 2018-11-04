<?php
	session_start();
	require("dbconnect.php");

	$user_id = $_SESSION["id"];
	$works_id = $_GET["works_id"];

	// $sql='INSERT INTO `works` (`user_id`, `works_id`) VALUES (NULL, ?,?)';
	$sql='INSERT `likes` SET `user_id` = ?, `works_id` = ?';
	$data=array($_SESSION["id"],$works_id);
	$stmt=$dbh->prepare($sql);
    $stmt->execute($data);

	header("Location:my_profile.php");

?>