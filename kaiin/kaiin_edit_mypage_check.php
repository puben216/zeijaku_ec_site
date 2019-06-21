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
	<title>Document</title>
</head>
<body>

<?php
$kaiin_name = $_POST['name'];
$tmp_file = $_FILES['prof_file']['tmp_name'];
$file_name = $_FILES['prof_file']['name'];
$img_dir = '../up_img/';

$kaiin_name = htmlspecialchars($kaiin_name);
// file_nameもエスケープが必要
// $file_name = htmlspecialchars($file_name);

$ok_flag = true;
$file_flag = false;

if ($kaiin_name == '') {
	print '名前が入力されていません<br>';
	$ok_flag = false;
} else {
	print '会員名：　' . $kaiin_name . '<br>';
}

if (is_uploaded_file($tmp_file)) {
	$file_flag = true;
}

var_dump($tmp_file);
var_dump($img_dir . basename($file_name));
if ($file_flag && !move_uploaded_file($tmp_file, $img_dir . basename($file_name))) {
	print 'ファイルのアップロードに失敗しました。<br>';
	$ok_flag = false;
}


if (!$ok_flag) {
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
} else {
	print '<form method="post" action="kaiin_edit_mypage_done.php">';
	print '<input type="hidden" name="name" value="' . $kaiin_name . '">';
	print '<input type="hidden" name="file_name" value="' . $file_name . '">';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="OK">';
	print '</form>';
}

?>
</body>
</html>

