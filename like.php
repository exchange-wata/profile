<?php
// session変数を使えるようにする→今ログインしとるユーザー
	// session_start(); 


// DB接続
	require('dbconnect.php');


// feed_idを取得 <-GET送信で送られてきとる前提
	$feed_id=$_GET["feed_id"];


// データを増やす=>insert
// SQL文作成
	// $sql='insert into likes
	// 	  set user_id=?,feed_id?';
	$sql='INSERT INTO `likes` (`id`) VALUES (NULL, ?,?)';

// SQL文実行
	$data=array($feed_id);
	$stmt=$dbh->prepare($sql);
    $stmt->execute($data);


// 一覧に戻る
	header("Location:my_profile.php");

?>