<?php

	//追加方法は後々考える

	require("dbconnect.php");

	$errors = array();

	if (!empty($_POST)) {
	    $img = $_FILES['img']['name'];

	    if (!empty($img)) {
	        $file_type = substr($img, -4);
	        $file_type = strtolower($file_type);

	        if ($file_type != '.jpg' && $file_type != '.png' && $file_type != '.gif' && $file_type != 'jpeg') {
	            $errors['img_name'] = 'type';
	        }
	    }

		if(empty($errors)){
		    date_default_timezone_set('Asia/Manila');
		    $date_str         = date('YmdHis'); 
		    $submit_file_name = $date_str . $img;

		    move_uploaded_file($_FILES['img']['tmp_name'],'assets/images/' . $submit_file_name);

		    $name  = $_POST['name'];
		    $url = $_POST['url'];
		    $img = $submit_file_name;

		    $count = strlen($img);

		    if ($count > 14) {
		        $sql  = 'INSERT `works` SET `name` = ?, `url` = ?, `img` = ?';
		        $data = array($name,$url,$img);
		    } 

		    $stmt = $dbh->prepare($sql);
		    $stmt->execute($data);

		    header("Location:my_profile.php");

		}
	}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>追加</title>
</head>
<body>
	<form action="#" method="post" enctype="multipart/form-data">
		<div>
			<label for="name">
				service name
			</label>
			<input type="text" name="name" id="name">
		</div>
		<div>
			<label for="url">
				URL
			</label>
			<input type="text" name="url" id="url">
		</div>	
		<div>
			<label for="img">
				images
			</label>
			<input type="file" name="img" id="img" accept="image/*" placeholder="画像" class="img">
		</div>

		<div class="button">
			<button type="submit">
				renew
			</button>
			
		</div>	
	
	</form>
	
</body>
</html>