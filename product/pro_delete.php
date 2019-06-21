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
	<title>	</title>
</head>
<body>
<?php
		try {

			$pro_code = $_GET['pro_code'];
			//　ここでサニタイジング
			$pro_code = htmlspecialchars($pro_code);

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

			$db = null;

		} catch (Exception $e) {
				print 'system error !!!';
				print $e;
				exit();
		} 
?>
		商品削除<br>
		商品コード：<br><?php print $pro_code; ?><br>
		商品名：<br><?php print $pro_name; ?><br>
		この商品を削除してもよろしいですか？<br>
		<form action="pro_delete_done.php" method="post">
			<input type="hidden" name="code" value="<?php print $pro_code; ?>">
			<input type="hidden" name="name" value="<?php print $pro_name; ?>">
			<input type="button" onclick="history.back()" value="戻る">
			<input type="submit" value="OK">
		</form>

</body>
</html>