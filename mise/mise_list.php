<?php
	require_once '../common/common.php';

	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ショップ</title>
	<link href="../common/css/font-awesome/css/all.css" rel="stylesheet"> 
	<link rel="stylesheet" href="../common/css/bootstrap-4.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="../common/css/mise_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/mise_navi.css">
	<link rel="stylesheet" href="../common/css/mise_side.css">
	<script src="../common/css/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');

		$db = connect_db();
		$db->query('set names utf8');

		$sql = 'select name, price, code from mst_product';
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$db = null;

		while (true) {
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($rec == false) {
				break;
			}
			print '<a href="mise_product.php?pro_code=' . $rec['code'] . '">';
			print $rec['name'] . '--';
			print $rec['price'] . '円';
			print '</a>';
			print '<br>';
		}

		print '<br>';
		print '<a href="mise_cartlook.php">カートを見る</a><br>';
		print '<a href="clear_cart.php">カートを空にする</a><br>';
		print '<a href="mise_form.php">購入手続き</a><br>';
		print '<a href="member_login.html">メンバーログイン</a><br>';
	?>
</body>
</html>
