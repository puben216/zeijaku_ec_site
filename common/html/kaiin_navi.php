<div class="nav-container">

	<span class="login-info">
		<?php
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
	</span>
</div>

<div class="bread-zone">
	<?php
		print 'bread';
	?>
</div>