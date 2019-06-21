4<?php
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
			$kaiin_code = $_SESSION['kaiin_code'];
			$kaiin_name = $_POST['name'];
			$prof_file = $_POST['file_name'];
			
			$kaiin_name = htmlspecialchars($kaiin_name);
			// file_nameもエスケープが必要
			// $file_name = htmlspecialchars($file_name);


			$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
			$user = 'an';
			$password = 'password';
			$db = new PDO($dsn, $user, $password);
			$db->query('set names utf8');

			$sql = 'update mst_tbl set name=?, prof_file=? where code=?';
			$stmt = $db->prepare($sql);
			$data[] = $kaiin_name;
			$data[] = $prof_file;
			$data[] = $kaiin_code;

			$stmt->execute($data);

			$db = null;

			// セッションの会員名も更新
			$_SESSION['kaiin_name'] = $kaiin_name;
			print $kaiin_name . 'を更新しました <br>';
			print '<a href="../kaiin_top.php" class="top-link">トップ画面へ</a>';

		} catch (Exception $e) {
			print 'system error!!';
			exit();

		}
?>
</body>
</html>