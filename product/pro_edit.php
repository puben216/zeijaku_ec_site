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
	<title>商品編集入力</title>
</head>
<body>
<?php
		try {

			$pro_code = $_GET['pro_code'];
			//　ここでサニタイジング
			// $pro_code = htmlspecialchars($pro_code);

			$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
			$user = 'an';
			$password = 'password';
			$db = new PDO($dsn, $user, $password);
			$db->query('set names utf8');

			$sql = 'select code, name, price from mst_product where code = ?';
			$stmt = $db->prepare($sql);
			$data = [$pro_code];
			$stmt->execute($data);

			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			$pro_name = $rec['name'];
			$pro_price = $rec['price'];

			$db = null;

		} catch (Exception $e) {
				print 'system error !!!';
				print $e;
				exit();
		} 
?>
		商品修正<br>
		商品コード：<br><?php print $pro_code ?><br>
		<form action="pro_edit_check.php" method="post">
				名前：<br>
				<input type="text" name="name" value="<?php print $pro_name; ?>"><br>
				価格：<br>	
				<input type="text" name="price" value="<?php print $pro_price; ?>"><br>
				<input type="button" onclick="history.back()" value="戻る">
				<input type="submit" value="送信">
		</form>

</body>
</html>