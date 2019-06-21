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
	<title>myページ</title>
	<link rel="stylesheet" href="../css/common.css">
	<style>
		.my-profile {
			width: 200px;
			height: 300px;
		}
	</style>
</head>
<body>
<?php
		require_once '../common/common.php';

		try {

			//　ここでサニタイジング必要
			// $kaiin_code = htmlspecialchars($kaiin_code);
			$kaiin_code = $_SESSION['kaiin_code'];			


			$db = connect_db();
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
		<h2>登録情報修正</h2>
		会員コード：<br><?php print $kaiin_code ?><br>
		<form action="kaiin_edit_mypage_check.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="code" value="<?php print $kaiin_code; ?>"><br>
				会員区分：<br>
				<?php print $rec['kanrisha'] ? '管理者' : '一般' ?><br><br>
				名前：<br>
				<input type="text" name="name" value="<?php print $kaiin_name; ?>"><br><br>
				画像：<br>
				<img src="" class="my-profile"><br><br><?php print dirname(__FILE__); ?>
				<input type="file" name="prof_file" size="10"><br><br>
				パスワード：<a href="kaiin_password_change.php" class="btn a-btn">変更</a><br><br>
				<input type="button" onclick="history.back()" value="戻る">
				<input type="submit" value="送信">
		</form>

</body>
</html>