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
			$pro_name = $_POST['name'];
			$pro_price = $_POST['price'];
			$pro_gazou = $_POST['gazou'];
			
			/*
				$pro_name = htmlspecialchars($pro_name);
				$pro_pass = htmlspecialchars($pro_pass);
			*/

			$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
			$user = 'an';
			$password = 'password';
			$db = new PDO($dsn, $user, $password);
			$db->query('set names utf8');

			$sql = 'insert into mst_product(name, price, gazou) values(?, ?, ?)';
			$stmt = $db->prepare($sql);
			$data = [$pro_name, $pro_price, $pro_gazou];
		var_dump($data);
		var_dump($_POST);
			$stmt->execute($data);

			$db = null;

			print $pro_name . 'を追加しました <br>';

		} catch (Exception $e) {
			print 'system error!!';
			exit();

		}
?>
<a href="./pro_list.php">戻る</a>
</body>
</html>