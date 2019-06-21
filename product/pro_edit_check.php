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
$pro_code = $_POST['code'];
$pro_name = $_POST['name'];
$pro_price = $_POST['price'];

$pro_code = htmlspecialchars($pro_code);
$pro_name = htmlspecialchars($pro_name);
$pro_price = htmlspecialchars($pro_price);
//

$ok_flag = true;

if ($pro_code == '') {
	print '商品コードが入力されていません<br>';
	$ok_flag = false;
} else {
	print '商品コード：　' . $pro_code . '<br>';
}

if ($pro_name == '') {
	print '名前が入力されていません<br>';
	$ok_flag = false;
} else {
	print '商品名：　' . $pro_name . '<br>';
}

if ($pro_pass1 == '') {
	print '価格が入力されていません<br>';
	$ok_flag = false;
}

if (!$ok_flag) {
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
} else {
	$pro_pass = md5($pro_pass1);
	print '<form method="post" action="pro_edit_done.php">';
	print '<input type="hidden" name="code" value="' . $pro_code . '">';
	print '<input type="hidden" name="name" value="' . $pro_name . '">';
	print '<input type="hidden" name="price" value="' . $pro_price . '">';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="OK">';
	print '</form>';
}

?>
</body>
</html>

