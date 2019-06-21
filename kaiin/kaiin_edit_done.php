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
	<title>会員修正完了</title>
</head>
<body>

<?php
		try {
			$kaiin_code = $_POST['code'];
			$kaiin_name = $_POST['name'];
			$kaiin_pass = $_POST['password'];
			
			$kaiin_code = htmlspecialchars($kaiin_code);
			$kaiin_name = htmlspecialchars($kaiin_name);
			$kaiin_pass = htmlspecialchars($kaiin_pass);

			$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
			$user = 'an';
			$password = 'password';
			$db = new PDO($dsn, $user, $password);
			$db->query('set names utf8');

			$sql = 'update mst_tbl set name=?, password=? where code=?';
			$stmt = $db->prepare($sql);
			$data[] = $kaiin_name;
			$data[] = $kaiin_pass;
			$data[] = $kaiin_code;

			$stmt->execute($data);

			$db = null;

			print $kaiin_name . 'を更新しました <br>';

		} catch (Exception $e) {
			print 'system error!!';
			exit();

		}
?>
</body>
</html>