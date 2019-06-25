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
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>パスワード変更</title>
</head>
<body>
		<h2>パスワード変更</h2>
		<form action="kaiin_password_change_check.php" method="post">
				パスワード：<br>	
				<input type="password" name="password1"><br><br>
				パスワード確認用：<br>
				<input type="password" name="password2"><br><br>
				<input type="button" onclick="history.back()" value="戻る">
				<input type="submit" value="送信">
		</form>

</body>
</html>