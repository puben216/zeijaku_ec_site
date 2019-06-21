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

会員追加<br>
<form method="post" action="kaiin_add_check.php">
	会員名を入力してください<br>
	<input type="text" name="name"><br>
	パスワードを入力してください<br>
	<input type="password" name="password1"><br>
	もう一度パスワードを入力してください<br>
	<input type="password" name="password2"><br>
	<input type="button" onclick="history.back()" value="戻る">
	<input type="submit" value="送信">
</form>

</body>
</html>

