<?php
	require_once '../common/common.php';

	session_start();
	session_regenerate_id(true);
	if (isset($_SESSION['member_login']) == false) {
		print 'ようこそゲスト様';
		print '<br>';
	} else {
		print 'ようこそ';
		print $_SESSION['member_name'];
		print '様';
		print '<a href="member_logout.php">ログアウト</a><br>';
		print '<br>';
	}

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
