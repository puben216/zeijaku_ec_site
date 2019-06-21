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
	<title>パスワード変更確認</title>
</head>
<body>

<?php
$kaiin_pass1 = $_POST['password1'];
$kaiin_pass2 = $_POST['password2'];

$kaiin_pass1 = htmlspecialchars($kaiin_pass1);
$kaiin_pass2 = htmlspecialchars($kaiin_pass2);
//

$ok_flag = true;

if ($kaiin_pass1 == '' || $kaiin_pass2 == '') {
	print 'パスワードが入力されていません<br>';
	$ok_flag = false;
} else if ($kaiin_pass1 !== $kaiin_pass2) {
	print 'パスワードが一致しません<br>';
	$ok_flag = false;
}

if (!$ok_flag) {
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
} else {
	$kaiin_pass = md5($kaiin_pass1);
	print '<form method="post" action="kaiin_password_change_done.php">';
	print '<input type="hidden" name="password" value="' . $kaiin_pass . '">';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="OK">';
	print '</form>';
}

?>
</body>
</html>

