<?php
session_start();
session_regenerate_id(true);
/*
if (isset($_SESSION['member_login']) == false) {
	print 'ようこそゲスト様';
	print '<a href="member_login.html">ログイン</a>';
	print '<br>';
} else {
	print 'ようこそ';
	print $_SESSION['member_name'];
	print '様';
	print '<a href="member_logout.php">ログアウト</a><br>';
	print '<br>';
}
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>	</title>
</head>
<body>
<?php
		try {
var_dump($_SESSION);
			$pro_code = $_GET['pro_code'];
			//　ここでサニタイジング
			// $pro_code = htmlspecialchars($pro_code);
			if (isset($_SESSION['cart']) == true) {
				$cart = $_SESSION['cart'];
				$count = $_SESSION['count'];
			}

			if (in_array($pro_code, $cart)) {
				print 'その商品はすでにカートに入っています。';
				print '<a href="mise_list.php">商品一覧に戻る</a>';
				exit();
			}

			$cart[] = $pro_code;
			$count[] = 1;
			$_SESSION['cart'] = $cart;
			$_SESSION['count'] = $count;
			foreach ($cart as $key => $value) {
				print $value;
				print '<br>';
			}
		} catch (Exception $e) {
				print 'system error !!!';
				print $e;
				exit();
		} 
		var_dump($_SESSION);
?>
		カートに追加しました。<br>
		<br>
		<a href="mise_list.php">商品一覧に戻る</a>
		
</body>
</html>