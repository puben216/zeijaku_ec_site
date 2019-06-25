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
	<title>会員パスワード修正完了</title>
</head>
<body>

<?php
		try {
			
			$kaiin_code = $_SESSION['kaiin_code'];
			$kaiin_pass = $_POST['password'];
			
			$kaiin_pass = htmlspecialchars($kaiin_pass);
	

			$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
			$user = 'an';
			$password = 'password';
			$db = new PDO($dsn, $user, $password);
			$db->query('set names utf8');
var_dump($kaiin_code);
var_dump($_SESSION);
			$sql = 'update mst_tbl set password=? where code=?';
			$stmt = $db->prepare($sql);
			$data[] = $kaiin_pass;
			$data[] = $kaiin_code;

			$stmt->execute($data);

			$db = null;

			print '更新しました <br>';
			print '<a href="../kaiin_top.php" class="top-link">トップ画面へ</a>';

		} catch (Exception $e) {
			print 'system error!!';
			exit();

		}
?>
</body>
</html>