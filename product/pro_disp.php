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
			$pro_gazou_name = $rec['gazou'];

			$db = null;

			if ($pro_gazou_name == '') {
				$disp_gazou = '';
			} else {
				$disp_gazou = '<img src="./gazou/' . $pro_gazou_name . '">';
			}

		} catch (Exception $e) {
				print 'system error !!!';
				print $e;
				exit();
		} 
?>
		商品<br>
		商品コード：<br><?php print $pro_code ?><br>
		商品名：<br><?php print $pro_name ?><br>
		価格：<br><?php print $pro_price . '円' ?><br>
		画像：<br><?php print $disp_gazou ?><br>
</body>
</html>