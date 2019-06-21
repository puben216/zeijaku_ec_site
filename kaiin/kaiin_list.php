<?php
	session_start();
	session_regenerate_id(true);
	if (isset($_SESSION['login']) == false) {
		print 'ログインされていません。';
		print '<a href="../kaiin_login/kaiin_login.html">ログイン画面へ</a>';
		exit();
	}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員リスト</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/kaiin_list.css">
</head>
<body>
	<header class="header">
		<?php print $_SESSION['kaiin_name'] . 'さんログイン中<br>'; ?>
	</header>

	<div class="main">
		<div class="content-table">
			<h2 class="main-title">会員一覧</h2><br>
			<form action="kaiin_branch.php" method="post" class="form kaiin-list-form">
<?php
		try {
			$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
			$user = 'an';
			$password = 'password';
			$db = new PDO($dsn, $user, $password);
			$db->query('set names utf8');

			$sql = 'select code, name from mst_tbl';
			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			while (true) {
				$rec = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($rec == false) {
						break;
				}
				print '<label class="input-cell" for="' . $rec['code'] . '">';
				print '<img src=\'\' class="kaiin-image">';
				print '<input type="radio" name="kaiin_code" value="' . $rec['code'] . '" id ="' . $rec['code'] . '">';
				print '<span>' . $rec['name'] . '</span>';
				print '</label>';
			}

		} catch (Exception $e) {
				print 'system error !!!';
				print $e;
				exit();
		} 
?>

				<input type="submit" class="btn" name="add" value="追加">
				<input type="submit" class="btn" name="disp" value="参照">
				<input type="submit" class="btn" name="edit" value="修正">
				<input type="submit" class="btn" name="delete" value="削除">
			</form>
		</div>
		<a href="../kaiin_top.php" class="top-link">トップ画面へ</a>
	</div>

</body>
</html>