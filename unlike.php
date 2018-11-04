<?php
	session_start();
	require("dbconnect.php");

	$works_id=$_GET["works_id"];

	$sql='DELETE FROM `likes` WHERE `user_id`=? and `works_id`=?';

	$data=array($_SESSION["id"],$works_id);
	$stmt=$dbh->prepare($sql);
    $stmt->execute($data);

	header("Location:my_profile.php");

?>