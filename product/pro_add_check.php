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

<?php
$pro_name = $_POST['name'];
$pro_price = $_POST['price'];
$pro_gazou = $_FILES['gazou'];
var_dump($_FILES);
$pro_name = htmlspecialchars($pro_name);
$pro_price = htmlspecialchars($pro_price);

$ok_flag = true;

if ($pro_name == '') {
	print '商品名が入力されていません<br>';
	$ok_flag = false;
} else {
	print '商品名：　' . $pro_name . '<br>';
}

if (preg_match('/^\d+$/', $pro_price) == 0) {
	print '価格が正しく入力されていません<br>';
	$ok_flag = false;
} else {
	print '価格：　' . $pro_price . '<br>';
}

if ($pro_gazou['size'] > 0) {
	if ($pro_gazou['size'] > 1000000) {
		print '画像が大きすぎます';
	} else {
		move_uploaded_file($pro_gazou['tmp_name'], './gazou/' . $pro_gazou['name']);
		print '<img src="./gazou/"' . $pro_gazou['name'] . '">';
		print '<br>';
	}
}

if (!$ok_flag) {
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
} else {
	print '<form method="post" action="pro_add_done.php">';
	print '<input type="hidden" name="name" value="' . $pro_name . '">';
	print '<input type="hidden" name="price" value="' . $pro_price . '">';
	print '<input type="hidden" name="gazou" value="' . $pro_gazou['name'] . '">';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="OK">';
	print '</form>';
}

?>
</body>
</html>

