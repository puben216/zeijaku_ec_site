<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
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
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');

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
	<div class="main" class="clear-fix">
		<div class="main-container" style="float:left;width:80%; margin:0 auto;background-color: red; text-align: center;">
			<h3>スタッフ修正</h3><br>
			スタッフコード：<br><?php print $kaiin_code; ?><br>
			<form action="csrf_ajax_test.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="code" value="<?php print $kaiin_code; ?>"><br>
					会員区分：<br>
					<?php print $rec['kanrisha'] ? '管理者' : '一般' ?><br><br>
					名前：<br>
					<input type="text" name="name" value="<?php print $kaiin_name; ?>"><br><br>
					画像：<br>
					<img src="" class="my-profile"><br><br><?php print dirname(__FILE__); ?><br>
					<input type="file" name="prof_file" size="10"><br><br>
					<input type="button" onclick="history.back()" value="戻る">
					<input type="submit" value="送信">
			</form>
		</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>
</body>
</html>