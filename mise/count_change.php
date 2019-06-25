<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>数量変更処理</title>
</head>
<body>
	<?php
		session_start();
		session_regenerate_id(true);

		require_once("../common/common.php");

		$post = sanitize($_POST);
		$cart = $_SESSION['cart'];

		$max = $post['max'];
		for ($i = 0; $i < $max; $i++) {
			$tmp_item = $post['count_' . $i];
			if (preg_match("/^\d+$/", $tmp_item) == 0) {
				print '数量に誤りがあります。';
				print '<a href="mise_cartlook.php">カートに戻る</a>';
				exit();
			}
			if ($tmp_item < 1 || $tmp_item > 10) {
				print '数量は必ず1個以上、10個までです。';
				print '<a href="mise_cartlook.php">カートに戻る</a>';
				exit();	
			}
			$count[] = $post['count_' . $i];
		}

		for ($i = $max - 1; 0 <= $i; $i--) {
			if (isset($_POST['sakujo_' . $i]) == true) {
				array_splice($cart, $i, 1);
				array_splice($count, $i, 1);
			}
		}

		$_SESSION['count'] = $count;
		$_SESSION['cart'] = $cart;

		header('Location:mise_cartlook.php');
	?>
</body>
</html>