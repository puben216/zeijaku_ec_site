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
<html lang="jp">
<head>
	<meta charset="UTF-8">
	<title>kaiin_login</title>
	<link rel="stylesheet" href="./css/normalize.css">
	<link rel="stylesheet" href="./css/kaiin_top.css">
	<script>
		console.log("document.cookie")
		console.log(document.cookie)
		//document.cookie = "PHPSESSID=aaaa";
		document.cookie = "php=aaaa";
		document.cookie = "php=bbbb";
		console.log(document.cookie)
	</script>
</head>
<body>
	<header class="header">
		<div class="sub">
			<?php
				print $_SESSION['kaiin_name'];
				print 'さんログイン中<br>';
			?>
		</div>
	</header>
	
	<div class="main">
		<div class="links clearfix">
			<ul>
				<li><a href="./kaiin/kaiin_edit_mypage.php" class="btn kaiin-top-btn">myページ</a></li>
				<li><a href="./kaiin/kaiin_list.php" class="btn kaiin-top-btn">会員管理</a></li>
				<li><a href="./product/pro_list.php" class="btn kaiin-top-btn">商品管理</a></li>
				<li><a href="./order/order_download.php" class="btn kaiin-top-btn">注文ダウンロード</a></li>
				<li><a href="./kaiin_login/kaiin_logout.php" class="btn kaiin-top-btn">ログアウト</a></li>
			</ul>
		</div>
	</div>

	<footer class="footer">bbb</footer>
</body>
</html>

