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
	<style>
		.my-profile {
			width: 200px;
			height: 300px;
		}
	</style>
	<title>会員修正</title>
</head>
<body>
<?php
		try {

			//　XSSの脆弱性のため、サニタイジングしない
			// $kaiin_code = htmlspecialchars($kaiin_code);
			$kaiin_code = $_GET['kaiin_code'];			


			$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
			$user = 'an';
			$password = 'password';
			$db = new PDO($dsn, $user, $password);
			$db->query('set names utf8');

			$sql = 'select code, name from mst_tbl where code = ?';
			$stmt = $db->prepare($sql);
			$data = [$kaiin_code];
			$stmt->execute($data);

			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			$kaiin_name = $rec['name'];

			$db = null;

		} catch (Exception $e) {
				print 'system error !!!';
				print $e;
				exit();
		} 
?>
		<h3>スタッフ修正</h3><br>
		スタッフコード：<br><?php print $kaiin_code ?><br>
		<form action="kaiin_edit_check.php" method="post">
				<input type="hidden" name="code" value="<?php print $kaiin_code; ?>"><br>
				会員区分：<br>
				<?php print $rec['kanrisha'] ? '管理者' : '一般' ?><br><br>
				名前：<br>
				<input type="text" name="name" value="<?php print $kaiin_name; ?>"><br><br>
				画像：<br>
				<img src="" class="my-profile"><br><br><?php print dirname(__FILE__); ?>
				<input type="file" name="prof_file" size="10"><br><br>
				<input type="button" onclick="history.back()" value="戻る">
				<input type="submit" value="送信">
		</form>

</body>
</html>