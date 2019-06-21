<?php
	session_start();
	session_regenerate_id(true);
	if (isset($_SESSION['login']) == false) {
		print 'ログインされていません。';
		print '<a href="../kaiin_login/kaiin_login.html">ログイン画面へ</a>';
		exit();
	} else {
		print $_SESSION['kaiin_name'];
		print 'さんログイン中<br>';
		print '<br>';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

商品追加<br>
<form method="post" action="pro_add_check.php" enctype="multipart/form-data">
	商品名を入力してください<br>
	<input type="text" name="name"><br>
	金額を入力してください<br>
	<input type="text" name="price"><br>
	画像をえらんでください。<br>
	<input type="file" name="gazou" style="width:400px"><br>
	<input type="button" onclick="history.back()" value="戻る">
	<input type="submit" value="送信">
</form>

</body>
</html>

