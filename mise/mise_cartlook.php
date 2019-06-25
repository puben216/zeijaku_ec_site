<?php
	require_once '../common/common.php';

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

	$db = connect_db();
	$db->query('set names utf8');

	if (isset($_SESSION['cart']) == true) {
		$cart = $_SESSION['cart'];
		$count = $_SESSION['count'];
		$max = count($cart);	
	} else {
		$max = 0;
	}
	

	if ($max == 0) {
		print '商品が入っていません。';
		print '<br>';
		print '<a href="mise_list.php">商品一覧へ戻る</a>';
		exit();
	}

	foreach ($cart as $key => $value) {
		$sql = 'select name, price, code from mst_product where code = ?';
		$stmt = $db->prepare($sql);
		$data[0] = $value;
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);

		$pro_name[] = $rec['name'];
		$pro_price[] = $rec['price'];
		if ($rec['gazou'] == false) {
			$pro_gazou[] = '';
		} else {
			$pro_gazou[] = '<img src="../product/gazou/' . $rec['gazou'] . '">';
		}
	}
	$db = null;
?>

	カートの中身<br>
	<br>
	<form action="count_change.php" method="post">
	<table border=1>
		<tr>
			<td>商品</td>
			<td>商品画像</td>
			<td>価格</td>
			<td>数量</td>
			<td>小計</td>
			<td>削除</td>
		</tr>
		<?php for ($i = 0; $i < $max; $i++) { ?>	
			<tr>
				<td><?php print $pro_name[$i] ?></td>
				<td><?php print $pro_gazou[$i]; ?></td>
				<td><?php print $pro_price[$i] . '円'; ?></td>
				<td><?php print '合計' . $pro_price[$i] * $count[$i] . '円'; ?></td>
				<td><input type="text" name="count_<?php print $i; ?>" value="<?php print $count[$i]; ?>"></td>
				<td><input type="checkbox" name="sakujo_<?php print $i; ?>"></td>
			</tr>
		<br><br>
		<?php } ?>
	</table>
	<input type="hidden" name="max" value="<?php print $max; ?>">
	<input type="submit" value="数量変更">
	</form>

	<a href="./clear_cart.php">カートを空にする</a>
	<a href="./mise_form.html">ご購入手続きへ進む</a>

<?php
	if (isset($_SESSION['member_login']) == true) {
		print '<a href="mise_easy_check.php">会員簡単注文へ進む</a><br>';
	}
?>

