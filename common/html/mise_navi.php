<?php require_once '../common/common.php'; ?>
<div class="nav-container">

	<div class="login-info">
		<?php
			if (isset($_SESSION['member_login']) == false) {
				print 'ようこそゲスト様';
				print '<br>';
			} else {
				print 'ようこそ';
				print $_SESSION['member_name'];
				print '様';
				print '<a href="member_logout.php">ログアウト</a><br>';
				print '<br>';
			}
		?>
	</div>
	<div class="logout">
		<a href="<?php print getDomainName() . '/ec_php/kaiin_login/kaiin_logout.php'; ?>">
			<?php if ($_SESSION['member_name']) {
			 print '<i class="fas fa-sign-out-alt fa-2x awe-grey"></i>';
			} ?>
		</a>
	</div>
</div>

<div class="bread-zone">
	<?php
		$breads = make_bread($_SERVER["PHP_SELF"]);
		foreach ($breads as $i => $link) {
			if ($i != 0) {
				print ' > ';
			}
			print '<a href="' . $link[0] . '">' . $link[1] . '</a>';
		}
	?>
</div>