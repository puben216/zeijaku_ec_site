<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
	print 'ログインされていません。';
	print '<a href="./kaiin_login/kaiin_login.html">ログイン画面へ</a>';
	exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>order download</title>
</head>
<body>
	<?php require_once('../common/common.php'); ?>

	ダウンロードしたい注文日を選んでください。
	<form action="order_download_done.php" method="post">
		<?php pull_year(); ?>年

		<?php pull_month(); ?>月

		<?php pull_day(); ?>日<br>

		<input type="submit" value="download CSV">
	
	</form>
</body>
</html>

